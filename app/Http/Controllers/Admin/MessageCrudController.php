<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MessageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Carbon\Carbon;

/**
 * Class MessageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class MessageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    public function setup()
    {
        $this->crud->setModel('App\Models\Message');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/message');
        $this->crud->setEntityNameStrings('message', 'messages');
        
        CRUD::denyAccess(['create', 'update', 'delete']);
        CRUD::allowAccess('read');
        CRUD::allowAccess('unread');
        
        // Permissions With Access
        $permissions = [
            'list'      =>  'access message',
            'show'      =>  'read message',
            'read'      =>  'read message',
            'unread'    =>  'read message',
        ];

        if(backpack_user()->email != 'dev@tigernethost.com') {
            foreach ($permissions as $access => $permission) 
            {
                // Deny Access If User Didn't Has Permission
                if(!backpack_user()->hasPermissionTo($permission))
                {
                    $this->crud->denyAccess($access);
                }
            }
        }
    }

    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::orderBy('created_at', 'DESC');
        self::addColumns();
        self::addFilters();
        CRUD::addButtonFromView('line', 'Read', 'read', 'beginning');

        // CRUD::disablePersistentTable();
    }

    /**
     * Define what happens when the Show operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-show
     * @return void
     */
    protected function setupShowOperation()
    {
        if(! CRUD::hasAccess('read')) {
            abort(401);
        }

        CRUD::set('show.setFromDb', false);
        // CRUD::setFromDb(); // columns

        self::addColumns();
        // CRUD::addButtonFromView('line', 'Publish', 'publish', 'beginning');

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(MessageRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function show($id)
    {
        // custom logic before
        $content = $this->traitShow($id);

        if($content->entry) {
            $content->entry->read_at = Carbon::now();
            $content->entry->status = 1;
            $content->entry->save();
        }

        // cutom logic after
        return $content;
    }

    /** 
     * COLUMNS
     * 
     * @see https://backpackforlaravel.com/docs/crud-columns
     */
    private function addColumns()
    {
        CRUD::addColumn([
            'label' => 'Sender',
            'name'  => 'sender_name',
            'type'  => 'text'
        ]);

        CRUD::addColumn([
            'label' => 'Email',
            'name'  => 'sender_email',
            'type'  => 'email'
        ]);

        CRUD::addColumn([
            'label' => 'Subject',
            'name'  => 'subject',
            'type'  => 'text'
        ]);

        CRUD::addColumn([
            'label' => 'Content',
            'name'  => 'content',
            'type'  => 'markdown'
        ]);

        CRUD::addColumn([
            'label' => 'Date',
            'name'  => 'created_at',
            'type'  => 'datetime'
        ]);

        CRUD::addColumn([
            'name'    => 'status',
            'label'   => 'Status',
            'type'    => 'text',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'READ') {
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
        CRUD::addFilter([ 
          'type'  => 'simple',
          'name'  => 'unread',
          'label' => 'Show unread messages'
        ],
        false, // the simple filter has no values, just the "Draft" label specified above
        function($value) { // if the filter is active (the GET parameter "draft" exits)
            if($value == 'true') {
                $this->crud->addClause('where', 'read_at', NULL); 
            }
            // we've added a clause to the CRUD so that only elements with draft=1 are shown in the table
            // an alternative syntax to this would have been
            // $this->crud->query = $this->crud->query->where('draft', '1'); 
            // another alternative syntax, in case you had a scopeDraft() on your model:
            // $this->crud->addClause('draft'); 
        });
    }

    /**
     * Read
     */
    public function markAsRead($id)
    {
        if(! CRUD::hasAccess('read')) {
            abort(401);
        }

        $model = $this->crud->model->findOrFail($id);
        $model->read_at = Carbon::now();
        $model->status  = 1;
        $model->save();

        \Alert::add('success', 'The ' . $this->crud->entity_name . ' has been read successfully.')->flash();
        return redirect()->back();
    }
    
    /**
     * Unread
     */
    public function markAsUnread($id)
    {
        if(! CRUD::hasAccess('unread')) {
            abort(401);
        }

        $model = $this->crud->model->findOrFail($id);
        $model->read_at = null;
        $model->status  = 0;
        $model->save();

        \Alert::add('success', 'The ' . $this->crud->entity_name . ' has been unread successfully.')->flash();
        return redirect()->back();
    }
}
