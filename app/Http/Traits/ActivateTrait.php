<?php

namespace App\Http\Traits;

trait ActivateTrait 
{
    /**
     * Activate
     */
    public function activate($id)
    {
        if(! $this->crud->hasAccess('activate')) {
            abort(401);
        }

        $model = $this->crud->model->findOrFail($id);
        $model->active = 1;
        $model->save();

        \Alert::add('success', 'The ' . $this->crud->entity_name . ' has been activated successfully.')->flash();
        return redirect()->back();
    }

    /**
     * Deactivate
     */
    public function deactivate($id)
    {
        if(! $this->crud->hasAccess('deactivate')) {
            abort(401);
        }

        $model = $this->crud->model->findOrFail($id);
        $model->active = 0;
        $model->save();

        \Alert::add('success', 'The ' . $this->crud->entity_name . ' has been deactivated successfully.')->flash();
        return redirect()->back();
    }
}