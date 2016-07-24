## Gravatar Helper

Helper package for creating Gravatar url's and image tags.

### Installation

To install this package you will need:

- Laravel 5+
- PHP 5.4

You must then modify your composer.json file and run composer update to include the latest version of the package in your project.

```json
"require": {
    "kevindierkx/gravatar-helper": "2.0.*"
}
```

Or you can run the composer require command from your terminal.

```php
composer require kevindierkx/gravatar-helper:2.0.*
```

Once the package is installed you need to open ```app/config/app.php``` and register the required service provider.

```php
'providers' => [
    Kevindierkx\GravatarHelper\Providers\LaravelServiceProvider::class,
]
```

Optionaly you can add the following line to your aliases.

```php
'aliases' => [
    'Gravatar' => Kevindierkx\GravatarHelper\Providers\Facades\Gravatar::class,
]
```

### Configuration

Run the following command to publish the package configuration.

```php
php artisan vendor:publish
```

### Usage

To parse an image tag.

```php
Gravatar::image('email@example.com');

// <img src="https://secure.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e?s=80&r=g&d=404">
```

Or to parse an url.

```php
Gravatar::url('email@example.com');

// https://secure.gravatar.com/avatar/5658ffccee7f0ebfda2b226238b1eb6e?s=80&r=g&d=404
```

### Credits

- [Kevin Dierkx](https://github.com/kevindierkx)

### License

The MIT License (MIT). Please see [License File](https://github.com/kevindierkx/gravatar-helper/blob/master/LICENSE) for more information.
