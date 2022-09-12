<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusinessTagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BusinessTagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BusinessTagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\BusinessTag');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/businesstag');
        $this->crud->setEntityNameStrings('businesstag', 'business tags');
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
            'label' => "Tag",
            'type' => 'select',
            'name' => 'tag_id',
            'entity' => 'tag',
            'attribute' => 'name',
            'model' => 'App\Models\Tag'
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
            'label' => "Tag",
            'type' => 'select',
            'name' => 'tag_id',
            'entity' => 'tag',
            'attribute' => 'name',
            'model' => 'App\Models\Tag'
        ]);
    }
    
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BusinessTagRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
