<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LogRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LogCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class LogCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Log');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/log');
        $this->crud->setEntityNameStrings('log', 'logs');
        $this->crud->denyAccess('create');
        $this->crud->denyAccess('update');
        $this->crud->denyAccess('delete');

        if(!backpack_user()->hasPermissionTo('access log'))
        {
            CRUD::denyAccess('list');
        }
        if(!backpack_user()->hasPermissionTo('read log'))
        {
            CRUD::denyAccess('show');
        }
    }

    protected function setupListOperation()
    {
        // $this->crud->addColumn([
        //     'label' => "Business",
        //     'type' => 'select',
        //     'name' => 'business_id',
        //     'entity' => 'business',
        //     'attribute' => 'name',
        //     'model' => 'App\Models\Business'
        // ]);

        $this->crud->addColumn([
            'label' => "Business",
            'type' => 'text',
            'name' => 'business.name',
        ]);

        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        $this->crud->addColumn([
            'label' => "Action Time",
            'type' => 'date',
            'name' => 'created_at',
        ]);

        $this->crud->removeColumn('business_id');
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
            'label' => "Action Time",
            'type' => 'date',
            'name' => 'created_at',
        ]);
    }
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(LogRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
