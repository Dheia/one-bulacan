<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Category;
use App\Models\BusinessCategory;
use App\Models\Permission;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Category');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/category');
        $this->crud->setEntityNameStrings('category', 'categories');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access business category',
            'create'    =>  'create business category',
            'show'      =>  'read business category',
            'update'    =>  'update business category',
            'delete'    =>  'delete business category'
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
        $this->crud->addColumn([
            'label' => 'Parent',
            'type' => 'select',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => "App\Models\Category",
        ]);
        $this->crud->addColumn([
            'label' => "Image",
            'name' => "image",
            'type' => 'image'
        ]);
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        $this->crud->orderBy('name', 'ASC');
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
            'model' => "App\Models\Category",
        ]);

        $this->crud->addColumn([
            'label' => "Image",
            'name' => "image",
            'type' => 'image'
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CategoryRequest::class);

        $this->crud->addField([   // CKEditor
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
            
        ]);
        $this->crud->addField([   // icon_picker
            'label' => "Icon",
            'name' => 'icon',
            'type' => 'icon_picker',
            'iconset' => 'fontawesome', // options: fontawesome, glyphicon, ionicon, weathericon, mapicon, octicon, typicon, elusiveicon, materialdesign
            'wrapper' => [
                'class' => 'form-group col-md-1'
            ],
        ]);

        // $this->crud->addField([
        //     'label' => "Image",
        //     'name' => "image",
        //     'type' => 'image',
        //     'upload' => true,
        //     'crop' => true, // set to true to allow cropping, false to disable
        //     'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        //     // 'disk' => 's3_bucket', // in case you need to show images from a different disk
        //     // 'prefix' => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        // ]);
        $this->crud->addField([   // Browse
            'name' => 'image',
            'label' => 'Image',
            'type' => 'browse'
        ]);

        $this->crud->addField([   // Checkbox
            'name' => 'active',
            'label' => 'Active',
            'type' => 'checkbox',
        ]);
        $this->crud->addField([
            'label' => 'Parent',
            'type' => 'select2',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => "App\Models\Category",
            'options'   => (function ($query) {
                return $query->where('parent_id', null)->get();
            }), 
        ]);
        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function destroy($id)
    {
        // Abort If Has No Permission To Delete Business Category
        Permission::hasPermissionOr401('delete business category');

        $this->crud->hasAccessOrFail('delete');
        BusinessCategory::where('category_id',$id)->delete();
        return $this->crud->delete($id);
    }
}
