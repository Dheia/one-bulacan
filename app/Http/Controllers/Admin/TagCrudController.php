<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\BusinessTag;
use App\Models\Tag;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Tag');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tag');
        $this->crud->setEntityNameStrings('tag', 'tags');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access tag',
            'create'    =>  'create tag',
            'show'      =>  'read tag',
            'update'    =>  'update tag',
            'delete'    =>  'delete tag'
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
        // $this->crud->setFromDb();
        CRUD::addColumn([
            'name'  => 'name',
            'type'  =>  'text',
            'label' =>  'Name'
        ]);

        CRUD::addColumn([
            'name'  => 'active',
            'label' => "Active",
            'type'  => 'boolean',
            'options' => [0 => 'Inactive', 1 => 'Active'],
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Active') {
                        return 'badge badge-success';
                    }

                    return 'badge badge-default';
                }, 
            ],
            'visibleInExport' => true,
            'visibleInTable' => true
        ]);
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

    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');
        BusinessTag::where('tag_id',$id)->delete();
        return $this->crud->delete($id);
    }
}
