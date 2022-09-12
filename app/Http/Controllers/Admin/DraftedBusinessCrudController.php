<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusinessRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Permission;

use App\Models\BusinessCategory;
use App\Models\FeaturedBusiness;
use App\Models\BusinessTag;
use App\Models\Baranggay;
use App\Models\Category;
use App\Models\Business;
use App\Models\Location;
use App\Models\Sale;
use App\Models\Log;
use Carbon\Carbon;
use Alert;
use DB;

/**
 * Class BusinessCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class DraftedBusinessCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update  as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    public function setup()
    {
        $this->crud->setModel('App\Models\Business');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/drafted-business');
        $this->crud->setEntityNameStrings('drafted-business', 'drafted-businesses');

        // Access
        $this->crud->denyAccess('create');
        $this->crud->denyAccess('update');
        $this->crud->allowAccess('verified');
        $this->crud->allowAccess('published');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access business',
            'show'      =>  'read business',
            'delete'    =>  'delete business',
            'verified'  =>  'verify business',
            'published'  =>  'publish business'
        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

        CRUD::addClause('where', 'drafted', '=', '1');

        // If Not Super-Admin Filter Businesses
        if(!backpack_user()->hasPermissionTo('access all business'))
        {
            CRUD::addClause('where', 'referrer_user_id', '=', backpack_user()->id);
        }

        // Dropdown Button / More Button
        $this->crud->data['dropdownButtons'] = [
            'show',
            'verified',
            'drafted.published'
        ];
        CRUD::addButtonFromView('line', 'More', 'dropdownButton', 'beginning');
        CRUD::setListView('business.drafted_business_list');
    }
    protected function setupListOperation()
    {
        CRUD::removeButton('show');
        CRUD::addColumn([
            'name'  => 'name',
            'label' => "Name",
            'type'  => 'text'
        ]);

        CRUD::addColumn([
            'name'  => 'formatted_business_id',
            'label' => "Business ID",
            'type'  => 'text', 
        ]);

        CRUD::addColumn([
            'name'  => 'logo',
            'label' => "Logo",
            'type'  => 'image'
        ]);
       
        CRUD::addColumn([  // Select
            'name'      => 'location_id',
            'label'     => "Municipality/City",
            'type'      => 'select', // the db column for the foreign key
            'entity'    => 'location', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\Location" // foreign key model
        ]);

        CRUD::addColumn([
            'label'     => "Baranggay",
            'type'      => 'select',
            'name'      => 'baranggay_id',
            'entity'    => 'baranggay',
            'attribute' => 'name',
            'model'     => 'App\Models\Baranggay'
        ]);

        CRUD::addColumn([
            'name'  => 'name',
            'label' => "Name",
            'type'  => 'text' 
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
            'name'  => 'featured', // The db column name
            'label' => 'Featured',
            'type'  => 'boolean',
            // optionally override the Yes/No texts
            'options' => [0 => 'No', 1 => 'Yes'],
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Yes') {
                        return 'badge badge-success';
                    }
                    return 'badge badge-default';
                }, 
            ],
            'visibleInExport' => true,
            'visibleInTable' => true
        ]);

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
            ]
        ]);

        CRUD::addColumn([
            'name'  => 'created_at',
            'label' => "Date Registered",
            'type'  => 'datetime'
        ]);
        
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        
    }
    
    protected function setupShowOperation()
    {
        // Abort If Has No Permission To Read Business
        Permission::hasPermissionOr403('read business');

        CRUD::addColumn([
            'name'  => 'logo',
            'label' => "Logo",
            'type'  => 'image'
        ]);

        CRUD::addColumn([
            'name'  => 'name',
            'label' => "Name",
            'type'  => 'text'
        ]);

        CRUD::addColumn([
            'name'  => 'formatted_business_id',
            'label' => "Business ID",
            'type'  => 'text', 
        ]);

        CRUD::addColumn([
            'name'  => 'link',
            'label' => "Link",
            'type'  => 'text', 
            'prefix' => "http://onepampanga.com/",
        ]);

        CRUD::addColumn([  // Select
            'name'      =>  'location_id',
            'label'     =>  "Municipality/City",
            'type'      =>  'select', // the db column for the foreign key
            'entity'    =>  'location', // the method that defines the relationship in your Model
            'attribute' =>  'name', // foreign key attribute that is shown to user
            'model'     =>  "App\Models\Location" // foreign key model
        ]);

        CRUD::addColumn([
            'label'     => "Baranggay",
            'type'      => 'select',
            'name'      => 'baranggay_id',
            'entity'    => 'baranggay',
            'attribute' => 'name',
            'model'     => 'App\Models\Baranggay'
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
        
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BusinessRequest::class);

        CRUD::addField([
            'name' => 'name', //database column name
            'label' => 'Business Name', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
            'name' => 'branch_name', //database column name
            'label' => 'Branch Name', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
            'name' => 'nature',
            'label' => 'Business Nature',
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
            'name' => 'slug',
            'label' => 'Slug (URL)',
            'type' => 'text',
            'hint' => 'Will be automatically generated from your name',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
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

        CRUD::addField([
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
                'class' => 'form-group col-md-8'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
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

        CRUD::addField([
            'name' => 'address2', //database column name
            'label' => 'Address Line 2', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Company Details',
        ]);
        
        CRUD::addField([
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

        CRUD::addField([
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
        
        CRUD::addField([
            'name' => 'contact_person', //database column name
            'label' => 'Contact Person', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
            'name' => 'telephone', //database column name
            'label' => 'Telephone No.', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
            'name' => 'mobile', //database column name
            'label' => 'Mobile No.', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
            'name' => 'email', //database column name
            'label' => 'Email', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
            'name' => 'website', //database column name
            'label' => 'Website', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
            'name' => 'facebook', //database column name
            'label' => 'Facebook', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
            'name' => 'twitter', //database column name
            'label' => 'Twitter', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
            'name' => 'instagram', //database column name
            'label' => 'Instagram', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);

        CRUD::addField([
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

        CRUD::addField([   // textarea
            'name' => 'history',
            'label' => 'History',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'description',
            'label' => 'Description',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'about',
            'label' => 'About',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'purpose',
            'label' => 'Purpose',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'mission',
            'label' => 'Mission',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'vission',
            'label' => 'Vision',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'core_values',
            'label' => 'Core Values',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'goals',
            'label' => 'Business Goals',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'key_process',
            'label' => 'Key Process',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'scope_of_work',
            'label' => 'Scope of Work',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'branches',
            'label' => 'Branches',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'product_services',
            'label' => 'Product $ Services',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([
            'name' => 'logo',
            'label' => 'Logo',
            'type' => 'image',
            'tab' => 'Company Profile'
        ]);

        CRUD::addField([
            'name' => 'image_gallery',
            'label' => 'Image Gallery',
            'type' => 'upload_multiple',
            'upload' => true,
            'tab' => 'Company Profile'
        ], 'both');

        CRUD::addField([   // textarea
            'name' => 'ad_promotion',
            'label' => 'Ad/Promotion',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
            'name' => 'latitude',
            'label' => 'Latitude',
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);

        CRUD::addField([   // textarea
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

    public function update()
    {
        // Abort If Has No Permission To Update Business
        Permission::hasPermissionOr401('update business');

        $id         =   CRUD::getRequest()->id;
        $business   =   Business::findOrFail($id);

        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        $response = $this->traitUpdate();
        // do something after save
        return $response;
    }

    public function destroy($id)
    {
        // Abort If Has No Permission To Delete Business
        Permission::hasPermissionOr401('delete business');

        $business   =   Business::findOrFail($id);

        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);
        
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

    public function publish()
    {
        // Abort If Has No Permission To Publish Business
        Permission::hasPermissionOr401('publish business');

        $id = request('publish_business_id');
        $business   =   Business::findOrFail($id);

        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        if($business->drafted == 1){
            $business->drafted = 0;
            if($business->update())
            {
                $log = new Log();
                $log->business_id =  $id;
                $log->action = "Published";
                $log->start_at = $business->start_at;
                $log->end_at = $business->end_at;
                $log->save();

                $sale = Sale::where('business_id', $id)->first();
                $sale->paid = 0;
                $sale->complimentary = 0;
                $sale->update();

                \Alert::success('Business Published  <br> The business has been published successfully.')->flash();
                return \Redirect::to($this->crud->route);
            }
        }

        \Alert::error('Error Publishing, Something Went Wrong, Please Try Again.')->flash();
        return \Redirect::to($this->crud->route);
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
            \Alert::success('Business Verified <br> The business has been verified successfully.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else
        {
            \Alert::error('Error Verifying, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }
    
}
