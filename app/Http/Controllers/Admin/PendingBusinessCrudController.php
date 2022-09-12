<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusinessRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Permission;
use App\Models\Location;
use App\Models\Business;
use App\Models\Baranggay;
use App\Models\BusinessCategory;
use App\Models\FeaturedBusiness;
use App\Models\BusinessTag;
use App\Models\Category;
use App\Models\Log;
use App\Models\Sale;
use Carbon\Carbon;
use DB;
use Alert;
/**
 * Class BusinessCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PendingBusinessCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update  as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    public function setup()
    {
        $this->crud->setModel('App\Models\Business');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/pending-business');
        $this->crud->setEntityNameStrings('Pending Businesses', 'Pending Businesses');
        
        $this->crud->denyAccess('create');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access business',
            'show'      =>  'read business',
            'update'    =>  'update business',
            'delete'    =>  'delete business',
        ];

        $extraPermissions = [
            'verified'  =>  'verify business',
            'publish'  =>  'publish business'

        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

        foreach ($extraPermissions as $extraAccess => $extraPermission) 
        {
            // Allow Access If User Has Permission
            if(backpack_user()->hasPermissionTo($extraPermission))
            {
                $this->crud->allowAccess($extraAccess);
            }
        }

        // If Not Super-Admin Filter Businesses
        if(!backpack_user()->hasPermissionTo('access all business'))
        {
            CRUD::addClause('where', 'referrer_user_id', '=', backpack_user()->id);
        }

        // Add Clause
        CRUD::addClause('where', 'active', '=', '0');
        CRUD::addClause('where', 'drafted', '!=', '1');

        // Drop Down / More Button
        $this->crud->data['dropdownButtons'] = [
            'show',
            'business.verify',
            'business.publish'
        ];
        CRUD::addButtonFromView('line', 'More', 'dropdownButton', 'beginning');
        CRUD::enableExportButtons();

        CRUD::setListView('business.pending_business_list');
    }
    protected function setupListOperation()
    {
        CRUD::removeButton('show');
        CRUD::addColumn([
            'name'  => 'name',
            'label' => "Name",
            'type'  => 'text', 
        ]);
        CRUD::addColumn([
            'name' => 'logo',
            'label' => "Logo",
            'type' => 'image',
            'visibleInExport' => false,
            'visibleInTable' => true
        ]);
        CRUD::addColumn([
            'name'  => 'telephone',
            'label' => "Telephone",
            'type'  => 'phone', 
        ]);
        CRUD::addColumn([
            'name'  => 'mobile',
            'label' => "Mobile",
            'type'  => 'phone', 
        ]);
        CRUD::addColumn([
            'name'  => 'email',
            'label' => "email",
            'type'  => 'email', 
        ]);
        CRUD::addColumn([  // Select
            'name' => 'location_id',
            'label' => "Municipality/City",
            'type' => 'select', // the db column for the foreign key
            'entity' => 'location', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Location" // foreign key model
        ]);
        CRUD::addColumn([
            'label' => "Baranggay",
            'type' => 'select',
            'name' => 'baranggay_id',
            'entity' => 'baranggay',
            'attribute' => 'name',
            'model' => 'App\Models\Baranggay'
        ]);
        CRUD::addColumn([
            'name' => 'verified',
            'label' => 'Verified',
            'type' => 'boolean',
            // optionally override the Yes/No texts
            'options' => [0 => 'Not Verified', 1 => 'Verified'],
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Verified') {
                        return 'badge badge-success';
                    }
                    return 'badge badge-default';
                }, 
            ],
            'visibleInExport' => true,
            'visibleInTable' => true
        ]);
        CRUD::addColumn([
            'name' => 'created_at',
            'label' => "Date Registered",
            'type' => 'datetime', 
        ]);
        CRUD::addColumn([
            'name'  => 'listing_type',
            'label' => "Listing Type",
            'type'  => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'premium') {
                        return 'badge badge-success text-capitalize';
                    }
                    return 'badge badge-default text-capitalize';
                }, 
            ],
            'visibleInExport' => true,
            'visibleInTable' => true
        ]);

        CRUD::addFilter([ // select2 filter
            'name'  => 'listing_type',
            'type'  => 'dropdown',
            'label' => 'Listing Type',
        ], [
            'basic' => 'Basic',
            'premium' => 'Premium',
        ], function($value) { // if the filter is active
                $this->crud->addClause('where', 'listing_type', $value);
        });
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        
    }
    
    protected function setupShowOperation()
    {   
        // Abort If Has No Read Permission
        Permission::hasPermissionOr403('read business');

        CRUD::addColumn([
            'name' => 'logo',
            'label' => "Logo",
            'type' => 'image',
        ]);
        CRUD::addColumn([
            'name' => 'name',
            'label' => "Name",
            'type' => 'text', 
        ]);
        CRUD::addColumn([
            'name'  => 'formatted_business_id',
            'label' => "Business ID",
            'type'  => 'text', 
        ]);
        // CRUD::addColumn([
        //     'name'  => 'link',
        //     'label' => "Link",
        //     'type'  => 'text', 
        //     'prefix' => "http://onepampanga.com/",
        // ]);
        CRUD::addColumn([  // Select
            'name' => 'location_id',
            'label' => "Municipality/City",
            'type' => 'select', // the db column for the foreign key
            'entity' => 'location', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Location" // foreign key model
        ]);
        CRUD::addColumn([
            'label' => "Baranggay",
            'type' => 'select',
            'name' => 'baranggay_id',
            'entity' => 'baranggay',
            'attribute' => 'name',
            'model' => 'App\Models\Baranggay'
        ]);
        CRUD::addColumn([
            'label' => "Category",
            'type' => 'select',
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => 'App\Models\Catyegory'
        ]);
        CRUD::addColumn([
            'name' => 'created_at',
            'label' => "Date Registered",
            'type' => 'datetime', 
        ]);
        CRUD::addColumn([
            'name'  => 'listing_type',
            'label' => "Listing Type",
            'type'  => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'premium') {
                        return 'badge badge-success text-capitalize';
                    }
                    return 'badge badge-default text-capitalize';
                }, 
            ],
            'visibleInExport' => true,
            'visibleInTable' => true
        ]);
        
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BusinessRequest::class);
        $this->crud->addField([
            'name'  => 'name', //database column name
            'label' => 'Business Name', //Label
            'type'  => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name'  => 'branch_name', //database column name
            'label' => 'Branch Name', //Label
            'type'  => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name'  => 'nature',
            'label' => 'Business Nature',
            'type'  => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name'  => 'slug',
            'label' => 'Slug (URL)',
            'type'  => 'text',
            'hint'  => 'Will be automatically generated from your name',
            'attributes' => [
                'class'     => 'form-control some-class',
                'readonly'  =>'readonly',
                'disabled'  =>'disabled',
              ],
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'label' => "Category",
            'type' => 'select2',
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'name',
            'allows_null' => false,
            'model' => 'App\Models\Category',
            'options'   => (function ($query) {
                return $query->where('parent_id', null)->get();
            }), 
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'label' => "Sub-Category",
            // 'type' => 'select2_category_multiple',
            'type' => 'select2_multiple',
            'name' => 'business_category',
            'entity' => 'business_category',
            'attribute' => 'name',
            // 'allows_null' => false,
            'model' => 'App\Models\Category',
            'pivot' => 'true',
            'options'   => (function ($query) {
                return $query->where('parent_id', '!=', null)->get();
            }),
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'label' => "Tags",
            // 'type' => 'select2_category_multiple',
            'type' => 'select2_multiple',
            'name' => 'tag',
            'entity' => 'tag',
            'attribute' => 'name',
            // 'allows_null' => false,
            'model' => 'App\Models\Tag',
            'pivot' => 'true',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name' => 'address1', //database column name
            'label' => 'Address Line 1', //Label
            'type' => 'text',
            'attributes' => [
                'placeholder' => 'Room | Floor | Building Name | Lot No | Block No',
              ], 
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name' => 'address2', //database column name
            'label' => 'Address Line 2', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Company Details',
        ]);
        
        $this->crud->addField([
            'label' => "Municipality",
            'type' => 'select2',
            'name' => 'location_id',
            'entity' => 'location',
            'attribute' => 'name',
            // 'allows_null' => false,
            'model' => 'App\Models\Location',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'label' => "Baranggay",
            'type' => 'select_municipality',
            'name' => 'baranggay_id',
            'entity' => 'baranggay',
            'attribute' => 'name',
            // 'allows_null' => false,
            'model' => 'App\Models\Baranggay',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        
        
        $this->crud->addField([
            'name' => 'contact_person', //database column name
            'label' => 'Contact Person', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name' => 'telephone', //database column name
            'label' => 'Telephone No.', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name' => 'mobile', //database column name
            'label' => 'Mobile No.', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name' => 'email', //database column name
            'label' => 'Email', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name' => 'website', //database column name
            'label' => 'Website', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name' => 'facebook', //database column name
            'label' => 'Facebook', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name' => 'twitter', //database column name
            'label' => 'Twitter', //Label
            'type' => 'text',
            'prefix' => '@',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name' => 'instagram', //database column name
            'label' => 'Instagram', //Label
            'type' => 'text',
            'prefix' => '@',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([
            'name' => 'verified',
            'label' => 'Verified',
            'type' => 'boolean',
            // optionally override the Yes/No texts
            'options' => [0 => 'Not Verified', 1 => 'Verified'],
            'wrapper' => [
                'class' => 'form-group col-md-1'
            ],
            'tab' => 'Company Details',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'history',
            'label' => 'History',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'description',
            'label' => 'Description',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'about',
            'label' => 'About',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'purpose',
            'label' => 'Purpose',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'mission',
            'label' => 'Mission',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'vission',
            'label' => 'Vision',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'core_values',
            'label' => 'Core Values',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'goals',
            'label' => 'Business Goals',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'key_process',
            'label' => 'Key Process',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'scope_of_work',
            'label' => 'Scope of Work',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'branches',
            'label' => 'Branches',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'product_services',
            'label' => 'Product $ Services',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([
            'name' => 'logo',
            'label' => 'Logo',
            'type' => 'image',
            'tab' => 'Company Profile'
        ]);
        $this->crud->addField([
            'name' => 'image_gallery',
            'label' => 'Image Gallery',
            'type' => 'upload_multiple',
            'upload' => true,
            'tab' => 'Company Profile'
        ], 'both');
        $this->crud->addField([   // textarea
            'name' => 'ad_promotion',
            'label' => 'Ad/Promotion',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'latitude',
            'label' => 'Latitude',
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        $this->crud->addField([   // textarea
            'name' => 'longitude',
            'label' => 'Longitude',
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
       
    }
    
    protected function setupUpdateOperation()
    {
        // Abort If Has No Permission To Update Business
        Permission::hasPermissionOr403('update business');
        $this->setupCreateOperation();
    }

    public function show($id)
    {
        // Abort If Has No Permission To Read Business
        Permission::hasPermissionOr403('read business');

        $business   =   Business::findOrFail($id);

        // Abort If Not Referred By User
        Business::referredByUserOr403($business->referrer_user_id);

        // custom logic before
        $content = $this->traitShow($id);
        // cutom logic after
        return $content;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // Abort If Has No Permission To Update Business
        Permission::hasPermissionOr403('update business');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;
        $this->crud->setOperationSetting('fields', $this->crud->getUpdateFields());
        // get the info for that entry
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->crud->getSaveAction();
        $this->data['title'] = $this->crud->getTitle() ?? trans('backpack::crud.edit').' '.$this->crud->entity_name;

        $this->data['id'] = $id;
        
        // Abort If Not Referred By User
        Business::referredByUserOr403($this->data['entry']->referrer_user_id);


        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getEditView(), $this->data);
    }


    public function update()
    {
        // Abort If Has No Permission To Update Business
        Permission::hasPermissionOr401('update business');

        $id         =   CRUD::getRequest()->id;
        $business   =   Business::findOrFail($id);

        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        // dd(CRUD::getRequest());
        $response = $this->traitUpdate();
        // do something after save

        return $response;
    }

    public function destroy($id)
    {
        // Abort If Has No Permission To Delete Business
        Permission::hasPermissionOr401('delete business');

        $logo = Business::where('id', $id)->first();
        $this->crud->hasAccessOrFail('delete');
        $logo_path = $logo->logo;  // Value is not URL but directory file path
        if(\File::exists($logo_path)) {
            if($logo_path != 'images/default_image.png')
            {
                \File::delete($logo_path);
            }
        }
        BusinessCategory::where('business_id',$id)->delete();
        FeaturedBusiness::where('business_id',$id)->delete();
        BusinessTag::where('business_id',$id)->delete();
        return $this->crud->delete($id);
    }

    public function verify($id)
    {
        // Abort If Has No Permission To Verify Business
        Permission::hasPermissionOr401('verify business');

        $business  =   Business::findOrFail($id);
        
        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        $business->verified = 1;
        if($business->update())
        {
            \Alert::success('Successfully Verified <br> The business has been successfully verified.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else
        {
            \Alert::error('Error Verifying, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function publish()
    {
        // Abort If Has No Permission To Pubshild Business
        Permission::hasPermissionOr401('publish business');

        $id         =   request('publish_business_id');
        $business  =   Business::findOrFail($id);
        
        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        $business->active           =   1;
        $business->start_at         =   Carbon::now();
        
        if (request('publish_lenght_of_time') == '1year'){
            $business->end_at = Carbon::now()->addMonths(12);
        }

        $business->lenght_of_time   =   request('publish_lenght_of_time');

        if($business->update())
        {
            $sale           =   Sale::where('business_id', $id)->first();
            $sale->paid     =   0;
            $sale->update();

            $log                =   new Log();
            $log->business_id   =   $id;
            $log->action        =   "Published";
            $log->start_at      =   $business->start_at;
            $log->end_at        =   $business->end_at;
            $log->save();

            \Alert::success('Successfully Published.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else
        {
            \Alert::error('Error Publishing, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }
    
}
