<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusinessCouponRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\Business;

/**
 * Class BusinessCouponCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BusinessCouponCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store  as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\BusinessCoupon::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/business-coupon');
        CRUD::setEntityNameStrings('Business Coupon', 'Business Coupons');

        CRUD::addColumn([
            'label' => "Business",
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business',
        ]);
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */

        CRUD::addColumn([
            'label' => "Code",
            'type' => 'text',
            'name' => 'code'
        ])->afterColumn('business_id');

        CRUD::addColumn([
            'label' => "Title",
            'type' => 'text',
            'name' => 'title'
        ])->afterColumn('code');

        CRUD::addColumn([
            'label' => "Description",
            'type' => 'markdown',
            'name' => 'description'
        ])->afterColumn('title');

        CRUD::addColumn([
            'label' => "Quantity",
            'type' => 'number',
            'name' => 'quantity'
        ])->afterColumn('description');

        CRUD::addColumn([
           'label' => "Start",
           'type' => "date",
           'name' => 'start_at',
           'format' => 'MMMM DD, YYYY'
        ]);

        CRUD::addColumn([
           'label' => "End",
           'type' => "date",
           'name' => 'end_at',
           'format' => 'MMMM DD, YYYY'
        ]);

        CRUD::addColumn([
            'label' => "Secret",
            'type' => 'markdown',
            'name' => 'secret'
        ])->afterColumn('end_at');

        CRUD::addColumn([
            'label' => "QR Code",
            'type' => 'markdown',
            'name' => 'qr_code'
        ]);
    }

    /**
     * Define what happens when the Show operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-show
     * @return void
     */
    public function show($id)
    {
        CRUD::addColumn([
            'label' => "Code",
            'type' => 'text',
            'name' => 'code'
        ])->afterColumn('business_id');

        CRUD::addColumn([
            'label' => "Title",
            'type' => 'text',
            'name' => 'title'
        ])->afterColumn('code');

        CRUD::addColumn([
            'label' => "Description",
            'type' => 'markdown',
            'name' => 'description'
        ])->afterColumn('title');

        CRUD::addColumn([
            'label' => "Quantity",
            'type' => 'number',
            'name' => 'quantity'
        ])->afterColumn('description');

        CRUD::addColumn([
           'label' => "Start",
           'type' => "date",
           'name' => 'start_at',
           'format' => 'MMMM DD, YYYY'
        ]);

        CRUD::addColumn([
           'label' => "End",
           'type' => "date",
           'name' => 'end_at',
           'format' => 'MMMM DD, YYYY'
        ]);

        // CRUD::addColumn([
        //     'label' => "Secret",
        //     'type' => 'markdown',
        //     'name' => 'secret'
        // ])->afterColumn('end_at');

        CRUD::addColumn([
            'label' => "QR Code",
            'type' => 'markdown',
            'name' => 'qr_code'
        ]);
        // custom logic before
        $content = $this->traitShow($id);
        // cutom logic after
        $this->crud->removeColumn('secret');
        return $content;
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BusinessCouponRequest::class);

        if(request()->business_id)
        {
            $business   =   Business::findOrFail(request()->business_id);

            // Abort If Not Referred By User
            Business::referredByUserOr403($business->referrer_user_id);

            CRUD::addField([
                'label' => "Business",
                'type' => 'select2',
                'name' => 'business_id',
                'entity' => 'business',
                'attribute' => 'name',
                'allows_null' => false,
                'model' => 'App\Models\Business',
                'options'   => (function ($query) {
                    return $query->where('active', 1)->where('id', request()->business_id)->get();
                }), 
                'wrapper' => [
                    'class' => 'form-group col-md-12'
                ]
            ]);
        }
        else
        {
            CRUD::addField([
                'label' => "Business",
                'type' => 'select2',
                'name' => 'business_id',
                'entity' => 'business',
                'attribute' => 'name',
                'allows_null' => false,
                'model' => 'App\Models\Business',
                'options'   => (function ($query) {
                    if(!backpack_user()->hasrole('Super-Admin'))
                    {                    
                        return $query->where('active', 1)->where('referrer_user_id', backpack_user()->id)->get();
                    }
                    else
                    {
                        return $query->where('active', 1)->get();
                    }
                }), 
                'wrapper' => [
                    'class' => 'form-group col-md-12'
                ]
            ]);
        }

        CRUD::addField([
            'label' => 'Title',
            'type' => 'text',
            'name' => 'title'
        ]);

        CRUD::addField([
            'label' => 'Description',
            'type' => 'textarea',
            'name' => 'description'
        ]);

        CRUD::addField([
            'label' => 'Quantity',
            'type' => 'number',
            'name' => 'quantity'
        ]);

        CRUD::addField([   // date_range
            'name'  => ['start_at', 'end_at'], // db columns for start_date & end_date
            'label' => 'Event Date Range',
            'type'  => 'date_range',
            // OPTIONALS
            'start_default' => Carbon::now(), // default value for start_date
            'end_default' => Carbon::now(), // default value for end_date
            'date_range_options' => [ // options sent to daterangepicker.js
                'timePicker' => false,
                'locale' => ['format' => 'DD/MM/YYYY']
            ]
        ]);

        // CRUD::setFromDb(); // fields

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

    public function store()
    {
        $this->crud->setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);

        $this->crud->addField(['type' => 'hidden', 'name' => 'code']);
        $this->crud->addField(['type' => 'hidden', 'name' => 'secret']);

        $code = strtoupper(substr(md5(uniqid(mt_rand(), true)) , 0, 7));

        $this->crud->getRequest()->request->add(['code' => $code]);
        $this->crud->getRequest()->request->add(['secret' => sha1($code)]);

        $response = $this->traitStore();

        return $response;
    }
}
