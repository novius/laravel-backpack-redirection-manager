# Backpack Redirection Manager
[![Travis](https://img.shields.io/travis/novius/laravel-backpack-redirection-manager.svg?maxAge=1800&style=flat-square)](https://travis-ci.org/novius/laravel-backpack-redirection-manager)
[![Packagist Release](https://img.shields.io/packagist/v/novius/laravel-backpack-redirection-manager.svg?maxAge=1800&style=flat-square)](https://packagist.org/packages/novius/laravel-backpack-redirection-manager)
[![Licence](https://img.shields.io/packagist/l/novius/laravel-backpack-redirection-manager.svg?maxAge=1800&style=flat-square)](https://github.com/novius/laravel-backpack-redirection-manager#licence)

This package provides an admin panel to manage redirections with [spatie/laravel-missing-page-redirector](https://github.com/spatie/laravel-missing-page-redirector).

## Installation

You can install the package via composer:

```sh
composer require novius/laravel-backpack-redirection-manager
```

The package will automatically register itself.

Next you must register the `Spatie\MissingPageRedirector\RedirectsMissingPages` middleware :

```php
//app/Http/Kernel.php

protected $middleware = [
    ...
    \Spatie\MissingPageRedirector\RedirectsMissingPages::class,
],
```

Finally you can add a link in the Backpack sidebar :

```
<li>
    <a href="{{ route('crud.redirection.index') }}">
        <i class="fa fa-arrows-h"></i>
        <span>{{ trans('redirection-manager::crud.sidebar_title') }}</span>
    </a>
</li>
```

## Configuration

This package provides a configuration file whose values overwrite the configuration of `spatie/laravel-missing-page-redirector`.

You can publish the configuration file if you want to change these values :
```
php artisan vendor:publish --provider="Novius\Backpack\RedirectionManager\RedirectionManagerServiceProvider" --tag=config
```

You can also publish the migrations, lang and routes :
```
php artisan vendor:publish --provider="Novius\Backpack\RedirectionManager\RedirectionManagerServiceProvider" --tag=migrations
php artisan vendor:publish --provider="Novius\Backpack\RedirectionManager\RedirectionManagerServiceProvider" --tag=lang
php artisan vendor:publish --provider="Novius\Backpack\RedirectionManager\RedirectionManagerServiceProvider" --tag=routes
```

## Lint

Run php-cs with:

```sh
./cs.sh
```

## Contributing

Contributions are welcome!
Leave an issue on Github, or create a Pull Request.

## Licence

This package is under [GNU Affero General Public License v3](http://www.gnu.org/licenses/agpl-3.0.html) or (at your option) any later version.
