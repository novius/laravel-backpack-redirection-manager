<?php

namespace Novius\Backpack\RedirectionManager\Http\Controllers\Admin;

use App\Models\Redirection;
use Novius\Backpack\CRUD\Http\Controllers\CrudController;
use App\Http\Requests\Admin\RedirectionRequest as StoreRequest;
use App\Http\Requests\Admin\RedirectionRequest as UpdateRequest;

class RedirectionCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setModel(Redirection::class);
        $this->crud->setRoute(route('crud.redirection.index'));
        $this->crud->setEntityNameStrings(
            trans('redirection.redirection'),
            trans('redirection.redirections')
        );

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD FIELDS

        $this->crud->addField([
            'name' => 'from',
            'type' => 'text',
            'label' => trans('redirection.from'),
        ]);
        $this->crud->addField([
            'name' => 'to',
            'type' => 'text',
            'label' => trans('redirection.to'),
        ]);

        // ------ CRUD COLUMNS

        $this->crud->addColumn([
            'name' => 'from',
            'label' => trans('redirection.from'),
        ]);

        $this->crud->addColumn([
            'name' => 'to',
            'label' => trans('redirection.to'),
        ]);

        $this->crud->orderBy('created_at', 'desc');
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud($request);
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud($request);
    }
}
