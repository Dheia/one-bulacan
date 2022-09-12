<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LocationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Location;
use App\Models\Permission;

/**
 * Class LocationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class LocationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store  as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update  as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Location');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/location');
        $this->crud->setEntityNameStrings('location', 'locations');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access location',
            'create'    =>  'create location',
            'show'      =>  'read location',
            'update'    =>  'update location',
            'delete'    =>  'delete location'
        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

        $this->crud->orderBy('name','asc');
    }

    protected function setupListOperation()
    {
        if(!backpack_user()->hasRole('Super-Admin'))
        {
            abort(401);
        }
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        if(!backpack_user()->hasRole('Super-Admin'))
        {
            abort(401);
        }
        $this->crud->setValidation(LocationRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        if(!backpack_user()->hasRole('Super-Admin'))
        {
            abort(401);
        }
        $this->setupCreateOperation();
    }


    /**
     * Store the specified resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        if(!backpack_user()->hasRole('Super-Admin'))
        {
            abort(401);
        }
        
        $response           =   $this->traitStore();
        // do something after save
        return $response;
    }

    /**
     * Update the specified resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        // Abort If Has No Permission To Update Location
        Permission::hasPermissionOr401('update location');
        
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
        // Abort If Has No Permission To Delete Location
        Permission::hasPermissionOr401('delete location');

        $this->crud->hasAccessOrFail('delete');

        return $this->crud->delete($id);
    }
}
