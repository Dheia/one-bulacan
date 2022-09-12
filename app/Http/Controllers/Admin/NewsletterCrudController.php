<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsletterRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NewsletterCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class NewsletterCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Newsletter');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/newsletter');
        $this->crud->setEntityNameStrings('newsletter', 'newsletters');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access newsletter',
            'create'    =>  'create newsletter',
            'show'      =>  'read newsletter',
            'update'    =>  'update newsletter',
            'delete'    =>  'delete newsletter'
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
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(NewsletterRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
