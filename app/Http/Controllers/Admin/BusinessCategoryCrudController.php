<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusinessCategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BusinessCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BusinessCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\BusinessCategory');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/businesscategory');
        $this->crud->setEntityNameStrings('businesscategory', 'business_categories');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access business category',
            'create'    =>  'create business category',
            'show'      =>  'read business category',
            'update'    =>  'update business category',
            'delete'    =>  'delete business category'
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

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'label' => 'Business',
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => "App\Models\BusinessCategory",
        ]);
        $this->crud->addColumn([
            'label' => 'Category',
            'type' => 'select',
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => "App\Models\BusinessCategory",
        ]);
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }
    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'label' => 'Business',
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => "App\Models\BusinessCategory",
        ]);
        $this->crud->addColumn([
            'label' => 'Business',
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => "App\Models\BusinessCategory",
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BusinessCategoryRequest::class);

        $this->crud->addField([
            'label' => 'Business',
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => "App\Models\BusinessCategory",
        ]);
        $this->crud->addField([
            'label' => 'Category',
            'type' => 'select',
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => "App\Models\BusinessCategory",
        ]);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
