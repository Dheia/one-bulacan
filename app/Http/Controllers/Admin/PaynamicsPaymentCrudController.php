<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PaynamicsPaymentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Business;
use App\Models\PaymentMethod;

use App\Models\BusinessOwner;

/**
 * Class PaynamicsPaymentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PaynamicsPaymentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PaynamicsPayment::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/paynamics-payment');
        CRUD::setEntityNameStrings('paynamics payment', 'paynamics payments');

        // Permissions With Access
         $permissions = [
            'list'    =>  'access paynamics-payment',
            'show'    =>  'read paynamics-payment',
            'details_row' =>  'read paynamics-payment',
        ];

        if(backpack_user()->email != 'dev@tigernethost.com') {
            foreach ($permissions as $access => $permission) {
                // Deny Access If User Didn't Has Permission
                if(!backpack_user()->can($permission)) {
                    CRUD::denyAccess($access);
                }
            }
        }

        CRUD::denyAccess('create');
        CRUD::denyAccess('update');
        CRUD::denyAccess('delete');

        // CRUD::setListView('paynamicsPayments.transaction_list');.
        CRUD::allowAccess('details_row');
        CRUD::enableDetailsRow();
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

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        $this->data['businesses'] = Business::get();

        CRUD::addColumn([
            'name'  => 'payment_information',
            'label' => '', // Table column heading
            'type'     => 'custom_html',
            'value' => '<span class="text-danger"></span>',
            'visibleInTable' => true,
        ]);

        self::addColumns();
        self::addFilters();
        CRUD::enableExportButtons();
        CRUD::disablePersistentTable();

        CRUD::removeColumns([
            'fee',
            'email',
            'mobile',
            'address',
            'description',
        ]);
        CRUD::allowAccess('details_row');
        CRUD::enableDetailsRow();
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
     * Used with AJAX in the list view (datatables) to show extra information about that row that didn't fit in the table.
     * It defaults to showing some dummy text.
     *
     * It's enabled by:
     * - setting: $crud->details_row = true;
     * - adding the details route for the entity; ex: Route::get('page/{id}/details', 'PageCrudController@showDetailsRow');
     * - adding a view with the following name to change what the row actually contains: app/resources/views/vendor/backpack/crud/details_row.blade.php
     */
    public function showDetailsRow($id)
    {
        $this->crud->hasAccessOrFail('details_row');

        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('crud::paynamicsPayment.payment_information', $this->data);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PaynamicsPaymentRequest::class);

        

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
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
     * COLUMNS
     * 
     * @see https://backpackforlaravel.com/docs/crud-columns
     */
    private function addColumns()
    {
        CRUD::addColumn([
            'name'  => 'timestamp',
            'label' => "Date",
            'type'  => 'datetime',
            'format'  => 'MMMM DD, YYYY - hh:mm:ss A'
        ]);

        CRUD::addColumn([
            'name'  => 'payment_to',
            'label' => "Business",
            'type'  => 'text',
            'visibleInTable' => false,
            'visibleInExport' => true,
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('paymentable', function ($q) use ($column, $searchTerm) {
                    $q->where('name', 'like', '%'.$searchTerm.'%');
                });
            }
        ]);

        CRUD::addColumn([
            'name'  => 'request_id',
            'label' => "Request ID",
            'type'  => 'text'
        ]);

        CRUD::addColumn([
            'name'  => 'response_message',
            'label' => "Message",
            'type'  => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($entry->response_code === 'GR001' || $entry->response_code === 'GR002') {
                        return 'badge badge-success';
                    }
                    else if($entry->response_code === 'GR033') {
                        return 'badge badge-default';
                    }
        
                    return 'badge badge-danger';
                },
            ]
        ]);

        CRUD::addColumn([
            'name'  => 'pay_reference',
            'label' => "Reference No.",
            'type'  => 'text',
            'visibleInTable' => false,
            'visibleInExport' => true
        ]);
        
        CRUD::addColumn([
            'name'  => 'amount',
            'label' => "Amount",
            'type'  => 'number', 
            'prefix'  => '₱ ', 
            'decimals' => 2,
            'thousands_sep' => ',',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere('amount', 'like', '%'.$searchTerm.'%');
            }
        ]);

        CRUD::addColumn([
            'name'  => 'fee',
            'label' => "Fee",
            'type'  => 'number', 
            'prefix'  => '₱ ', 
            'decimals' => 2,
            'thousands_sep' => ',',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere('fee', 'like', '%'.$searchTerm.'%');
            }
        ]);

        // CRUD::addColumn([
        //     'name'  => 'total_amount',
        //     'label' => "Total",
        //     'type'  => 'number', 
        //     'prefix'  => '₱ ', 
        //     'decimals' => 2,
        //     'thousands_sep' => ','
        // ]);

        CRUD::addColumn([
            'name'  => 'payment_from',
            'label' => "Payer",
            'type'  => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere('firstname', 'like', '%'.$searchTerm.'%')
                    ->orWhere('lastname', 'like', '%'.$searchTerm.'%');
            }
        ]);

        CRUD::addColumn([
            'name'  => 'email',
            'label' => "Email",
            'type'  => 'email'
        ]);

        CRUD::addColumn([
            'name'  => 'mobile',
            'label' => "Mobile No.",
            'type'  => 'text'
        ]);

        CRUD::addColumn([
            'name'  => 'paymentMethod.name',
            'label' => "Payment Method",
            'type'  => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('paymentMethod', function ($q) use ($column, $searchTerm) {
                    $q->where('name', 'like', '%'.$searchTerm.'%');
                });
            }
        ]);

        CRUD::addColumn([
            'name'  => 'address',
            'label' => "Address",
            'type'  => 'markdown'
        ]);

        CRUD::addColumn([
            'name'  => 'description',
            'label' => "Description",
            'type'  => 'markdown'
        ]);
    }

    /** 
     * FILTERS
     * 
     * @see https://backpackforlaravel.com/docs/crud-filters
     */
    private function addFilters()
    {
        $this->businesses = Business::get();

        CRUD::addFilter([
            'name'  => 'business',
            'type'  => 'select2',
            'label' => 'Business'
        ], function () {
            return $this->businesses->pluck('name', 'slug')->toArray();
        }, function ($value) { // if the filter is active
            $business = $this->businesses->where('slug', $value)->first();
            $this->crud->addClause('where', 'paymentable_id', $business ? $business->id : '');
            $this->crud->addClause('where', 'paymentable_type', 'App\Models\Business');
        });

        CRUD::addFilter([
            'name'  => 'payment_method',
            'type'  => 'select2',
            'label' => 'Payment Method'
        ], function () {
            return PaymentMethod::get()->pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'payment_method_id', $value);
        });

        CRUD::addFilter([
            'type'  => 'date_range',
            'name'  => 'from_to',
            'label' => 'Date range'
        ],
        false,
        function ($value) { // if the filter is active, apply these constraints
            $dates = json_decode($value);
            $this->crud->addClause('where', 'timestamp', '>=', $dates->from);
            $this->crud->addClause('where', 'timestamp', '<=', $dates->to . ' 23:59:59');
        });
    }
}