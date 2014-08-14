# Gravatar Helper - Distortedfusion

Helper package for creating Gravatar url's and image tags. This package comes with Laravel support by default.

## Package Installation

### Manual Install

You can manually install the package using composer. Add the following line to your composer.json file and run ```composer update```:
```javascript
"distortedfusion/gravatar": "~1.0.0"
```

### Provider and Alias for Laravel

Add this line of code to the ```providers``` array located in your ```app/config/app.php``` file:
```php
'Distortedfusion\Gravatar\Laravel\GravatarServiceProvider',
```

And this line to the ```aliases``` array:
```php
'Gravatar' => 'Distortedfusion\Gravatar\Laravel\Facades\Gravatar',
```

### Configuration

**Native**
During creation you can specify the image size, rating and image set:
```php
$gravatar = new \Distortedfusion\Gravatar\Gravatar($size, $rating, $imageSet);
```

**On Runtime**
You can set a different size, rating or image set on runtime using the following methods:
```php
$gravatar->setSize($size);

$gravatar->setRating($rating);

$gravatar->setImageSet($imageSet);
```

You can also get the currently set size, rating or image set using the following methods:
```php
$gravatar->getSize();

$gravatar->getRating();

$gravatar->getImageSet();
```

**Laravel**
When using Laravel you can publish the configuration file using:
```
php artisan config:publish distortedfusion/gravatar
```

**On Runtime**
You can set a different size, rating or image set on runtime using the following methods:
```php
Gravatar::setSize($size);

Gravatar::setRating($rating);

Gravatar::setImageSet($imageSet);
```

You can also get the currently set size, rating or image set using the following methods:
```php
Gravatar::getSize();

Gravatar::getRating();

Gravatar::getImageSet();
```

## Support

Bugs and feature request are tracked on [GitHub](https://github.com/distortedfusion/gravatar/issues)

## Credits

- [Kevin Dierkx](https://github.com/kevindierkx)

## License

The MIT License (MIT). Please see [License File](https://github.com/distortedfusion/gravatar/blob/master/LICENSE) for more information.
