<?php

namespace App\Http\Controllers\BusinessPortal;

use App\Http\Requests\BusinessPortal\TagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

use App\Models\Tag;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TagController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    public function setup()
    {   
        $this->user = Auth::guard('business-portal')->user();
        $this->crud->setModel('App\Models\Tag');
        $this->crud->setRoute(config('backpack.base.portal_route_prefix') . '/business-tag');
        // $this->crud->setRoute('one-portal/tag');
        $this->crud->setEntityNameStrings('tag', 'tags');

        CRUD::denyAccess('update');
        CRUD::denyAccess('delete');

        CRUD::setListView('businessPortal.list');
        CRUD::setShowView('businessPortal.show');
        CRUD::setEditView('businessPortal.edit');
    }

    protected function setupListOperation()
    {
        abort(404);
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TagRequest::class);

         $this->crud->addField([
            'name'  =>  'name',
            'type'  =>  'text',
            'label' =>  'Name'
        ]);

        $this->crud->addField([
            'name'  =>  'active',
            'type'  =>  'hidden',
            'label' =>  'Active',
            'value' =>  1
        ]);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
