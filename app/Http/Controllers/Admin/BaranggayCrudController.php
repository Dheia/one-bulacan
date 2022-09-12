<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BaranggayRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Location;
use App\Models\Permission;

/**
 * Class BaranggayCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BaranggayCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store  as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update  as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Baranggay');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/baranggay');
        $this->crud->setEntityNameStrings('baranggay', 'baranggays');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access barangay',
            'create'    =>  'create barangay',
            'show'      =>  'read barangay',
            'update'    =>  'update barangay',
            'delete'    =>  'delete barangay'
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
            'name' => 'name', //database column name
            'label' => 'Name', //Label
            'type' => 'text',
        ]);
        $this->crud->addColumn([  // Select
            'label' => "Municipality/City",
            'type' => 'select',
            'name' => 'location_id', // the db column for the foreign key
            'entity' => 'location', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Building" // foreign key model
         ]);
        $this->crud->addFilter([ // select2 filter
            'name' => 'location_id',
            'type' => 'select2',
            'label'=> 'Municipality/City',
        ], function() {
            return \App\Models\Location::all()->pluck('name', 'id')->toArray();
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'location_id', $value);
        });
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
    }
    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'name' => 'name', //database column name
            'label' => 'Name', //Label
            'type' => 'text',
        ]);
        $this->crud->addColumn([  // Select
            'label' => "Municipality/City",
            'type' => 'select',
            'name' => 'location_id', // the db column for the foreign key
            'entity' => 'location', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Location" // foreign key model
         ]);
        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BaranggayRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Store the specified resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        // Abort If Has No Permission To Create Barangay
        Permission::hasPermissionOr401('create barangay');
        
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
        // Abort If Has No Permission To Update Barangay
        Permission::hasPermissionOr401('update barangay');
        
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
        // Abort If Has No Permission To Delete Barangay
        Permission::hasPermissionOr401('delete barangay');

        return $this->crud->delete($id);
    }
}
