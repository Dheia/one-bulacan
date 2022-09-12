<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobCategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class JobCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class JobCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\JobCategory');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/jobcategory');
        $this->crud->setEntityNameStrings('jobcategory', 'job_categories');
        
        // Permissions With Access
        $permissions = [
            'list'      =>  'access job category',
            'create'    =>  'create job category',
            'show'      =>  'read job category',
            'update'    =>  'update job category',
            'delete'    =>  'delete job category'
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
            'label' => 'Name',
            'type' => 'text',
            'name' => 'name',
        ]);

        // $this->crud->addColumn([
        //     'label' => 'Parent',
        //     'type' => 'select',
        //     'name' => 'parent_id',
        //     'entity' => 'parent',
        //     'attribute' => 'name',
        //     'model' => "App\Models\JobCategory",
        // ]);
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        $this->crud->removeColumn('logo');
        $this->crud->removeColumn('parent_id');
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'label' => 'Name',
            'type' => 'text',
            'name' => 'name',
        ]);

        $this->crud->addColumn([
            'label' => 'Parent',
            'type' => 'select',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => "App\Models\JobCategory",
        ]);
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        $this->crud->removeColumn('logo');
        $this->crud->removeColumn('parent_id');
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(JobCategoryRequest::class);

        $this->crud->addField([
            'label' => 'Name',
            'type' => 'text',
            'name' => 'name',
        ]);

        // $this->crud->addField([
        //     'label' => 'Parent',
        //     'type' => 'select2',
        //     'name' => 'parent_id',
        //     'entity' => 'parent',
        //     'attribute' => 'name',
        //     'model' => "App\Models\JobCategory",
        //     'options'   => (function ($query) {
        //         return $query->where('parent_id', null)->get();
        //     }), 
        // ]);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
        $this->crud->removeField('logo');
        $this->crud->removeField('parent_id');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
