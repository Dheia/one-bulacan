<?php

namespace App\Http\Controllers\BusinessPortal;

use App\Http\Requests\BusinessPortal\BusinessRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

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
class BusinessController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store  as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update  as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function fetchTag()
    {
        return $this->fetch(\App\Models\Tag::class);
    }

    public function setup()
    {  
        $this->user = Auth::guard('business-portal')->user();

        $id = \Route::current()->parameter('id');
        if($id)
        {
            if(!in_array($id, $this->user->businessOwner->businesses->pluck('id')->toArray()))
            {
                abort(404);
            }
        }

        CRUD::setModel('App\Models\Business');
        CRUD::setRoute(config('backpack.base.portal_route_prefix') . '/my-business');
        CRUD::setEntityNameStrings('business', 'My Businesses');
        
        CRUD::addClause('where', 'active', '=', '1');
        CRUD::addClause('where', 'drafted', '!=', '1');

        CRUD::denyAccess('create');
        CRUD::denyAccess('delete');
        CRUD::addClause('where', 'business_owner_id', $this->user->businessOwner->id);

        CRUD::allowAccess('add_product');
        CRUD::allowAccess('add_coupon');
        CRUD::addButtonFromView('line', 'Add Product', 'businessPortal.add_product', 'beginning');
        // CRUD::addButtonFromView('line', 'Add Coupon', 'businessPortal.add_coupon', 'beginning');

        // add a button whose HTML is returned by a method in the CRUD model
        $this->crud->addButtonFromModelFunction('line', 'previewPage', 'previewPage', 'beginning');

        $this->data['$breadcrumbs'] = ['Business Portal' => 'dashboard'];

        CRUD::setListView('businessPortal.business.list');
        CRUD::setShowView('businessPortal.show');
        CRUD::setEditView('businessPortal.edit');

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
            'name'  => 'formatted_business_id',
            'label' => "Business ID",
            'type'  => 'text', 
        ]);
        CRUD::addColumn([
            'name'  => 'logo',
            'label' => "Logo",
            'type'  => 'image',
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
            'name'  => 'start_at',
            'label' => 'Start',
            'type'  => "date",
        ]);
        CRUD::addColumn([
            'name'  => 'end_at',
            'label' => 'End',
            'type'  => "date",
        ]);
        CRUD::addColumn([
            'name'  => 'verified',
            'label' => 'Verified',
            'type'  => 'boolean',
            // optionally override the Yes/No texts
            'options' => [0 => 'Not Verified', 1 => 'Verified']
        ]);
        CRUD::addColumn([
            'name'  => 'featured', // The db column name
            'label' => 'Featured',
            'type'  => 'boolean',
            // optionally override the Yes/No texts
            'options' => [0 => 'No', 1 => 'Yes']
         ]);
        
        
       
        
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        
    }
    
    protected function setupShowOperation()
    {
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
            'type'  => 'text', 
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
            'type'  => 'status', 
        ]);
    }

    public function show($id)
    {
        if(!in_array($id, $this->user->businessOwner->businesses->pluck('id')->toArray()))
        {
            abort(404);
        }
        // custom logic before
        $content = $this->traitShow($id);
        // cutom logic after
        return $content;
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
                'class'     => 'form-control some-class',
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
        // CRUD::addField([
        //     'label' => "Tags",
        //     // 'type' => 'select2_category_multiple',
        //     'type' => 'select2_multiple',
        //     'name' => 'tag',
        //     'entity' => 'tag',
        //     'attribute' => 'name',
        //     // 'allows_null' => false,
        //     'model' => 'App\Models\Tag',
        //     'pivot' => 'true',
        //     'wrapper' => [
        //         'class' => 'form-group col-md-4'
        //     ],
        //     'tab' => 'Company Details',
        // ]);
        CRUD::addField([   // relationship
            'type' => "relationship",
            'name' => 'tag', // the method on your model that defines the relationship

            // OPTIONALS:
            'label' => "Tags One-Portal",
            'attribute' => "name", // foreign key attribute that is shown to user (identifiable attribute)
            'entity' => 'tag', // the method that defines the relationship in your Model
            'model' => "App\Models\Tag", // foreign key Eloquent model
            'placeholder' => "Select a tag", // placeholder for the select2 input
            'ajax'          => true,
            'inline_create' => [ 
                'entity' => 'business-tag'
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
            'type' => 'businessPortal.select_municipality',
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
            'aspect_ratio' => 1,
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
        // CRUD::addField([   // textarea
        //     'name' => 'start_at',
        //     'label' => 'Start',
        //     'type' => 'datetime',
        //     'default' => Carbon::now(),
        //     'attributes' => [
        //         'class' => 'form-control some-class',
        //         'readonly'=>'readonly',
        //         'disabled'=>'disabled',
        //     ],
        //     'wrapper' => [
        //         'class' => 'form-group col-md-6'
        //     ],
        //     'tab' => 'Company Profile',
        // ]);
        // CRUD::addField([   // textarea
        //     'name' => 'end_at',
        //     'label' => 'End',
        //     'type' => 'datetime',
        //     'default' => Carbon::now()->addMonths(12),
        //     'attributes' => [
        //         'class' => 'form-control some-class',
        //         'readonly'=>'readonly',
        //         'disabled'=>'disabled',
        //     ],
        //     'wrapper' => [
        //         'class' => 'form-group col-md-6'
        //     ],
        //     'tab' => 'Company Profile',
        // ]);
        
        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
       
    }
    
    protected function setupUpdateOperation()
    {
        $id = \Route::current()->parameter('id');
        if(!in_array($id, $this->user->businessOwner->businesses->pluck('id')->toArray()))
        {
            abort(404);
        }
        $this->setupCreateOperation();
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

    public function store()
    {
        abort(401);
        // do something before validation, before save, before everything; for example:
        // $this->crud->request->request->add(['author_id'=> backpack_user()->id]);
        $this->crud->request->request->add(['start_at'=> Carbon::now(), 'end_at'=>Carbon::now()->addMonths(12)]);
        $this->crud->request->request->add(['featured'=> 0, 'active'=> 0]);
        // CRUD::addField(['type' => 'hidden', 'name' => 'author_id']);
        // $this->crud->request->request->remove('password_confirmation');
        // $this->crud->removeField('password_confirmation');
        
        $response           =   $this->traitStore();
        $business           =   Business::where('id', $this->crud->entry->id)->first();
        $business->active   =   1;
        $business->drafted  =   0;
        $business->verified =   0;
        $business->start_at =   Carbon::now();
        $business->end_at   =   Carbon::now()->addMonths(12);
        $business->featured =   0;

        if($business->update()){
            $log                =   new Log();
            $log->business_id   =   $business->id;
            $log->action        =   "Published";
            $log->start_at      =   $business->start_at;
            $log->end_at        =   $business->end_at;
            $log->save();
        }

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
        $id = request()->id;
        if(!in_array($id, $this->user->businessOwner->businesses->pluck('id')->toArray()))
        {
            abort(404);
        }

        $response = $this->traitUpdate();
        // do something after save
        return $response;
    }

    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');
        abort(404);

        $logo       =   Business::where('id', $id)->first();
        $logo_path  =   $logo->logo;  // Value is not URL but directory file path

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
    
}
