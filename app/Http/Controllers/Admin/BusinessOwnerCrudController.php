<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusinessOwnerRequest;
use App\Http\Requests\UpdateBusinessOwnerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Permission;
use App\Models\BusinessOwner;
use App\Models\BusinessCredential;

use Illuminate\Support\Facades\Hash;

/**
 * Class BusinessOwnerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BusinessOwnerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store  as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update  as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {destroy as traitDestroy;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\BusinessOwner::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/business-owner');
        CRUD::setEntityNameStrings('Business Owner', 'Business Owners');

        // Allow Access
        CRUD::allowAccess('details_row');
        CRUD::allowAccess('reset-password');
        CRUD::allowAccess('activate account');
        CRUD::allowAccess('deactivate account');
        CRUD::enableDetailsRow();

        // Permissions With Access
        $permissions = [
            'list'      =>  'access business owner',
            'create'    =>  'create business owner',
            'show'      =>  'read business owner',
            'update'    =>  'update business owner',
            'delete'    =>  'delete business owner',
            'reset-password'      =>  'reset business owner password',
            'activate account'    =>  'activate business owner account',
            'deactivate account'  =>  'deactivate business owner account'
        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

        // Dropdown Button / More Button
        $this->crud->data['dropdownButtons'] = [
            'show',
            'businessOwner.reset_password',
            'businessOwner.activate_account',
            'businessOwner.deactivate_account'
        ];
        $this->crud->addButtonFromView('line', 'More', 'dropdownButton', 'beginning');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::removeButton('show');
        // CRUD::addButtonFromView('line', 'Reset Password', 'reset_password', 'beginning');
        // CRUD::addButtonFromView('line', 'Activate Account', 'businessOwner.activate_account', 'beginning');
        // CRUD::addButtonFromView('line', 'Deactivate Account', 'businessOwner.deactivate_account', 'beginning');

        CRUD::addColumn([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image'
        ]);

        CRUD::addColumn([
            'name' => 'fullname',
            'label' => 'Fullname',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'mobile',
            'label' => 'Mobile No.',
            'type' => 'phone'
        ]);

        CRUD::addColumn([
            'name' => 'telephone',
            'label' => 'Telephone No.',
            'type' => 'phone'
        ]);

        CRUD::addColumn([
            'name' => 'email',
            'label' => 'Email',
            'type' => 'email'
        ]);

        CRUD::addColumn([
            'name' => 'gender',
            'label' => 'Gender',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name'  => 'active',
            'label' => 'Active',
            'type'  => 'boolean',
            // optionally override the Yes/No texts
            'options' => [0 => 'Inactive', 1 => 'Active'],
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Active') {
                        return 'badge badge-success';
                    }
                    return 'badge badge-default';
                }, 
            ]
        ]);

        CRUD::with('credential');

        // CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BusinessOwnerRequest::class);

        // CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */

        CRUD::addField([
            'name'  => 'firstname', //database column name
            'label' => 'Firstname', //Label
            'type'  => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        CRUD::addField([
            'name'  => 'middlename', //database column name
            'label' => 'Middlename', //Label
            'type'  => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        CRUD::addField([
            'name'  => 'lastname', //database column name
            'label' => 'Lastname', //Label
            'type'  => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        CRUD::addField([
            'name'  => 'gender', //database column name
            'label' => 'Gender', //Label
            'type'  => 'enum',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);

        CRUD::addField([
            'name'  => 'mobile', //database column name
            'label' => 'Mobile', //Label
            'type'  => 'number',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);

        CRUD::addField([
            'name' => 'telephone', //database column name
            'label' => 'Telephone No.', //Label
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);

        CRUD::addField([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 1,
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        CRUD::addField([
            'name'  => 'email', //database column name
            'label' => 'Email', //Label
            'type'  => 'email'
        ]);

        CRUD::addField([
            'name'  => 'password', //database column name
            'label' => 'Password', //Label
            'type'  => 'password'
        ]);

        CRUD::addField([
            'name'  => 'password_confirmation', //database column name
            'label' => 'Password Confirmation', //Label
            'type'  => 'password'
        ]);

    }

    public function show($id)
    {
        CRUD::addColumn([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image'
        ]);

        CRUD::addColumn([
            'name' => 'firstname',
            'label' => 'Firstname',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'middlename',
            'label' => 'Middlename',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'lastname',
            'label' => 'Lastname',
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'mobile',
            'label' => 'Mobile No.',
            'type' => 'phone'
        ]);

        CRUD::addColumn([
            'name' => 'telephone',
            'label' => 'Telephone No.',
            'type' => 'phone'
        ]);

        CRUD::addColumn([
            'name' => 'email',
            'label' => 'Email',
            'type' => 'email'
        ]);

        CRUD::addColumn([
            'name' => 'gender',
            'label' => 'Gender',
            'type' => 'text'
        ]);
        // custom logic before
        $content = $this->traitShow($id);
        // cutom logic after
        return $content;
    }

    public function showDetailsRow($id)
    {
        $this->crud->hasAccessOrFail('details_row');

        $this->data['entry'] = BusinessOwner::where('id', $id)->with('businesses')->first();
        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('crud::businessOwner.details_row', $this->data);
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

        CRUD::setValidation(UpdateBusinessOwnerRequest::class);
        CRUD::removeFields(['password', 'password_confirmation']);
    }

    public function store()
    {
        // Abort If Has No Permission To Create Business Owner
        Permission::hasPermissionOr401('create business owner');

        $password = Hash::make($this->crud->getRequest()->password);

        $response = $this->traitStore();
        // do something after save
        // Create Business Credentials
        $businessCredential                     =   new BusinessCredential();
        $businessCredential->business_owner_id  =   $this->crud->entry->id;
        $businessCredential->email              =   $this->crud->entry->email;
        $businessCredential->password           =   $password;
        $businessCredential->save();

        return $response;
    }

    public function update()
    {
        // Abort If Has No Permission To Update Business Owner
        Permission::hasPermissionOr401('update business owner');

        $response = $this->traitUpdate();
        // do something after save
        $businessCredential           =   BusinessCredential::where('business_owner_id', $this->crud->entry->id)->first();
        // Update Business Credentials If Exist and Create If Not Exist
        if($businessCredential)
        {
            // Update Business Credentials
            $businessCredential->business_owner_id  =   $this->crud->entry->id;
            $businessCredential->email              =   $this->crud->entry->email;
            $businessCredential->update();
        }
        else {
            // Create Business Credentials
            $businessCredential                     =   new BusinessCredential();
            $businessCredential->business_owner_id  =   $this->crud->entry->id;
            $businessCredential->email              =   $this->crud->entry->email;
            $businessCredential->save();
        }

        return $response;
    }

    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        // Abort If Has No Permission To Delete Business Owner
        Permission::hasPermissionOr401('delete business owner');

        $credential     =   BusinessCredential::where('business_owner_id', $id)->first();
        if($credential)
        {
            $credential->active     =   0;
            $credential->update();
        }

        return $this->crud->delete($id);
    }

    public function resetPassword($id)
    {
        // Abort If Has No Permission To Reset Business Owner Password
        Permission::hasPermissionOr401('reset business owner password');

        $businessOwner              =   BusinessOwner::findOrFail($id);
        $credential                 =   BusinessCredential::where('business_owner_id', $businessOwner->id)->first();
        $password                   =   Hash::make('pass1234');

        if(!$credential)
        {
            $this->createCreateAccount($businessOwner);
            $credential                     =   new BusinessCredential();
            $credential->business_owner_id  =   $businessOwner->id;
            $credential->email              =   $businessOwner->email;
            $credential->password           =   $password;
            $credential->save();

            \Alert::success("Password Reset <br> The password has been reset successfully.")->flash();
            return redirect()->back();
        }

        $credential->password             =   $password;
        $credential->is_first_time_login  =   1;

        $credential->update();

        \Alert::success("Password Reset <br> The password has been reset successfully.")->flash();
        return redirect()->back();
    }

    public function activateAccount($businessOwner_id)
    {
        // Abort If Has No Permission To Activate Business Owner Account
        Permission::hasPermissionOr401('activate business owner account');

        $businessOwner          =   BusinessOwner::findOrFail($businessOwner_id);
        $businessOwner->active  =   1;
        $businessOwner->update();

        $credential                 =   BusinessCredential::where('business_owner_id', $businessOwner->id)->first();
        $password                   =   Hash::make('pass1234');

        if(!$credential)
        {
            $credential                     =   new BusinessCredential();
            $credential->business_owner_id  =   $businessOwner->id;
            $credential->email              =   $businessOwner->email;
            $credential->password           =   $password;
            $credential->active             =   1;
            $credential->save();

            \Alert::success("Accont Activated <br> The account has been activated successfully")->flash();
            return redirect()->back();
        }

        $credential->email              =   $businessOwner->email;
        $credential->password           =   $password;
        $credential->active             =   1;
        $credential->update();

        \Alert::success("Accont Activated <br> The account has been activated successfully")->flash();
        return redirect()->back();
    }

    public function deactivateAccount($businessOwner_id)
    {
        // Abort If Has No Permission To Deactivate Business Owner Account
        Permission::hasPermissionOr401('deactivate business owner account');

        $businessOwner          =   BusinessOwner::findOrFail($businessOwner_id);
        $businessOwner->active  =   0;
        $businessOwner->update();

        $credential                 =   BusinessCredential::where('business_owner_id', $businessOwner->id)->first();
        if($credential)
        {
            $credential->active     =   0;
            $credential->update();
        }

        \Alert::success("Accont Deactivated <br> The account has been deactivated successfully")->flash();
        return redirect()->back();
    }
}
