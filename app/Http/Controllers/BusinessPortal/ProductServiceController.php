<?php

namespace App\Http\Controllers\BusinessPortal;

use App\Http\Requests\BusinessPortal\ProductServiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

use App\Models\Business;
use App\Models\ProductService;

use Alert;

/**
 * Class ProductServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductServiceController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store  as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update  as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {

        CRUD::setModel(\App\Models\ProductService::class);
        CRUD::setRoute(config('backpack.base.portal_route_prefix') . '/business-product-service');
        CRUD::setEntityNameStrings('Product Service', 'Product and Services');

        $this->user = Auth::guard('business-portal')->user();

        CRUD::addClause('whereIn', 'business_id', $this->user->businessOwner->businesses->pluck('id')->toArray());
        CRUD::denyAccess('show');

        $this->data['breadcrumbs'] = [
            'Portal' => 'dashboard',
            $this->crud->entity_name_plural => url($this->crud->route),
        ];

        CRUD::setListView('businessPortal.list');
        CRUD::setShowView('businessPortal.show');
        CRUD::setEditView('businessPortal.edit');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->data['breadcrumbs']['List'] = false;

        CRUD::removeButton('update');
        CRUD::removeButton('delete');
        CRUD::addButtonFromView('line', 'delete', 'businessPortal.delete_product_service', 'beginning');
        CRUD::addButtonFromView('line', 'update', 'businessPortal.update_product_service', 'beginning');
        if(request()->business_id)
        {
            $business = Business::where('id', request()->business_id)->first();
            if(!$business)
            {
                \Alert::error('Business not found.')->flash();
                abort(400, 'Business not found.');
            }
            if($business->business_owner_id != $this->user->businessOwner->id)
            {
                abort(401);
            }
        }
        // CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addColumn([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image',
            'height' => '30px',
            'width'  => '30px'
        ]);

        CRUD::addColumn([
            'label'     => 'Business', // Table column heading
            'type'      => 'select',
            'name'      => 'business_id', // the column that contains the ID of that connected entity;
            'entity'    => 'business', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\Business", // foreign key model
        ]);

        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name'  => 'price', // The db column name
            'label' => 'Price', // Table column heading
            'type'  => 'number',
            // 'prefix'        => 'PHP',
            'suffix'        => ' PHP',
            'decimals'      => 2,
            'dec_point'     => '.',
            'thousands_sep' => ', ',
        ]);

        CRUD::addColumn([
            'name' => 'description',
            'label' => 'Description',
            'type' => 'markdown'
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->data['breadcrumbs']['Add'] = false;

        $this->user = Auth::guard('business-portal')->user();
        if(request()->business_id)
        {
            $business = Business::where('id', request()->business_id)->first();
            if(!$business)
            {
                \Alert::error('Business not found.')->flash();
                abort(400, 'Business not found.');
            }
            if($business->business_owner_id != $this->user->businessOwner->id)
            {
                abort(401);
            }
        }

        CRUD::setValidation(ProductServiceRequest::class);

        // CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
        
        self::addFields();
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->data['breadcrumbs']['Edit'] = false;

        // $this->setupCreateOperation();
        self::addFields();

        if(!request()->business_id)
        {
            abort(400, 'Missing Required Parameter.');
        }
        $business = Business::where('id', request()->business_id)->first();
        if(!$business)
        {
            \Alert::error('Business not found.')->flash();
            abort(400, 'Business not found.');
        }
        if($business->business_owner_id != $this->user->businessOwner->id)
        {
            abort(401);
        }

        $id = \Route::current()->parameter('id');
        if($id)
        {
            $productService = ProductService::with('business')->where('id', $id)->first();

            if(!$productService)
            {
                \Alert::error('Product Service not found.')->flash();
                abort(400, 'Business not found.');
            }
            if(!$productService->business)
            {
                \Alert::error('Business not found.')->flash();
                abort(400, 'Business not found.');
            }
            if($productService->business->business_owner_id != $this->user->businessOwner->id)
            {
                abort(401);
            }
        }
    }

    public function store()
    {
        CRUD::setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);

        // CRUD::getRequest()->request->add([
        //     'business_id'  =>  CRUD::getRequest()->business_id,
        // ]);

        $response   =   $this->traitStore();
        // return $response;
        return redirect('one-portal/my-business');
    }

    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        if(!request()->business_id)
        {
            abort(400, 'Missing Required Parameter.');
        }
        $business = Business::where('id', request()->business_id)->first();
        if(!$business)
        {
            \Alert::error('Business not found.')->flash();
            abort(400, 'Business not found.');
        }
        if($business->business_owner_id != $this->user->businessOwner->id)
        {
            abort(401);
        }

        $productService = ProductService::findOrFail($id);
        
        if(!$productService->business)
        {
            \Alert::error('Business not found.')->flash();
            abort(400, 'Business not found.');
        }
        if($productService->business->business_owner_id != $this->user->businessOwner->id)
        {
            abort(401);
        }
        
        $image_path  =   $productService->image;  // Value is not URL but directory file path

        if(\File::exists($image_path)) {

            if($image_path != 'images/default_image.png')
            {
                \File::delete($image_path);
            }
        }
        return $this->crud->delete($id);
    }

    /** 
     * FIELDS
     * 
     * @see https://backpackforlaravel.com/docs/crud-fields
     */
    private function addFields()
    {
        if(!request()->business_id)
        {
            CRUD::addField([
                'label' => "Business",
                'type' => 'select2',
                'name' => 'business_id',
                'entity' => 'business',
                'attribute' => 'name',
                'allows_null' => false,
                'model' => 'App\Models\Business',
                'options'   => (function ($query) {
                    return $query->where('active', 1)->where('business_owner_id', $this->user->businessOwner->id)->get();
                }), 
                'wrapper' => [
                    'class' => 'form-group col-md-12'
                ]
            ]);
        }
        else{
            $business = Business::where('id', request()->business_id)->first();
            if(!$business)
            {
                abort(400, 'Business Not Found.');
            }
            if($business->business_owner_id != $this->user->businessOwner->id)
            {
                abort(401);
            }
            CRUD::addField([
                'label' => "Business",
                'type' => 'select2',
                'name' => 'business_id',
                'entity' => 'business',
                'attribute' => 'name',
                'allows_null' => false,
                'model' => 'App\Models\Business',
                'options'   => (function ($query) {
                    return $query->where('active', 1)->where('id', request()->business_id)->get();
                }), 
                'wrapper' => [
                    'class' => 'form-group col-md-12'
                ]
            ]);
        }

        CRUD::addField([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
        ]);

        CRUD::addField([
            'name' => 'description',
            'label' => 'Description',
            'type' => 'ckeditor',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
            'extra_plugins' => [
                'font', 
                'justify', 
                'colorbutton', 
                'colordialog'
            ]
        ]);

        CRUD::addField([
            'label' => 'Price',
            'name'  => 'price',
            'type'  => 'text',
            'wrapper'   => [ 
                'class'      => 'form-group col-md-12'
            ]
        ]);

        CRUD::addField([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 1,
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);
    }
}
