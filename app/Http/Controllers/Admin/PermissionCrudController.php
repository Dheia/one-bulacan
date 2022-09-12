<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Illuminate\Support\Facades\Auth;

/**
 * Class PermissionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PermissionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store  as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update  as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Permission::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/permission');
        CRUD::setEntityNameStrings('permission', 'permissions');

        // Permissions With Access
        $permissions = [
            'list'          =>  'access permission',
            'create'        =>  'create permission',
            'show'          =>  'read permission',
            'update'        =>  'update permission',
            'delete'        =>  'delete permission'
        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

        CRUD::orderBy('id', 'ASC');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PermissionRequest::class);

        CRUD::addField([   // select2_from_array
            'name'        => 'page_name',
            'label'       => "Page",
            'type'        => 'select2_from_array',
            'options'     => [
                'business' => 'Business', 
                'job' => 'Job', 
                'category' => 'Category', 
                'tag' => 'Tag'
            ],
            'allows_null' => false,
            'default'     => 'one',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]); 

        CRUD::addField([   // select2_from_array
            'name'        => 'name',
            'label'       => "Name",
            'type'        => 'select2_from_array',
            'options'     => [
                'create' => 'Create', 
                'read' => 'Read', 
                'update' => 'Update', 
                'delete' => 'Delete'
            ],
            'allows_null' => false,
            'default'     => 'one',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]); 

        if (config('backpack.permissionmanager.multiple_guards')) {
            CRUD::addField([
                'name'    => 'guard_name',
                'label'   => trans('backpack::permissionmanager.guard_type'),
                'type'    => 'select_from_array',
                'options' => $this->getGuardTypes(),
            ]);
        }
        else {
             CRUD::addField([
                'name'    => 'guard_name',
                'label'   => trans('backpack::permissionmanager.guard_type'),
                'type'    => 'hidden',
                'value' => 'backpack',
            ]);
        }

        // CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        // Abort If Has No Permission To Update Permission
        Permission::hasPermissionOr401('update permission');

        $this->setupCreateOperation();
    }

    public function store()
    {
        CRUD::getRequest()->request->add(['name'=> CRUD::getRequest()->name . ' ' . CRUD::getRequest()->page_name]);
        // dd(CRUD::getRequest()->guard_name);
        $response = $this->traitStore();
        // do something after save
        return $response;
    }

    public function update()
    {
        // Abort If Has No Permission To Update Permission
        Permission::hasPermissionOr401('update permission');

        CRUD::getRequest()->request->add(['name'=> CRUD::getRequest()->name . ' ' . CRUD::getRequest()->page_name]);
        $response = $this->traitUpdate();
        // do something after save
        return $response;
    }

    /**
     * Delete the specified resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Abort If Has No Permission To Update Permission
        Permission::hasPermissionOr401('delete permission');

        $this->crud->hasAccessOrFail('delete');

        return $this->crud->delete($id);
    }

    /*
     * Get an array list of all available guard types
     * that have been defined in app/config/auth.php
     *
     * @return array
     **/
    private function getGuardTypes()
    {
        $guards = config('auth.guards');

        $returnable = [];
        foreach ($guards as $key => $details) {
            $returnable[$key] = $key;
        }

        return $returnable;
    }
}
