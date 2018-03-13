<?php

/*
|--------------------------------------------------------------------------
| Novius\Backpack\RedirectionManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Novius\Backpack\RedirectionManager package.
|
*/

Route::group(
    [
        'namespace' => 'Novius\Backpack\RedirectionManager\Http\Controllers\Admin',
        'prefix' => config('backpack.base.route_prefix', 'admin'),
        'middleware' => ['web', 'admin'],
    ],
    function () {
        CRUD::resource('redirection', 'RedirectionCrudController');
    }
);
