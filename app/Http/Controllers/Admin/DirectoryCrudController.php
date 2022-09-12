<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DirectoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DirectoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class DirectoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Directory');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/directory');
        $this->crud->setEntityNameStrings('directory', 'directories');

        $this->crud->enablePersistentTable();
        $this->crud->enableResponsiveTable();
        $this->crud->enableExportButtons();

        $this->crud->addField([   // SelectMultiple = n-n relationship (with pivot table)
            'label' => "Tags",
            'type' => 'select2_multiple',
            'name' => 'tags', // the method that defines the relationship in your Model
            'entity' => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Tag", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?

            // optional
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);

        $this->crud->addField([
            'label' => "Profile Image",
            'name' => "logo",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/directory/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);

        $this->crud->addField([  // Select
           'label' => "Category",
           'type' => 'select',
           'name' => 'category_id', // the db column for the foreign key
           'entity' => 'category', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           'model' => "App\Models\Category",

           // optional
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);

        $this->crud->addField([  // Select
           'label' => "Location",
           'type' => 'select',
           'name' => 'location_id', // the db column for the foreign key
           'entity' => 'location', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           'model' => "App\Models\Location",

           // optional
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);

        

    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();

        $this->crud->addColumn(
            [
               // n-n relationship (with pivot table)
               'label' => "Tags", // Table column heading
               'type' => "select_multiple",
               'name' => 'tags', // the method that defines the relationship in your Model
               'entity' => 'tags', // the method that defines the relationship in your Model
               'attribute' => "name", // foreign key attribute that is shown to user
               'model' => "App\Models\Tag", // foreign key model
            ]
        );
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(DirectoryRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
        $this->crud->removeFields(['slug']);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $this->crud->removeFields(['slug']);
    }
}
