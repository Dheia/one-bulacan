<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SurveyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Survey;

/**
 * Class SurveyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SurveyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Survey');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/survey');
        $this->crud->setEntityNameStrings('survey', 'surveys');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access survey',
            'create'    =>  'create survey',
            'show'      =>  'read survey',
            'update'    =>  'update survey',
            'delete'    =>  'delete survey'
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
        $this->crud->addColumn([
            'label' => "Business",
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business'
        ]);
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
    }
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SurveyRequest::class);
        
        $this->crud->addField([
            'label' => "Business",
            'type' => 'select2',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business',
            'options'   => (function ($query) {
                return $query->whereNotIn('id', Survey::all()->pluck('business_id'))->get();
            }), 
        ]);

        $this->crud->addField([   // select_from_array
            'name' => 'medium',
            'label' => "Medium",
            'type' => 'select_from_array',
            'options' => ['Search Engine' => 'Search Engine', 'Referral' => 'Referral', 'Social Media' => 'Social Media'],
            'allows_null' => false,
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]);

        $this->crud->addField([   // select_from_array
            'name' => 'referred_by',
            'label' => "Referred by",
            'type' => 'text_referred',
        ]);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
