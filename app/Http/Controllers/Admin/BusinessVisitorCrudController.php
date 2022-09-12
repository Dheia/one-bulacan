<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusinessVisitorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BusinessVisitorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BusinessVisitorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\BusinessVisitor');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/businessvisitor');
        $this->crud->setEntityNameStrings('businessvisitor', 'business visitors');
        $this->crud->denyAccess('create');
        $this->crud->denyAccess('update');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access business visitor',
            'show'      =>  'read business visitor',
            'delete'    =>  'delete business visitor'
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
            'label' => "Business",
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business'
        ]);
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BusinessVisitorRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
