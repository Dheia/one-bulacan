<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PaymentCategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PaymentCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PaymentCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use \Backpack\ReviseOperation\ReviseOperation;

    use \App\Http\Traits\ActivateTrait;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PaymentCategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/payment-category');
        CRUD::setEntityNameStrings('payment category', 'payment categories');

        // Permissions With Access
        $permissions = [
            'list'    =>  'access payment-category',
            'create'  =>  'create payment-category',
            'show'    =>  'read payment-category',
            'update'  =>  'update payment-category',
            'delete'  =>  'delete payment-category',

            'activate'   => 'activate payment-category',
            'deactivate' => 'deactivate payment-category'
        ];

        CRUD::allowAccess('activate');
        CRUD::allowAccess('deactivate');

        if(backpack_user()->email != 'dev@tigernethost.com') {
            foreach ($permissions as $access => $permission) {
                // Deny Access If User Didn't Has Permission
                if(!backpack_user()->can($permission)) {
                    CRUD::denyAccess($access);
                }
            }
        }
        else {
            CRUD::allowAccess('revisions');
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::set('show.setFromDb', false);
        // CRUD::setFromDb(); // columns

        self::addColumns();

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */

        $this->crud->data['dropdownButtons'] = [
            'activate',
            'update',
            'delete'
        ];
        
        CRUD::removeButtons(['revise', 'show', 'update', 'delete']);
        CRUD::addButtonFromView('line', 'More', 'dropdownButton', 'beginning');
        CRUD::addButtonFromView('line', 'Revise', 'revise_button', 'beginning');
        CRUD::addButtonFromView('line', 'Show', 'show', 'beginning');
    }

    /**
     * Define what happens when the Show operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-show
     * @return void
     */
    protected function setupShowOperation()
    {
        CRUD::set('show.setFromDb', false);
        // CRUD::setFromDb(); // columns

        self::addColumns();
        CRUD::addButtonFromView('line', 'Activate', 'activate', 'beginning');

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PaymentCategoryRequest::class);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */

        self::addFields();
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /** 
     * FIELDS
     * 
     * @see https://backpackforlaravel.com/docs/crud-fields
     */
    private function addFields()
    {
        CRUD::addField([
            'label' => 'Name',
            'name' => 'name',
            'type' => 'text'
        ]);

        CRUD::addField([
            'label' => 'Method',
            'name' => 'method',
            'type' => 'text'
        ]);

        CRUD::addField([
            'label' => 'Action',
            'name' => 'action',
            'type' => 'text'
        ]);

        CRUD::addField([
            'label' => 'Description',
            'name' => 'description',
            'type' => 'textarea'
        ]);

        CRUD::addField([
            'label' => 'Active',
            'name' => 'active',
            'type' => 'boolean'
        ]);
    }

    /** 
     * COLUMNS
     * 
     * @see https://backpackforlaravel.com/docs/crud-columns
     */
    private function addColumns()
    {
        CRUD::addColumn([
            'label' => 'Name',
            'name' => 'name',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'label' => 'Method',
            'name' => 'method',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'label' => 'Action',
            'name' => 'action',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'label' => 'Description',
            'name' => 'description',
            'type' => 'markdown'
        ]);

        CRUD::addColumn([
            'name'    => 'active',
            'label'   => 'Active',
            'type'    => 'boolean',
            'options' => [0 => 'Inactive', 1 => 'Active'], // optional
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Active') {
                        return 'badge badge-success';
                    }
        
                    return 'badge badge-default';
                },
            ],
        ]);
    }
}
