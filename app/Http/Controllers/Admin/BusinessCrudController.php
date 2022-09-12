<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusinessRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Permission;

use App\Models\Location;
use App\Models\BusinessOwner;
use App\Models\Business;
use App\Models\FeaturedBusiness;
use App\Models\Baranggay;
use App\Models\BusinessCategory;
use App\Models\BusinessTag;
use App\Models\Category;
use App\Models\Log;
use App\Models\Sale;
use Carbon\Carbon;
use DB;
use Alert;

use Mail;
use App\Mail\SendEmail;
/**
 * Class BusinessCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BusinessCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store  as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update  as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    // use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function fetchTag()
    {
        return $this->fetch(\App\Models\Tag::class);
    }

    public function setup()
    {
        $this->crud->setModel('App\Models\Business');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/business');
        $this->crud->setEntityNameStrings('business', 'businesses');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access business',
            'create'    =>  'create business',
            'show'      =>  'read business',
            'update'    =>  'update business',
            'delete'    =>  'delete business',
        ];

        $extraPermissions = [
            'dti'   =>  'verify business',
            'verified'  =>  'verify business',
            'featured'  =>  'create featured business',
            'draft'     =>  'draft business',
            'published_renew'   =>  'renew business',
            'add_product'   =>  'create business product-services'
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
        
        /**
         * 
         * DISPLAY DATA FOR WIDGETS / ANALYTICS
         *
         */

        $this->data['active_businesses']        =   Business::getReferrerActiveBusinesses();
        $this->data['pending_businesses']       =   Business::getReferrerPendingBusinesses();
        $this->data['forrenewal_businesses']    =   FeaturedBusiness::getReferrerRenewalFeatured();
        $this->data['expired_businesses']       =   FeaturedBusiness::getReferrerExpiredFeatured();
        // $this->data['forrenewal_businesses']    =   Business::getReferrerRenewalBusinesses();
        // $this->data['expired_businesses']       =   Business::getReferrerExpiredBusinesses();

        CRUD::addClause('where', 'active', '=', '1');
        CRUD::addClause('where', 'drafted', '!=', '1');

        // If Not Super-Admin Filter Businesses
        if(!backpack_user()->hasPermissionTo('access all business'))
        {
            CRUD::addClause('where', 'referrer_user_id', '=', backpack_user()->id);
        }

        // Dropdown Button / More Button
        $this->crud->data['dropdownButtons'] = [
            'show',
            'business.dti',
            'business.verify',
            'business.feature',
            'business.draft',
            'business.published_renew',
        ];
        CRUD::addButtonFromView('line', 'More', 'dropdownButton', 'beginning');
        CRUD::addButtonFromView('line', 'Add Product', 'business.add_product', 'beginning');

        CRUD::enableExportButtons();
        CRUD::setListView('business.business_list');
    }

    /**
     *
     * BUSINESS LIST
     *
     */
    protected function setupListOperation()
    {
        CRUD::removeButton('show');
        CRUD::addColumn([
            'name'  => 'name',
            'label' => "Name",
            'type'  => 'markdown',
            'searchLogic'   => function ($query, $column, $searchTerm) {
                $query->orWhere('name', 'like', '%'.$searchTerm.'%');
            },
            'visibleInExport' => true,
            'visibleInTable' => true
        ]);
        CRUD::addColumn([
            'name'  => 'formatted_business_id',
            'label' => "Business ID",
            'type'  => 'markdown', 
            'visibleInExport' => true,
            'visibleInTable' => true
        ]);
        CRUD::addColumn([
            'name'  => 'logo',
            'label' => "Logo",
            'type'  => 'image',
            'visibleInExport' => false,
            'visibleInTable' => true
        ]);
        CRUD::addColumn([
            'name'  => 'telephone',
            'label' => "Telephone",
            'type'  => 'phone', 
            'visibleInExport' => true,
            'visibleInTable' => false
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
        CRUD::addColumn([
            'name'  => 'complete_address',
            'label' => "Complete Address",
            'type'  => 'markdown', 
            'searchLogic'   => function ($query, $column, $searchTerm) {
                $query->orWhere('address1', 'like', '%'.$searchTerm.'%')
                    ->orWhereHas('baranggay', function ($q) use ($column, $searchTerm) {
                        $q->where('name', 'like', '%'.$searchTerm.'%');
                    })->orWhereHas('location', function ($q) use ($column, $searchTerm) {
                        $q->where('name', 'like', '%'.$searchTerm.'%');
                    });

            },
            'visibleInExport' => true,
            'visibleInTable' => false
        ]);
        CRUD::addColumn([
            'name'  => 'start_at',
            'label' => 'Start',
            'type'  => "date",
            'visibleInExport' => true,
            'visibleInTable' => true
        ]);
        CRUD::addColumn([
            'name'  => 'end_at',
            'label' => 'End',
            'type'  => "date",
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
                    if ($column['text'] == 'LISTED') {
                        return 'badge badge-default';
                    }
                    if ($column['text'] == 'PREMIUM') {
                        return 'badge badge-success';
                    }
                    if ($column['text'] == 'PREMIUM FOR RENEWAL') {
                        return 'badge badge-warning';
                    }
                    if ($column['text'] == 'PREMIUM EXPIRED') {
                        return 'badge badge-danger';
                    }
                    return 'badge badge-default';
                },
            ],
            'visibleInExport' => true,
            'visibleInTable' => true
        ]);
        CRUD::addColumn([
            'name'  => 'verified',
            'label' => 'Verified',
            'type'  => 'boolean',
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
        
        /*
        |--------------------------------------------------------------------------
        | FILTERS
        |--------------------------------------------------------------------------
        */
        CRUD::addFilter([ // select2 filter
            'name'  => 'location_id',
            'type'  => 'select2_multiple',
            'label' => 'Municipality/City',
        ], function() {
            return \App\Models\Location::all()->pluck('name', 'id')->toArray();
        }, function($values) { // if the filter is active
                $this->crud->addClause('whereIn', 'location_id', json_decode($values));
        });

        CRUD::addFilter([ // select2 filter
            'name'  => 'featured',
            'type'  => 'dropdown',
            'label' => 'Featured',
        ], [
            1 => 'Featured',
            0 => 'Not Featured',
        ], function($value) { // if the filter is active
                $this->crud->addClause('where', 'featured', $value);
        });

        CRUD::addFilter([ // select2 filter
            'name'  => 'verified',
            'type'  => 'dropdown',
            'label' => 'Verified',
        ], [
            1 => 'Verified',
            0 => 'Not Verified'
        ], function($value) { // if the filter is active
                $this->crud->addClause('where', 'verified', $value);
        });
        
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
    
    /**
     *
     * SHOW
     *
     */
    protected function setupShowOperation()
    {
        // Abort If Has No Permission To Read Business
        Permission::hasPermissionOr403('read business');

        CRUD::addColumn([
            'name'  => 'formatted_business_id',
            'label' => "Business ID",
            'type'  => 'text', 
        ]);

        CRUD::addColumn([
            'name'  => 'name',
            'label' => "Name",
            'type'  => 'text', 
        ]);

        CRUD::addColumn([
            'name'  => 'link',
            'label' => "Link",
            'type'  => 'markdown', 
            'prefix' => "http://onepampanga.com/",
        ]);

        CRUD::addColumn([
            'name'  => 'logo',
            'label' => "Logo",
            'type'  => 'image',
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
            'label'     => "Category",
            'type'      => 'select',
            'name'      => 'category_id',
            'entity'    => 'category',
            'attribute' => 'name',
            'model'     => 'App\Models\Category'
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
            'name'  => 'verified',
            'label' => 'Verified',
            'type'  => 'boolean',
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
        ]);
        CRUD::addColumn([
            'name'  => 'drafted', // The db column name
            'label' => 'Drafted',
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
         ]);

        CRUD::addColumn([
            'name'  => 'active', // The db column name
            'label' => 'Active',
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

        CRUD::addField([
            'name'  => 'name', //database column name
            'label' => 'Business Name', //Label
            'type'  => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        CRUD::addField([
            'name'  => 'branch_name', //database column name
            'label' => 'Branch Name', //Label
            'type'  => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        CRUD::addField([
            'label' => "Business Owner",
            'type' => 'select2',
            'name' => 'business_owner_id',
            'entity' => 'owner',
            'attribute' => 'fullname',
            'allows_null' => true,
            'model' => 'App\Models\BusinessOwner',
            'options'   => (function ($query) {
                return $query->where('active', 1)->get();
            }), 
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Company Details',
        ]);
        CRUD::addField([
            'name'  => 'nature',
            'label' => 'Business Nature',
            'type'  => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Details',
        ]);
        CRUD::addField([
            'name'  => 'slug',
            'label' => 'Slug (URL)',
            'type'  => 'text',
            'hint'  => 'Will be automatically generated from your name',
            'attributes' => [
                'class'     => 'form-control',
                'readonly'  =>'readonly',
                'disabled'  =>'disabled',
              ],
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
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        CRUD::addField([   // relationship
            'type' => "relationship",
            'name' => 'tag', // the method on your model that defines the relationship

            // OPTIONALS:
            'label' => "Tags Admin",
            'attribute' => "name", // foreign key attribute that is shown to user (identifiable attribute)
            'entity' => 'tag', // the method that defines the relationship in your Model
            'model' => "App\Models\Tag", // foreign key Eloquent model
            'placeholder' => "Select a tag", // placeholder for the select2 input
            'ajax'          => true,
            'inline_create' => [ 
                'entity' => 'tag'
            ],
            'wrapper' => [
                'class' => 'form-group col-md-4'
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
            'prefix' => '@',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Company Details',
        ]);
        CRUD::addField([
            'name' => 'instagram', //database column name
            'label' => 'Instagram', //Label
            'type' => 'text',
            'prefix' => '@',
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

        // MAP CUSTOM FIELDS

        CRUD::addField([   // textarea
            'name' => 'map',
            'label' => 'Set Map',
            'type' => 'map',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'tab' => 'Company Details',
        ])->afterField('baranggay_id');


        CRUD::addField([   // textarea
            'name' => 'history',
            'label' => 'History',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
            'extra_plugins' => ['justify', 'font', 'colorbutton', 'colordialog'],
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
            'name' => 'ad_promotion',
            'label' => 'Ad/Promotion',
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
            'tab' => 'Company Profile',
            'crop' => true,
            // 'aspect_ratio' => 1,
             'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);
        CRUD::addField([
            'name' => 'image_gallery',
            'label' => 'Image Gallery',
            'type' => 'upload_multiple',
            'upload' => true,
            'tab' => 'Company Profile'
        ], 'both');
        CRUD::addField([   // textarea
            'name' => 'latitude',
            'label' => 'Latitude',
            'type' => 'hidden',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Company Profile',
        ]);
        CRUD::addField([   // textarea
            'name' => 'longitude',
            'label' => 'Longitude',
            'type' => 'hidden',
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
        
        Business::referredByUserOr403($this->data['entry']->referrer_user_id);

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getEditView(), $this->data);
    }

    public function store()
    {
        // Abort If Has No Permission To Create Business
        Permission::hasPermissionOr401('create business');
        // dd(request()->map);
        CRUD::setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);

        CRUD::getRequest()->request->add([
            'referrer_user_id'  =>  backpack_user()->id,
            'start_at'          =>  Carbon::now(),
            'end_at'            =>  Carbon::now()->addMonths(12),
            'lenght_of_time'    =>  '1year',
            'featured'          =>  0,
            'drafted'           =>  0,
            'dti'               =>  0,
            'active'            =>  1
        ]);

        $response           =   $this->traitStore();

        // CREATE LOG
        $log                =   new Log();
        $log->business_id   =   $this->crud->entry->id;
        $log->action        =   "Published";
        $log->start_at      =   $this->crud->entry->start_at;
        $log->end_at        =   $this->crud->entry->end_at;
        $log->save();

        $sale                   =   new Sale();
        $sale->business_id      =   $this->crud->entry->id;
        $sale->paid             =   0;
        $sale->emailed          =   0;
        $sale->messaged         =   0;
        $sale->notified         =   0;
        $sale->complimentary    =   0;
        $sale->save();
        // do something after save
        // Send Email to the Business Email
        // Mail::to(request('email'))->send(new SendEmail($business));
        return $response;
    }

    public function update()
    {
        // Abort If Has No Permission To Create Business
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

        $business   =   Business::findOrFail($id);

        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        $logo_path  =   $business->logo;  // Value is not URL but directory file path

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

    public function getBaranggays()
    {
        $baranggays = Baranggay::where('location_id', request()->municipality_id)->get();
        return $baranggays;
    }

    public function getCategories()
    {
        $categories = Category::where('parent_id', request()->parent_id)->get();
        return $categories;
    }

    public function verify($id)
    {
        // Abort If Has No Permission To Verify Business
        Permission::hasPermissionOr401('verify business');

        $business  =   Business::findOrFail($id);

        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        $business->verified =   1;
            
        if($business->update())
        {
            \Alert::success('Successfully Verified <br> The business has been verified successfully.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else
        {
            \Alert::error('Error Verifying, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function dti($id)
    {
        // Abort If Has No Permission To Verify Business
        Permission::hasPermissionOr401('verify business');

        $business  =   Business::findOrFail($id);
        
        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);
        
        $business->dti  =   1;

        if($business->update()){
            \Alert::success('Successfully Verified the DTI.')->flash();
            return \Redirect::to($this->crud->route);
        } else{
            \Alert::error('Error Verifying, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function unverify($id)
    {
        // Abort If Has No Permission To Verify Business
        Permission::hasPermissionOr401('verify business');

        $business  =   Business::findOrFail($id);
        
        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        $business->verified =   0;

        if($business->update()){
            \Alert::success('Successfully Unverified.')->flash();
            return \Redirect::to($this->crud->route);
        } else{
            \Alert::error('Error Unverifying, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function draft($id)
    {
        // Abort If Has No Permission To Verify Business
        Permission::hasPermissionOr401('draft business');

        $business  =   Business::findOrFail($id);
        
        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        $business->drafted      =   1;
        $business->verified     =   0;

        if($business->update()){
            $log                =   new Log();
            $log->business_id   =   $id;
            $log->action        =   "Drafted";
            $log->save();

            \Alert::success('Successfully Drafted.')->flash();
            return \Redirect::to($this->crud->route);
        } else{
            \Alert::error('Error Drafting, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function feature()
    {
        // Abort If Has No Permission To Verify Business
        Permission::hasPermissionOr401('create featured business');

        $id         =   request('featured_business_id');
        $business   =   Business::findOrFail($id);
        
        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        $business->featured     = 1;
        $business->listing_type = 'premium';

        if($business->update())
        {
            $featuredBusiness = new FeaturedBusiness();
            $featuredBusiness->business_id  = $id;
            $featuredBusiness->start_at     = Carbon::now();
            $featuredBusiness->end_at = Carbon::now()->addMonths(12);
            $featuredBusiness->lenght_of_time   = '1year';
            $featuredBusiness->isActive         = 1;
            $featuredBusiness->save();

            $log                =   new Log();
            $log->business_id   =   $id;
            $log->action        =   "Featured";
            $log->start_at      =   $featuredBusiness->start_at;
            $log->end_at        =   $featuredBusiness->end_at;
            $log->save();

            \Alert::success('Successfully Featured.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else
        {
            \Alert::error('Error Featuring, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function published_renew()
    {
        // Abort If Has No Permission To Verify Business
        Permission::hasPermissionOr401('renew business');

        $id        =   request('renew_business_id');
        $business  =   Business::findOrFail($id);
        
        // Abort If Not Referred By User
        Business::referredByUserOr401($business->referrer_user_id);

        $log                =   new Log();
        $log->business_id   =   $business->id;
        $log->action        =   "Published Renew";

        if($business->end_at <= Carbon::now() || $business->active == 0){
            $business->start_at         = Carbon::now();
            $business->lenght_of_time   = request('renew_lenght_of_time');
            $business->active           = 1;

            if (request('renew_lenght_of_time') == '1year'){
                $business->end_at = Carbon::now()->addMonths(12);
            }

            $log->start_at  =   $business->start_at;
            $log->end_at    =   $business->end_at;
        }
        else{
            $log->start_at  =   $business->end_at;

            if (request('renew_lenght_of_time') == '1year'){
                $business->end_at   =   $business->end_at->addMonths(12);
            }
            $business->lenght_of_time   =   request('renew_lenght_of_time');
            $business->active           =   1;

            $log->end_at                =   $business->end_at;
        }
        if($business->update()){
            $sale                   =   Sale::where('business_id', $id)->first();
            $sale->paid             =   0;
            $sale->complimentary    =   0;
            $sale->update();

            $log->save();
            \Alert::success('Successfully Renew.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else
        {
            \Alert::error('Error Renewing, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }
    
}
