<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PaymentMethodRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

// Models
use App\Models\PaymentCategory;

/**
 * Class PaymentMethodCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PaymentMethodCrudController extends CrudController
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
        CRUD::setModel(\App\Models\PaymentMethod::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/payment-method');
        CRUD::setEntityNameStrings('payment method', 'payment methods');

        // Permissions With Access
        $permissions = [
            'list'    =>  'access payment-method',
            'create'  =>  'create payment-method',
            'show'    =>  'read payment-method',
            'update'  =>  'update payment-method',
            'delete'  =>  'delete payment-method',

            'activate'   => 'activate payment-method',
            'deactivate' => 'deactivate payment-method'
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
        self::addFilters();

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
        CRUD::setValidation(PaymentMethodRequest::class);

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
            'label'     => "Payment Category",
            'type'      => 'select2_from_array',
            'name'      => 'payment_category_id',
            'allows_null' => true,
            'options'   => PaymentCategory::active()->get()->pluck('name','id')->toArray(),
        ]);

        CRUD::addField([
            'label' => 'Name',
            'name' => 'name',
            'type' => 'text',
            'wrapperAttributes' => [ 'class' => 'form-group col-md-6 col-xs-12' ]
        ]);

        CRUD::addField([
            'label' => 'Code',
            'name' => 'code',
            'type' => 'text',
            'wrapperAttributes' => [ 'class' => 'form-group col-md-6 col-xs-12' ]
        ]);

       CRUD::addField([
            'label' => 'Fee (%)',
            'type' => 'text',
            'name' => 'fee',
            'wrapperAttributes' => [ 'class' => 'form-group col-md-6 col-xs-12' ]
        ]);

        // CRUD::addField([
        //     'label' => 'Additional Fee - Fixed Amount (PHP)',
        //     'type' => 'text',
        //     'name' => 'additional_fee',
        //     'wrapperAttributes' => [ 'class' => 'form-group col-md-4 col-xs-12' ]
        // ]);

        CRUD::addField([
            'label' => 'Minimum Fee - Fixed Amount (PHP)',
            'type' => 'text',
            'name' => 'minimum_fee',
            'wrapperAttributes' => [ 'class' => 'form-group col-md-6 col-xs-12' ]
        ]);

        CRUD::addField([
            'name'  => 'logo',
            'label' => 'Logo',
            'type'  => 'browse'
        ]);

        CRUD::addField([
            'label' => "Icon",
            'name' => 'icon',
            'type' => 'icon_picker',
            'iconset' => 'fontawesome',
            'wrapperAttributes' => [ 'class' => 'form-group col-md-6 col-xs-12' ]
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
            'name'   => 'logo',
            'label'  => 'Logo',
            'type'   => 'image',
            'height' => '30px',
            'width'  => '30px'
        ]);

        CRUD::addColumn([
            'label'     => 'Payment Category',
            'type'      => 'select',
            'name'      => 'payment_category_id',
            'entity'    => 'paymentCategory',
            'attribute' => 'name',
            'model'     => "App\Models\PaymentCategory",
        ]);

        CRUD::addColumn([
            'label' => 'Name',
            'type' => 'text',
            'name' => 'name'
        ]);

        CRUD::addColumn([
            'label' => 'Code',
            'type' => 'text',
            'name' => 'code'
        ]);

        CRUD::addColumn([
            'label' => 'Fee (%)',
            'type' => 'text',
            'name' => 'fee',
            'suffix' => " %",
        ]);

        // CRUD::addColumn([
        //    'name' => 'additional_fee', // The db column name
        //    'label' => "Additional Fee", // Table column heading
        //    'type' => "number",
        //    'prefix' => "₱ ",
        //    'decimals' => 2,
        //    'dec_point' => '.',
        //    'thousands_sep' => ','
        // ]);

        CRUD::addColumn([
            'name' => 'minimum_fee', // The db column name
            'label' => "Minimum Fee", // Table column heading
            'type' => "number",
            'prefix' => "₱ ",
            'decimals' => 2,
            'dec_point' => '.',
            'thousands_sep' => ','
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

        CRUD::addColumn([
            'name' => "icon",
            'label' => "Icon",
            'type' => "model_function",
            'function_name' => 'getIcon'
        ]);

        CRUD::addColumn([
           'name' => 'description', // The db column name
           'label' => "Description", // Table column heading
           'type' => "markdown"
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

    /** 
     * FILTERS
     * 
     * @see https://backpackforlaravel.com/docs/crud-filters
     */
    private function addFilters()
    {
        CRUD::addFilter([ // select2 filter
            'name'  => 'payment_category_id',
            'type'  => 'dropdown',
            'label' => 'Category',
        ], function() {
            return \App\Models\PaymentCategory::all()->pluck('name', 'id')->toArray();
        }, function($values) { // if the filter is active
                $this->crud->addClause('where', 'payment_category_id', $values);
        });
    }
}
