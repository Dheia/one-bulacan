<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FeaturedBusinessRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Business;
use App\Models\Log;
use Carbon\Carbon;

use App\Models\Permission;

use App\Models\FeaturedBusiness;

/**
 * Class FeaturedBusinessCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class FeaturedBusinessCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    public function setup()
    {
        $this->crud->setModel('App\Models\FeaturedBusiness');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/featuredbusiness');
        $this->crud->setEntityNameStrings('featured business', 'Featured Businesses');

        // Allow / Deny Access
        $this->crud->denyAccess('create');
        $this->crud->denyAccess('update');
        $this->crud->allowAccess('featured_renewal');
        $this->crud->allowAccess('unfeatured');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access featured business',
            'show'      =>  'read featured business',
            'delete'    =>  'delete featured business',
            'featured_renewal'  =>  'renew featured business',
            'unfeatured'    =>  'unfeature business'
        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

        // Data For List View Widgets
        $this->data['active']       =   FeaturedBusiness::getReferrerActiveFeatured();
        $this->data['not_active']   =   FeaturedBusiness::getReferrerNotActiveFeatured();
        $this->data['expired']      =   FeaturedBusiness::getReferrerExpiredFeatured();
        $this->data['renewal']      =   FeaturedBusiness::getReferrerRenewalFeatured();

        // If Not Super-Admin Filter Businesses
        if(!backpack_user()->hasPermissionTo('access all business'))
        {
            CRUD::addClause('whereIn', 'business_id', Business::getReferrerBusinesses()->pluck('id'));
        }

        // Drop Down Button Data
        $this->crud->data['dropdownButtons'] = [
            'show',
            'featured_renewal',
            'unfeatured'
        ];
        $this->crud->addButtonFromView('line', 'More', 'dropdownButton', 'beginning');
        $this->crud->setListView('business.featured_business_list');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn([
            'type'      => 'select',
            'label'     => "Business",
            'name'      => 'business_id',
            'entity'    => 'business',
            'attribute' => 'name',
            'model'     => 'App\Models\Business'
        ]);

        CRUD::addColumn([
            'name'  => 'start_at',
            'label' => 'Start',
            'type'  => 'datetime',
            // 'format' => 'l j F Y H:i:s',
            'format' => 'MMM DD, YYYY - HH:MM A',
        ]);

        CRUD::addColumn([
            'name'  => 'end_at',
            'label' => 'End',
            'type'  => 'datetime',
            // 'format' => 'l j F Y H:i:s',
            'format' => 'MMM DD, YYYY - HH:MM A',
        ]);

        CRUD::addColumn([
            'label' => "Remaining Week",
            'type' => 'text',
            'name' => 'remaining_weeks',
        ]);

        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // CRUD::setFromDb();

        // Remove Column, Button in List View
        CRUD::removeButton('show');
        CRUD::removeColumn('isActive');
        
        CRUD::addColumn([
            'name'  => 'status',
            'label' => "Status",
            'type'  => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'ACTIVE') {
                        return 'badge badge-success';
                    }
                    else if($column['text'] == 'EXPIRED') {
                        return 'badge badge-danger';
                    }
                    else if($column['text'] == 'FOR RENEWAL') {
                        return 'badge badge-warning';
                    }

                    return 'badge badge-default';
                }, 
            ],
            'visibleInExport' => true,
            'visibleInTable' => true
        ]);

        CRUD::addFilter([ // select2 filter
            'name' => 'status',
            'type' => 'dropdown',
            'label'=> 'Status',
        ], [
            'active'        => 'Active',
            'not-active'    => 'Not Active',
            'for-renewal'   => 'For Renewal',
            'expired'       => 'Expired',
        ], function($value) { // if the filter is active
            if($value == 'expired'){
                CRUD::addClause('where', 'end_at', '<', Carbon::now());
            }
            else if($value == 'for-renewal'){
                CRUD::addClause('whereIn', 'id',  $this->data['renewal']->pluck('id'));
            }
            else if($value == 'active'){
                CRUD::addClause('where', 'end_at', '>', Carbon::now());
                CRUD::addClause('where', 'isActive', 1);
            }
            else if($value == 'not-active'){
                CRUD::addClause('where', 'isActive', 0);
            }
                
        });

    }

    protected function setupShowOperation()
    {   
        $this->crud->addColumn([
            'label' => "Business",
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business'
        ]);

        $this->crud->setFromDb();

        $this->crud->addColumn([
            'label' => "Status",
            'type' => 'status',
            'name' => 'status',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(FeaturedBusinessRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function show($id)
    {
        // Abort If Has No Permission To Read Featured Business
        Permission::hasPermissionOr403('read featured business');

        $featuredBusiness   =   FeaturedBusiness::findOrFail($id);

        self::referredByUser($featuredBusiness->business_id);
        // custom logic before
        $content = $this->traitShow($id);
        // cutom logic after
        return $content;
    }

    public function featured_renew()
    {
        // Abort If Has No Permission To Update Business
        Permission::hasPermissionOr401('renew featured business');

        $id = request('renew_business_id');
        $business = FeaturedBusiness::where('id', $id)->first();

        self::referredByUser($business->business_id);

        $start_at   = $business->start_at;
        $end_at     = $business->end_at;

        $log = new Log();
        $log->business_id =  $business->business_id;
        $log->action = "Featured Renew";

        if($business->end_at <= Carbon::now() || $business->isActive == 0) {
            $start_at   = $log_start    = Carbon::now();
            $end_at     = $log_end      = Carbon::now()->addMonths(12);
        } else{
            $log_start  = $end_at;
            $end_at     = $log_end      = $end_at->addMonths(12);
        }

        $business->start_at         = $start_at;
        $business->end_at           = $end_at;
        $business->lenght_of_time   = '1year';
        $business->isActive         = 1;

        $business->update();
        $log->save();

        \Alert::success('Successfully Renew.')->flash();
        return \Redirect::to($this->crud->route);
    }

    
    public function unfeature()
    {
        // Abort If Has No Permission To Unfeature Business
        Permission::hasPermissionOr401('unfeature business');

        $id         =   request('unfeature_business_id');
        $business   =   FeaturedBusiness::findOrFail($id);

        // Abort If Has No Permission To Access All Business and Not Referred By User
        self::referredByUser($business->business_id);

        $business->isActive = 0;
        if($business->update()) {
            $log = new Log();
            $log->business_id =  $business->business_id;
            $log->action = "Unfeatured";
            $log->save();
            \Alert::success('Successfully Unfeatured.')->flash();
            return \Redirect::to($this->crud->route);
        } else {
            \Alert::error('Error Unfeaturing, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function feature()
    {
        // Abort If Has No Permission To Unfeature Business
        Permission::hasPermissionOr401('create featured business');

        $id         =   request('unfeature_business_id');
        $business   =   FeaturedBusiness::findOrFail($id);

        // Abort If Has No Permission To Access All Business and Not Referred By User
        self::referredByUser($business->business_id);

        $business->isActive = 1;
        if($business->update()) {
            $log = new Log();
            $log->business_id =  $business->business_id;
            $log->action = "Featured";
            $log->save();
            \Alert::success('Successfully Featured.')->flash();
        } else {
            \Alert::error('Error Featuring, Something Went Wrong, Please Try Again.')->flash();
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        // Abort If Has No Permission To Delete Featured Business
        Permission::hasPermissionOr401('delete featured business');

        $featured_business  =   FeaturedBusiness::findOrFail($id);

        // Abort If Has No Permission To Access All Business and Not Referred By User
        self::referredByUser($featured_business->business_id);

        Business::where('id', '=', $featured_business->business_id)->update(['featured' => 0]);
        return $this->crud->delete($id);
    }

    // Abort If Business is NOT Referred By User
    public function referredByUser($business_id)
    {
        if(!backpack_user()->hasPermissionTo('access all business'))
        {
            if(!in_array($business_id, Business::getReferrerBusinesses()->pluck('id')->toArray()))
            {
                abort(403, 'Unauthorized access - you do not have the necessary permissions to see this page.');
            }
        }
    }
}

