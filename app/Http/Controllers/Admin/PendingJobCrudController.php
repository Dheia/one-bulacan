<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Job;
use App\Models\Permission;

use Carbon\Carbon;

/**
 * Class JobCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PendingJobCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Job');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/pending-job');
        $this->crud->setEntityNameStrings('Pending Job', 'Pending Jobs');

        $this->crud->allowAccess('job_publish');
        $this->crud->denyAccess('create');

        // Permissions With Access
        $permissions = [
            'list'          =>  'access job',
            'create'        =>  'create job',
            'show'          =>  'read job',
            'update'        =>  'update job',
            'delete'        =>  'delete job',
            'job_publish'    =>  'publish job'
        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

        $this->crud->addClause('where', 'active', '=', '0');
        $this->crud->addButtonFromView('line', 'job_publish', 'job_publish', 'beginning');
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
        $this->crud->addColumn([
            'label' => "Job Category",
            'type' => 'select',
            'name' => 'job_category_id',
            'entity' => 'job_category',
            'attribute' => 'name',
            'model' => 'App\Models\JobCategory'
        ]);
        $this->crud->addColumn([
            'label' => 'Start',
            'type' => 'datetime',
            'name' => 'start_at'
        ]);
        $this->crud->addColumn([
            'label' => 'End',
            'type' => 'datetime',
            'name' => 'end_at'
        ]);
        $this->crud->addColumn([
            'label' => 'Status',
            'type' => 'status',
            'name' => 'status'
        ]);
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
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
        $this->crud->addColumn([
            'label' => "Job Category",
            'type' => 'select',
            'name' => 'job_category_id',
            'entity' => 'job_category',
            'attribute' => 'name',
            'model' => 'App\Models\JobCategory'
        ]);
        $this->crud->addColumn([
            'label' => 'Start',
            'type' => 'datetime',
            'name' => 'start_at'
        ]);
        $this->crud->addColumn([
            'label' => 'End',
            'type' => 'datetime',
            'name' => 'end_at'
        ]);
        $this->crud->addColumn([
            'label' => 'Status',
            'type' => 'status',
            'name' => 'status'
        ]);
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(JobRequest::class);

        $this->crud->addField([
            'label' => "Business",
            'type' => 'select2',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business'
        ]);
        $this->crud->addField([
            'label' => "Job Category",
            'type' => 'select2',
            'name' => 'job_category_id',
            'entity' => 'job_category',
            'attribute' => 'name',
            'model' => 'App\Models\JobCategory'
        ]);
        $this->crud->addField([
            'label' => 'Position',
            'type' => 'text',
            'name' => 'position',
        ]);
        $this->crud->addField([
            'label' => 'Description',
            'type' => 'textarea',
            'name' => 'description'
        ]);
        $this->crud->addField([
            'label' => 'Requirements',
            'type' => 'textarea',
            'name' => 'requirement'
        ]);
        $this->crud->addField([
            'label' => 'Qualifications',
            'type' => 'textarea',
            'name' => 'qualification'
        ]);
        $this->crud->addField([
            'label' => 'Start',
            'type' => 'datetime',
            'name' => 'start_at',
            'default' => Carbon::now(),
            'attributes' => [
                'class' => 'form-control some-class',
                'readonly'=>'readonly',
                'disabled'=>'disabled',
              ],
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);
        $this->crud->addField([
            'label' => 'End',
            'type' => 'datetime',
            'name' => 'end_at',
            'default' => Carbon::now()->addMonths(1),
            'attributes' => [
                'class' => 'form-control some-class',
                'readonly'=>'readonly',
                'disabled'=>'disabled',
              ],
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);
        
        $this->crud->addField([   // Checkbox
            'name' => 'active',
            'label' => 'Active',
            'type' => 'checkbox',
            'default'    => '1',
        ]);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {
        // do something before validation, before save, before everything; for example:
    // $this->crud->request->request->add(['author_id'=> backpack_user()->id]);
        // $this->crud->addField(['type' => 'hidden', 'name' => 'author_id']);
    // $this->crud->request->request->remove('password_confirmation');
        // $this->crud->removeField('password_confirmation');
        $this->crud->request->request->add(['start_at'=> Carbon::now()]);
        $this->crud->request->request->add(['end_at'=> Carbon::now()->addMonths(1)]);
        $response = $this->traitStore();
        // do something after save
        return $response;
    }

    public function publish($id)
    {
        // Abort If Has No Permission To Publish Job
        Permission::hasPermissionOr401('publish job');

        $job            =   Job::where('id', '=',  $id)->first();
        $job->start_at  =   Carbon::now();
        $job->end_at    =   Carbon::now()->addMonths(1);
        $job->active    =   1;

        if($job->update()){
            \Alert::success('Successfully Published.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else{
            \Alert::error('Error Publishing, Something Went Wrong, Please Try Again.')->flash();
                return \Redirect::to($this->crud->route);
        }
    }
}