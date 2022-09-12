<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PaybizWalletRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

// Models
use App\Models\Business;
use App\Models\PaybizWallet;

use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Class PaybizWalletCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PaybizWalletCrudController extends CrudController
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
        CRUD::setModel(\App\Models\PaybizWallet::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/paybiz-wallet');
        CRUD::setEntityNameStrings('paybiz wallet', 'paybiz wallets');

        // Permissions With Access
        $permissions = [
            'list'    =>  'access paybiz-wallet',
            'create'  =>  'create paybiz-wallet',
            'show'    =>  'read paybiz-wallet',
            'update'  =>  'update paybiz-wallet',
            'delete'  =>  'delete paybiz-wallet',

            'activate'   => 'activate paybiz-wallet',
            'deactivate' => 'deactivate paybiz-wallet',

            'inclusive' => 'inclusive paybiz-wallet',
            'exclusive' => 'exclusive paybiz-wallet',

            'qrcode'    => 'qrcode paybiz-wallet'
        ];

        CRUD::allowAccess('activate');
        CRUD::allowAccess('deactivate');
        
        CRUD::allowAccess('inclusive');
        CRUD::allowAccess('exclusive');
        
        CRUD::allowAccess('qrcode');

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
        // CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */

        self::addColumns();

        $this->crud->data['dropdownButtons'] = [
            'inclusive',
            'activate',
            'update',
            'delete'
        ];

        CRUD::removeButtons(['revise', 'show', 'update', 'delete']);
        CRUD::addButtonFromView('line', 'QRCode', 'business.qrcode', 'beginning');
        CRUD::addButtonFromView('line', 'More', 'dropdownButton', 'beginning');
        CRUD::addButtonFromView('line', 'Revise', 'revise_button', 'beginning');
        CRUD::addButtonFromView('line', 'Show', 'show', 'beginning');

        // CRUD::setListView('business.paybiz_wallet_list');
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
        CRUD::setValidation(PaybizWalletRequest::class);

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
        $this->setupCreateOperation();
    }

    /** 
     * FIELDS
     * 
     * @see https://backpackforlaravel.com/docs/crud-fields
     */
    private function addFields()
    {
        CRUD::addField([  // Select2
            'label'     => "Business",
            'type'      => 'select2',
            'name'      => 'business_id', // the db column for the foreign key
         
            // optional
            'entity'    => 'business', // the method that defines the relationship in your Model
            'model'     => "App\Models\Business", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'allows_null' => true,
         
             // also optional
            'options'   => (function ($query) {
                return $query->active()->orderBy('name', 'ASC')->get();
            })
        ]);

        CRUD::addField([
            'label' => 'Biz ID',
            'name' => 'biz_wallet_id',
            'type' => 'text'
        ]);

        CRUD::addField([
            'label' => 'Descriptor Note',
            'name' => 'descriptor_note',
            'type' => 'text'
        ]);

        CRUD::addField([
            'label' => 'Minimum Amount',
            'name' => 'minimum_amount',
            'type' => 'text'
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
            'label'     => 'Business',
            'type'      => 'select',
            'name'      => 'business_id',
            'entity'    => 'business',
            'attribute' => 'name',
            'model'     => "App\Models\Business",
        ]);

        CRUD::addColumn([
            'label' => 'Biz Id',
            'name' => 'biz_wallet_id',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'label' => 'Descriptor Note',
            'name' => 'descriptor_note',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'label' => 'Minimum Amount',
            'name' => 'minimum_amount',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'label' => 'Inclusive',
            'name' => 'is_inclusive',
            'type' => 'check'
        ]);

        CRUD::addColumn([
            'label' => 'Exclusive',
            'name' => 'is_exclusive',
            'type' => 'check'
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
     * Generate QR Code / Download
     */
    public function generateQrCode($id)
    {
        if(! $this->crud->hasAccess('qrcode')) {
            abort(401);
        }

        $paybizWallet = PaybizWallet::findOrFail($id);
        $business     = $paybizWallet->business;

        if(! $business) {
            \Alert::warning('success', "Paybiz Wallet's Business Not Found.")->flash();
            return redirect()->back();
        }

        $qr_code = Business::generatePaymentQr($business->slug, 250);

        ini_set('max_execution_time', 300);
        ini_set('memory_limit', -1);

        // $qr_design_template = (string)\Image::make('v2/content/one/images/arcylic.png')->encode('data-url');
        // $business_logo = (string)\Image::make($business->logo)->encode('data-url');

        return view('business.qr_code_pdf', compact('business', 'qr_code'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML( view('business.qr_code_pdf', compact('business', 'qr_code')) );
        return $pdf->stream();

        // $pdf = PDF::loadHTML( view('business.qr_code_pdf', compact('business', 'qr_code')) );
        // return $pdf->stream();
    }

    /**
     * Get QR Code ( API )
     */
    public function getQrCode($id)
    {
        if(! $this->crud->hasAccess('qrcode')) {
            abort(401);
        }

        $paybizWallet = PaybizWallet::where('id', $id)->first();
        if(! $paybizWallet) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Paybiz Wallet Not Found.'
            ]);
        }

        $business     = $paybizWallet->business;
        if(! $business) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Business Not Found.'
            ]);
        }

        $qr_code = Business::generatePaymentQr($business->slug, 300);
        return response()->json([
            'status' => 'success',
            'data' => $qr_code,
            'message' => $qr_code ? 'QR Code' : 'QR Code Not Found.'
        ]);
    }

     /**
     * Inclusive
     */
    public function inclusive($id)
    {
        if(! $this->crud->hasAccess('inclusive')) {
            abort(401);
        }

        $model = $this->crud->model->findOrFail($id);
        $model->is_inclusive = 1;
        $model->save();

        \Alert::add('success', 'The ' . $this->crud->entity_name . ' has been set to inclusive payment successfully.')->flash();
        return redirect()->back();
    }

    /**
     * Exclusive
     */
    public function exclusive($id)
    {
        if(! $this->crud->hasAccess('exclusive')) {
            abort(401);
        }

        $model = $this->crud->model->findOrFail($id);
        $model->is_inclusive = 0;
        $model->save();

        \Alert::add('success', 'The ' . $this->crud->entity_name . ' has been set to exclusive payment successfully.')->flash();
        return redirect()->back();
    }
}
