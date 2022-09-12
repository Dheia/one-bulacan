<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductServiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Business;
use App\Models\Permission;
use App\Models\ProductService;

use Alert;

/**
 * Class ProductServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductServiceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store  as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation { destroy as traitDestroy; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ProductService::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product-service');
        CRUD::setEntityNameStrings('Product Service', 'Product and Services');

        // Permissions With Access
        $permissions = [
            'list'          =>  'access business product-services',
            'create'        =>  'create business product-services',
            'show'          =>  'read business product-services',
            'update'        =>  'update business product-services',
            'delete'        =>  'delete business product-services'
        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
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
        CRUD::setValidation(ProductServiceRequest::class);

        // CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
        if(request()->business_id)
        {
            $business   =   Business::findOrFail(request()->business_id);

            // Abort If Not Referred By User
            Business::referredByUserOr403($business->referrer_user_id);

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
        else
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
                    if(!backpack_user()->hasrole('Super-Admin'))
                    {                    
                        return $query->where('active', 1)->where('referrer_user_id', backpack_user()->id)->get();
                    }
                    else
                    {
                        return $query->where('active', 1)->get();
                    }
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
                'class' => 'form-group col-md-6'
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

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        $business   =   Business::findOrFail($this->crud->getRequest()->business_id);
        Business::referredByUserOr403($business->referrer_user_id);

        $response   =   $this->traitStore();
        // Update The Selected Business in Algolia
        $updateBusiness   =   Business::updateRecord($business->id);
        return $response;
    }

    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        $id             =   $this->crud->getRequest()->id;
        $productService =   ProductService::findOrFail($id);
        $oldBusiness    =   Business::findOrFail($productService->business_id);
        $newBusiness    =   Business::findOrFail(request()->business_id);

        // Abort If The Old or New Selected Business is Not Referred By User
        Business::referredByUserOr403($oldBusiness->referrer_user_id);
        Business::referredByUserOr403($newBusiness->referrer_user_id);

        // Update 
        $response       =   $this->traitUpdate();

        // Update The Old & New Selected Business in Algolia
        $updateOldBusiness =   Business::updateRecord($oldBusiness->id);
        $updateNewBusiness =   Business::updateRecord($newBusiness->id);

        return $response;
    }

    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');
        
        // Abort If Has No Permission To Delete Business Product
        Permission::hasPermissionOr401('delete business product-services');

        $productService  =   ProductService::findOrFail($id);
        $business        =   Business::findOrFail($productService->business_id);

        // Abort If Not Referred By User
        Business::referredByUserOr403($business->referrer_user_id);

        $this->crud->delete($id);

        return Business::updateRecord($business->id);
    }
}
