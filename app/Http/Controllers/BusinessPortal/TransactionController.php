<?php

namespace App\Http\Controllers\BusinessPortal;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Business;
use App\Models\PaynamicsPayment;

use Arr;

class TransactionController extends CrudController
{
    public $data = [];
    public $user;
    public $businesses;
    public $businessOwner;

    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {  
        $this->user             = Auth::guard('business-portal')->user();
        $this->businessOwner    = $this->user->businessOwner;
        $this->businesses       = $this->user->businessOwner->businesses;

        CRUD::setModel('App\Models\PaynamicsPayment');
        CRUD::setRoute(config('backpack.base.portal_route_prefix') . '/transaction');
        CRUD::setEntityNameStrings('transaction', 'transactions');

        CRUD::denyAccess('create');
        CRUD::denyAccess('update');
        CRUD::denyAccess('delete');
        // CRUD::addClause('where', 'business_owner_id', $this->user->businessOwner->id);

        $this->data['$breadcrumbs'] = ['Business Portal' => 'dashboard'];
        $this->data['businesses']   = $this->businesses->map(function ($item, $key) {
            return ['id' => $item->id, 'name' => $item->name, 'slug' => $item->slug, 'logo' => asset($item->logo)];
        });

        CRUD::addClause('whereIn', 'paymentable_id', $this->businesses->pluck('id'));
        CRUD::addClause('where', 'paymentable_type', 'App\Models\Business');

        CRUD::allowAccess('details_row');
        CRUD::enableDetailsRow();

        CRUD::setListView('businessPortal.transactions.transaction_list');
        CRUD::setShowView('businessPortal.show');
        CRUD::setEditView('businessPortal.edit');
    }

    protected function setupListOperation()
    {
        CRUD::set('show.setFromDb', false);
        // CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */

        CRUD::addColumn([
            'name'  => 'payment_information',
            'label' => '', // Table column heading
            'type'     => 'custom_html',
            'value' => '<span class="text-danger"></span>',
            'visibleInTable' => true,
        ]);

        self::addColumns();
        self::addFilters();
        CRUD::orderBy('timestamp', 'DESC');

        CRUD::enableExportButtons();
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
        $this->data['crud']  = $this->crud;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('crud::paynamicsPayment.payment_information', $this->data);
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
            'thousands_sep' => ','
        ]);

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
