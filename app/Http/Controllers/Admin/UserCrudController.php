<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\User;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation { destroy as traitDestroy; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        // CRUD::setModel(\App\Models\User::class);
        $this->crud->setModel(config('backpack.base.user_model_fqn'));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');

        CRUD::allowAccess('reset-password');
        CRUD::allowAccess('copyReferralLink');
        // Permissions With Access
        $permissions = [
            'list'      =>  'access user',
            'create'    =>  'create user',
            'show'      =>  'read user',
            'update'    =>  'update user',
            'delete'    =>  'delete user',
            'reset-password'    =>   'reset user password'
        ];

        foreach ($permissions as $access => $permission) 
        {
            // Deny Access If User Didn't Has Permission
            if(!backpack_user()->hasPermissionTo($permission))
            {
                $this->crud->denyAccess($access);
            }
        }

        CRUD::setColumns([
            [
                'name'  => 'name',
                'label' => trans('backpack::permissionmanager.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'username',
                'label' => 'Username',
                'type'  => 'text'
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
            ],
            [ // n-n relationship (with pivot table)
               'label'     => trans('backpack::permissionmanager.roles'), // Table column heading
               'type'      => 'select_multiple',
               'name'      => 'roles', // the method that defines the relationship in your Model
               'entity'    => 'roles', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model'     => config('permission.models.role'), // foreign key model
            ],
            [
                'name'  => 'referral_link',
                'label' => 'Referral Link',
                'type'  => 'markdown'
            ],
            [ // n-n relationship (with pivot table)
               'label'     => trans('backpack::permissionmanager.extra_permissions'), // Table column heading
               'type'      => 'select_multiple',
               'name'      => 'permissions', // the method that defines the relationship in your Model
               'entity'    => 'permissions', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model'     => config('permission.models.permission'), // foreign key model
            ],
        ]);

        // Dropdown Button / More Button
        $this->crud->data['dropdownButtons'] = [
            'show',
            'reset_password',
            'user.copy_referral_link'
        ];

        if(CRUD::hasAccess('reset-password') && CRUD::hasAccess('show'))
        {
            $this->crud->addButtonFromView('line', 'More', 'dropdownButton', 'beginning');
        }

        if(!CRUD::hasAccess('show') && CRUD::hasAccess('reset-password'))
        {
            $this->crud->addButtonFromView('line', 'reset_password', 'reset_password', 'beginning');
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
        if(CRUD::hasAccess('reset-password'))
        {
            CRUD::removeButton('show');
        }
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
        CRUD::setValidation(UserRequest::class);

        CRUD::addField([
            'name'  => 'name',
            'label' => trans('backpack::permissionmanager.name'),
            'type'  => 'text',
        ]);

        CRUD::addField([
            'name'  => 'username',
            'label' => 'Username',
            'type'  => 'text'
        ]);

        CRUD::addField([
            'name'  => 'email',
            'label' => trans('backpack::permissionmanager.email'),
            'type'  => 'email',
        ]);

        CRUD::addField([
            'name'  => 'password',
            'label' => trans('backpack::permissionmanager.password'),
            'type'  => 'password'
        ]);

        CRUD::addField([
            'name'  => 'password_confirmation',
            'label' => trans('backpack::permissionmanager.password_confirmation'),
            'type'  => 'password'
        ]);

        CRUD::addField([
            'label' => 'Allow access to the admin link.',
            'type'  => 'boolean',
            'name'  => 'is_admin',
            'default' => 1
        ]);

        CRUD::addField([   // two interconnected entities
            'label'             => 'User Role Permissions',
            'field_unique_name' => 'user_role_permission',
            'type'              => 'checklist_dependency_custom',
            'name'              => ['roles', 'permissions'], // the methods that define the relationship in your Models
            'subfields'         => [
                'primary' => [
                    'label'            => 'Roles',
                    'name'             => 'roles', // the method that defines the relationship in your Model
                    'entity'           => 'roles', // the method that defines the relationship in your Model
                    'entity_secondary' => 'permissions', // the method that defines the relationship in your Model
                    'attribute'        => 'name', // foreign key attribute that is shown to user
                    'model'            => "App\Models\Role", // foreign key model
                    'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
                    'number_columns'   => 3, //can be 1,2,3,4,6
                ],
                'secondary' => [
                    'label'          => 'Permission',
                    'name'           => 'permissions', // the method that defines the relationship in your Model
                    'entity'         => 'permissions', // the method that defines the relationship in your Model
                    'entity_primary' => 'roles', // the method that defines the relationship in your Model
                    'attribute'      => 'name', // foreign key attribute that is shown to user
                    'model'          => "App\Models\Permission", // foreign key model
                    'pivot'          => true, // on create&update, do you need to add/delete pivot table entries?]
                    'number_columns' => 4, //can be 1,2,3,4,6
                ],
            ],
        ]);

        if($this->crud->getActionMethod() === "edit") {
            CRUD::addField([
                'label' => 'email',
                'type' => 'email',
                'name'  => 'email',
                'attributes' => [
                    'readonly' => true
                ]   
            ]);
        }
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

        CRUD::setValidation(UpdateUserRequest::class);

        CRUD::removeField('password');
        CRUD::removeField('password_confirmation');
    }

    /**
     * Store a newly created resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        // Abort If Has No Permission To Create User
        Permission::hasPermissionOr403('create user');

        $code = substr(md5(uniqid(mt_rand(), true)) , 0, 7);
        CRUD::setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);
        CRUD::getRequest()->request->add(['code'  =>  $code]);

        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->setRequest($this->handlePasswordInput($this->crud->getRequest()));
        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitStore();
    }

    /**
     * Update the specified resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        // Abort If Has No Permission To Update User
        Permission::hasPermissionOr403('update user');

        $id     = CRUD::getRequest()->id;
        $user   = User::findOrFail($id);
        if(!$user->code)
        {
            $code = substr(md5(uniqid(mt_rand(), true)) , 0, 7);
            CRUD::setOperationSetting('saveAllInputsExcept', ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);
            CRUD::getRequest()->request->add(['code'  =>  $code]);
        }
        $response = $this->traitUpdate();
        // do something after save
        return $response;
    }

    /**
     * Delete the specified resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Permission::hasPermissionOr401('delete user');
        
        $this->crud->hasAccessOrFail('delete');

        return $this->crud->delete($id);
    }

    public function resetPassword($id)
    {
        Permission::hasPermissionOr401('reset user password');

        $user                       =   $this->crud->model::findOrFail($id);
        $password                   =   Hash::make('admin1234');
        $user->password             =   $password;
        $user->is_first_time_login  =   1;

        $user->update();

        \Alert::success("Password Reset Successfully")->flash();
        return redirect()->back();
    }

    /**
     * Handle password input fields.
     */
    protected function handlePasswordInput($request)
    {
        // Remove fields not present on the user.
        $request->request->remove('password_confirmation');
        $request->request->remove('roles_show');
        $request->request->remove('permissions_show');

        // Encrypt password if specified.
        if ($request->input('password')) {
            $request->request->set('password', Hash::make($request->input('password')));
        } else {
            $request->request->remove('password');
        }

        return $request;
    }

}
