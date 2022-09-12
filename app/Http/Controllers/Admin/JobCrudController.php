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
class JobCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Job');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/job');
        $this->crud->setEntityNameStrings('job', 'jobs');

        $this->crud->allowAccess('job_reopen');
        $this->crud->allowAccess('job_draft');

        // Permissions With Access
        $permissions = [
            'list'          =>  'access job',
            'create'        =>  'create job',
            'show'          =>  'read job',
            'update'        =>  'update job',
            'delete'        =>  'delete job',
            'job_reopen'    =>  'reopen job',
            'job_draft'     =>  'draft job'
        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

        $this->crud->addClause('where', 'active', '=', '1');

        // Dropdown Button / More Button
        $this->crud->data['dropdownButtons'] = [
            'show',
            'job_reopen',
            'job_draft'
        ];
        CRUD::addButtonFromView('line', 'More', 'dropdownButton', 'beginning');
    }

    protected function setupListOperation()
    {
        $this->crud->removeButton('show');
        $this->crud->addColumn([
            'label' => 'Business Name',
            'type' => 'text',
            'name' => 'business_name',
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
        $this->crud->addFilter([ // select2 filter
            'name' => 'registered',
            'type' => 'dropdown',
            'label'=> 'Registered',
        ], [
            1 => 'Registered',
            0 => 'Not Registered',
        ], function($value) { // if the filter is active
                $this->crud->addClause('where', 'registered', $value);
        });
        $this->crud->addFilter([ // select2 filter
            'name' => 'status',
            'type' => 'dropdown',
            'label'=> 'Status',
        ], [
            1 => 'Active',
            2 => 'Not Active',
            3 => 'Expired',
        ], function($value) { // if the filter is active
            if($value == 3){
                $this->crud->addClause('where', 'end_at', '<', Carbon::now());
                $this->crud->addClause('where', 'active', 1);
            }else if($value == 2){
                $this->crud->addClause('where', 'active',  0);
            }else if($value == 1){
                $this->crud->addClause('where', 'end_at', '>=', Carbon::now());
            }
                
        });
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        $this->crud->removeColumn('business_id');
        $this->crud->removeColumn('company_name');
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'label' => 'Business Name',
            'type' => 'text',
            'name' => 'business_name',
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
        $this->crud->removeColumn('business_id');
        $this->crud->removeColumn('company_name');
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(JobRequest::class);

        $this->crud->addField([   // Checkbox
            'name' => 'registered',
            'label' => 'Does your business registered in One Pampanga?',
            'type' => 'select_from_array',
            'options' => ['1' => 'Registered', '0' => 'Not Registered'],
            // 'allows_null' => true,
        ]);

        $this->crud->addField([
            'label' => "Business",
            'type' => 'select2',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business',
            'allows_null' => true,
        ]);
        $this->crud->addField([
            'label' => 'Business Name',
            'type' => 'text',
            'name' => 'company_name',
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
        $this->crud->addField([   // Number
            'name' => 'quantity',
            'label' => 'Quantity',
            'type' => 'number',
        ]);
        $this->crud->addField([   // Checkbox
            'name' => 'local',
            'label' => 'Does the job offer in local or overseas ?',
            'type' => 'select_registered',
            'options' => ['1' => 'Local', '0' => 'Overseas'],
            // 'allows_null' => true,
        ]);
        $this->crud->addField([
            'name' => 'contact_person', //database column name
            'label' => 'Contact Person', //Label
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'contact_number', //database column name
            'label' => 'Contact Number', //Label
            'type' => 'text',
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
        // Abort If Has No Permission To Create Job
        Permission::hasPermissionOr401('create job');
        // do something before validation, before save, before everything; for example:
        // $this->crud->request->request->add(['author_id'=> backpack_user()->id]);
        // $this->crud->addField(['type' => 'hidden', 'name' => 'author_id']);
        // $this->crud->request->request->remove('password_confirmation');
        // $this->crud->removeField('password_confirmation');
        CRUD::getRequest()->request->add(['start_at'=> Carbon::now()]);
        CRUD::getRequest()->request->add(['end_at'=> Carbon::now()->addMonths(1)]);
        $response = $this->traitStore();
        // do something after save
        return $response;
    }

    public function reopen($id)
    {
        // Abort If Has No Permission To Re-open Job
        Permission::hasPermissionOr401('reopen job');

        $job = Job::where('id', '=',  $id)->first();
        $job->start_at = Carbon::now();
        $job->end_at = Carbon::now()->addMonths(1);
        $job->active = 1;
        if($job->update()){
            \Alert::success('Successfully Reopened.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else{
            \Alert::error('Error Reopening, Something Went Wrong, Please Try Again.')->flash();
                return \Redirect::to($this->crud->route);
        }
    }

    public function draft($id)
    {
        // Abort If Has No Permission To Draft Job
        Permission::hasPermissionOr401('draft job');

        $job            =   Job::where('id', '=',  $id)->first();
        $job->start_at  =   null;
        $job->end_at    =   null;
        $job->active    =   0;
        
        if($job->update()){
            \Alert::success('Successfully Drafted.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else{
            \Alert::error('Error Drafting, Something Went Wrong, Please Try Again.')->flash();
                return \Redirect::to($this->crud->route);
        }
    }
}