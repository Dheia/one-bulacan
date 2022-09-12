<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SaleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Permission;
use App\Models\Business;
use App\Models\Sale;
use App\Models\Log;

/**
 * Class SaleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SaleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Sale');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/sale');
        $this->crud->setEntityNameStrings('sale', 'sales');

        // Allow Button Access
        $this->crud->allowAccess('notify');
        $this->crud->allowAccess('message');
        $this->crud->allowAccess('email');
        $this->crud->allowAccess('verify');
        $this->crud->allowAccess('paid');

        $this->crud->denyAccess('create');
        $this->crud->denyAccess('update');
        $this->crud->denyAccess('delete');

        // Permissions With Access
        $permissions = [
            'list'      =>  'access sale',
            'show'      =>  'read sale',
            'notify'    =>  'notify sale',
            'message'   =>  'message sale',
            'email'     =>  'email sale',
            'verify'    =>  'verify sale',
            'paid'      =>  'paid sale',
        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

        // Add Buttons
        $this->crud->addButtonFromView('line', 'sales.notified', 'sales.notified', 'beginning');
        $this->crud->addButtonFromView('line', 'sales.messaged', 'sales.messaged', 'beginning');
        $this->crud->addButtonFromView('line', 'sales.emailed', 'sales.emailed', 'beginning');
        $this->crud->addButtonFromView('line', 'sales.verified', 'sales.verified', 'beginning');
        $this->crud->addButtonFromView('line', 'sales.paid', 'sales.paid', 'beginning');

        $this->crud->setListView('sales.sales_list');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'label' => "Business",
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business'
        ]);
        $this->crud->addColumn([
            'label' => "Contact Person",
            'type' => "text",
            'name' => 'contact_person'
        ]);
        $this->crud->addColumn([
            'label' => "Contact Number",
            'type' => "text",
            'name' => 'contact_number'
        ]);
        $this->crud->addColumn([
            'label' => "Payment Thru",
            'type' => "text",
            'name' => 'payment_thru'
        ]);
        $this->crud->addColumn([
            'label' => "Reference No",
            'type' => "text",
            'name' => 'reference_no'
        ]);
        $this->crud->addColumn([
            'label' => "Paid to",
            'type' => "text",
            'name' => 'paid_to'
        ]);
        $this->crud->addColumn([
            'label' => "Date Registered",
            'type' => "datetime",
            'name' => 'date_registered'
        ]);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'text'
        ]);
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'label' => "Business",
            'type' => 'select',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business'
        ]);
        $this->crud->addColumn([
            'label' => "Contact Person",
            'type' => "text",
            'name' => 'contact_person'
        ]);
        $this->crud->addColumn([
            'label' => "Contact Number",
            'type' => "text",
            'name' => 'contact_number'
        ]);
        $this->crud->addColumn([
            'label' => "Payment Thru",
            'type' => "text",
            'name' => 'payment_thru'
        ]);
        $this->crud->addColumn([
            'label' => "Reference No",
            'type' => "text",
            'name' => 'reference_no'
        ]);
        $this->crud->addColumn([
            'label' => "Paid to",
            'type' => "text",
            'name' => 'paid_to'
        ]);
        $this->crud->addColumn([
            'label' => "Date Registered",
            'type' => "datetime",
            'name' => 'date_registered'
        ]);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'text'
        ]);
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SaleRequest::class);

        $this->crud->addField([
            'label' => "Business",
            'type' => 'select2',
            'name' => 'business_id',
            'entity' => 'business',
            'attribute' => 'name',
            'model' => 'App\Models\Business',
            'options'   => (function ($query) {
                return $query->whereNotIn('id', Sale::all()->pluck('business_id'))->get();
            }), 
        ]);
        $this->crud->addField([
            'label' => "Payment Thru",
            'type' => "text",
            'name' => 'payment_thru'
        ]);
        $this->crud->addField([
            'label' => "Reference No",
            'type' => "text",
            'name' => 'reference_no'
        ]);
        $this->crud->addField([
            'label' => "Paid to",
            'type' => "text",
            'name' => 'paid_to'
        ]);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function notify($id){
        $sale = $this->crud->model::where('id', $id)->first();

        if($sale->notified == 0){
            $sale->notified = 1;
        }
        else{
            $sale->notified == 0;
        }

        if($sale->update()){
            $log = new Log();
            $log->business_id =  $sale->business_id;
            $log->action = "Notified";
            $log->save();
            \Alert::success('Successfully Notified.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else{
            \Alert::error('Error Notifying, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function message($id){
        $sale = $this->crud->model::where('id', $id)->first();

        if($sale->messaged == 0){
            $sale->messaged = 1;
        }
        else{
            $sale->messaged == 0;
        }

        if($sale->update()){
            $log = new Log();
            $log->business_id =  $sale->business_id;
            $log->action = "Messaged";
            $log->save();
            \Alert::success('Successfully Messaged.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else{
            \Alert::error('Error Messaging, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function email($id)
    {
        // Abort If Has No Permission To Delete Business Product
        Permission::hasPermissionOr401('delete business product-services');

        $sale = $this->crud->model::where('id', $id)->first();

        if($sale->emailed == 0){
            $sale->emailed = 1;
        }
        else{
            $sale->emailed == 0;
        }
        // Check if the Emailed if Update Successfully 
        if($sale->update()){
            // Insert the Action in Log Table
            $log = new Log();
            $log->business_id =  $sale->business_id;
            $log->action = "Emailed";
            $log->save();
            \Alert::success('Successfully Emailed.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else{
            \Alert::error('Error Emailing, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function complimentary($id){
        $sale = $this->crud->model::where('id', $id)->first();

        if($sale->complimentary == 0){
            $sale->complimentary = 1;
        }
        else{
            $sale->complimentary == 0;
        }
        // Check if the Emailed if Update Successfully 
        if($sale->update()){
            // Insert the Action in Log Table
            $log = new Log();
            $log->business_id =  $sale->business_id;
            $log->action = "Complimtary";
            $log->save();
            \Alert::success('Successfully Complimentary.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else{
            \Alert::error('Error Complimentarying, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function verify($id){
        $sale = $this->crud->model::where('id', $id)->first();

        $business = Business::findOrFail($sale->business_id);
        // Abort If Not Referred By User
        Business::referredByUserOr403($business->referrer_user_id);
            
        $business->verified = 1;
        // Check if the Emailed if Update Successfully 
        if($business->update()){
            // Insert the Action in Log Table
            $log = new Log();
            $log->business_id =  $sale->business_id;
            $log->action = "Verified";
            $log->save();
            \Alert::success('Successfully Verified.')->flash();
            return \Redirect::to($this->crud->route);
        }
        else{
            \Alert::error('Error Verifying, Something Went Wrong, Please Try Again.')->flash();
            return \Redirect::to($this->crud->route);
        }
    }

    public function paid(SaleRequest $request){
        // Validation base on Mode of Payment
        if(request('payment_thru') == 'Cash'){
            $validatedData  =   $request->validate([
                                    'payment_thru'  =>  'required',
                                    'paid_to'       =>  'nullable|required_if:payment_thru,Cash',
                                    'reference_no'  =>  'nullable'
                                ]);
        }
        else if(request('payment_thru') == 'Complimentary'){
            $validatedData  =   $request->validate([
                                    'payment_thru'  =>  'required',
                                    'paid_to'       =>  'nullable',
                                    'reference_no'  =>  'nullable'
                                ]);
        }
        else{
            $validatedData  =   $request->validate([
                                    'payment_thru'  =>  'required',
                                    'paid_to'       =>  'nullable',
                                    'reference_no'  =>  'required'
                                ]);
        }

        $id                 =   request('sales_id');
        $sale               =   $this->crud->model::where('id', $id)->first();
        $business           =   Business::where('id', $sale->business_id)->first();

        // Get the Last log Publish/Published Renew
        $business_last_log  =   Log::orderBy('id', 'DESC')
                                    ->where('business_id', $business->id)
                                    ->whereIn('action', ['Published', 'Published Renew'])
                                    ->first();

        if($sale->paid == 0){
            $sale->paid             =   1;
            $sale->payment_thru     =   request('payment_thru');

            // Check if what payment mode
            if(request('payment_thru') == 'Cash'){
                $sale->paid_to          =   request('paid_to');
                $sale->complimentary    =   0;
            }
            else if(request('payment_thru') == 'Complimentary'){
                $sale->paid_to          =   request('paid_to');
                $sale->complimentary    =   1;
            }
            else{
                $sale->reference_no     =   request('reference_no');
                $sale->complimentary    =   0;
            }
            // Check if the sale is Succesfully Updated
            if($sale->update()){
                // Insert the Action in Log Table
                $log                =   new Log();
                $log->business_id   =   $business->id;

                if(request('payment_thru') == 'Cash'){
                    $log->action    =   "Paid thru Cash to ". request('paid_to');
                }
                else if(request('payment_thru') == 'Complimentary'){
                    $log->action    =   "Paid thru Complimentary";
                }
                else{
                    $log->action    =   "Paid thru ".request('payment_thru')." with reference no. of ".request('reference_no');
                }
                // Assign the start_at of the paid action base on last publish/renew
                if($business_last_log ?? '')
                {
                    $log->start_at  =   $business_last_log->start_at;
                    $log->end_at    =   $business_last_log->end_at;
                }
                
                $log->save();

                \Alert::success('Successfully Paid.')->flash();
                return \Redirect::to($this->crud->route);
            }
            else{
                \Alert::error('Error Paying, Something Went Wrong, Please Try Again.')->flash();
                return \Redirect::to($this->crud->route);
            }
           
        }
    }
}
