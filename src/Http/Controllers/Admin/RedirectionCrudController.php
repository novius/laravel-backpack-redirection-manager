<?php

namespace Novius\Backpack\RedirectionManager\Http\Controllers\Admin;

use Novius\Backpack\CRUD\Http\Controllers\CrudController;
use Novius\Backpack\RedirectionManager\Http\Requests\Admin\RedirectionRequest as StoreRequest;
use Novius\Backpack\RedirectionManager\Http\Requests\Admin\RedirectionRequest as UpdateRequest;

class RedirectionCrudController extends CrudController
{
    /**
     * Sets the configuration options for the CRUD.
     */
    public function setup()
    {
        $this->crud->setModel(config('missing-page-redirector.redirector_model'));
        $this->crud->setRoute(route('crud.redirection.index'));
        $this->crud->setEntityNameStrings(
            trans('backpack-redirection-manager::crud.entity_singular'),
            trans('backpack-redirection-manager::crud.entity_plural')
        );

        // Fields
        $this->crud->addField([
            'name' => 'from',
            'type' => 'text',
            'label' => trans('backpack-redirection-manager::crud.field_label_from'),
        ]);
        $this->crud->addField([
            'name' => 'to',
            'type' => 'text',
            'label' => trans('backpack-redirection-manager::crud.field_label_to'),
        ]);

        // Columns
        $this->crud->addColumn([
            'name' => 'from',
            'label' => trans('backpack-redirection-manager::crud.column_label_from'),
        ]);
        $this->crud->addColumn([
            'name' => 'to',
            'label' => trans('backpack-redirection-manager::crud.column_label_to'),
        ]);

        $this->crud->orderBy('created_at', 'desc');
    }

    /**
     * Store a newly created resource in the database.
     *
     * @param StoreRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        return parent::storeCrud($request);
    }

    /**
     * Update the specified resource in the database.
     *
     * @param UpdateRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud($request);
    }
}
