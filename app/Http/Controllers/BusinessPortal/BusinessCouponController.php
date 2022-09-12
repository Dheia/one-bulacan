<?php

namespace App\Http\Controllers\BusinessPortal;

use App\Http\Requests\BusinessPortal\BusinessCouponRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Alert;

use App\Models\Business;
use App\Models\BusinessCoupon;

/**
 * Class BusinessCouponController
 * @package App\Http\Controllers\BusinessPortal
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BusinessCouponController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store  as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation { destroy as traitDestroy; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\BusinessCoupon::class);
        CRUD::setRoute(config('backpack.base.portal_route_prefix') . '/coupon');
        CRUD::setEntityNameStrings('Business Coupon', 'Business Coupons');

        $this->data['breadcrumbs'] = [
            'Portal' => 'dashboard',
            $this->crud->entity_name_plural => url($this->crud->route),
        ];

        $this->user = Auth::guard('business-portal')->user();

        CRUD::addColumn([
            'label' => "Business",
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business',
        ]);

        CRUD::addClause('whereIn', 'business_id', $this->user->businessOwner->businesses->pluck('id')->toArray());

        CRUD::setListView('businessPortal.list');
        CRUD::setShowView('businessPortal.show');
        CRUD::setEditView('businessPortal.edit');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->data['breadcrumbs']['List'] = false;
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
        $this->data['breadcrumbs']['Preview'] = false;

        $coupon = BusinessCoupon::with('business')->where('id', $id)->first();

        if(!$coupon)
        {
            \Alert::error('Coupon not found.')->flash();
            abort(400, 'Coupon not found.');
        }
        if(!$coupon->business)
        {
            \Alert::error('Business not found.')->flash();
            abort(400, 'Business not found.');
        }
        if($coupon->business->business_owner_id != $this->user->businessOwner->id)
        {
            abort(401);
        }

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
        $this->data['breadcrumbs']['Add'] = false;

        CRUD::setValidation(BusinessCouponRequest::class);

        // CRUD::setFromDb(); // fields

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
        $this->data['breadcrumbs']['Edit'] = false;

        // $this->setupCreateOperation();
        self::addFields();

        $id = \Route::current()->parameter('id');
        if($id)
        {
            $coupon = BusinessCoupon::with('business')->where('id', $id)->first();

            if(!$coupon)
            {
                \Alert::error('Product Service not found.')->flash();
                abort(400, 'Product Service not found.');
            }
            if(!$coupon->business)
            {
                \Alert::error('Business not found.')->flash();
                abort(400, 'Business not found.');
            }
            if($coupon->business->business_owner_id != $this->user->businessOwner->id)
            {
                abort(401);
            }
        }
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

    public function update()
    {
        $id = CRUD::getRequest()->id;

        $coupon = BusinessCoupon::with('business')->where('id', $id)->first();

        if(!$coupon)
        {
            \Alert::error('Coupon not found.')->flash();
            abort(400, 'Coupon not found.');
        }
        if(!$coupon->business)
        {
            \Alert::error('Business not found.')->flash();
            abort(400, 'Business not found.');
        }
        if($coupon->business->business_owner_id != $this->user->businessOwner->id)
        {
            abort(401);
        }

        $response = $this->traitUpdate();
        // do something after save
        return $response;
    }

    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        $coupon = BusinessCoupon::with('business')->where('id', $id)->first();

        if(!$coupon)
        {
            \Alert::error('Coupon not found.')->flash();
            abort(400, 'Coupon not found.');
        }
        if(!$coupon->business)
        {
            \Alert::error('Business not found.')->flash();
            abort(400, 'Business not found.');
        }
        if($coupon->business->business_owner_id != $this->user->businessOwner->id)
        {
            abort(401);
        }

        return $this->crud->delete($id);
    }

    protected function addFields()
    {
        if(request()->business_id)
        {
            $business = Business::where('id', request()->business_id)->first();
            if(!$business)
            {
                \Alert::error('Business not found.')->flash();
                abort(400, 'Business not found.');
            }
            if($business->business_owner_id != $this->user->businessOwner->id)
            {
                abort(401);
            }
        }

        if(request()->business_id)
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
                    return $query->where('active', 1)->where('business_owner_id', $this->user->businessOwner->id)->get();
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
    }

}
