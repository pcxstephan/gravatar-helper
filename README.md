## Gravatar Helper

Helper package for creating Gravatar url's and image tags.

### Installation

To install this package you will need:

- Laravel 4.2+
- PHP 5.4

You must then modify your composer.json file and run composer update to include the latest version of the package in your project.

```json
"require": {
	"kevindierkx/gravatar-helper": "~1.1"
}
```

Or you can run the composer require command from your terminal.

```php
composer require kevindierkx/gravatar-helper:1.1.*
```

Once the package is installed you need to open ```app/config/app.php``` and register the required service provider.

```php
'providers' => [
    'Kevindierkx\GravatarHelper\Laravel\GravatarServiceProvider'
]
```

Optionaly you can add the following line to your aliases.

```php
'aliases' => [
    'Gravatar'          => 'Kevindierkx\GravatarHelper\Laravel\Facades\Gravatar',
]
```

### Configuration

Run the following command to publish the package configuration.

```php
php artisan config:publish kevindierkx/gravatar-helper
```

### Usage

To parse an image tag.

```php
Gravatar::image('email@example.com');
```

Or to parse an url.

```php
Gravatar::url('email@example.com');
```

### Credits

- [Kevin Dierkx](https://github.com/kevindierkx)

### License

The MIT License (MIT). Please see [License File](https://github.com/kevindierkx/gravatar-helper/blob/master/LICENSE) for more information.
