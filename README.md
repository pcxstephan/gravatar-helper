# Gravatar Helper - Distortedfusion

Helper package for creating Gravatar url's and image tags. This package comes with Laravel support by default.

## Package Installation

### Manual Install for Laravel

You can manually install the package using composer. Add the following line to your composer.json file and run ```composer update```:

```javascript
"distortedfusion/gravatar": "~1.0.0"
```

Add this line of code to the ```providers``` array located in your ```app/config/app.php``` file:
```php
'Distortedfusion\Gravatar\Laravel\GravatarServiceProvider',
```

And this lines to the ```aliases``` array:
```php
'Gravatar' => 'Distortedfusion\Gravatar\Laravel\Facades\Gravatar',
```

### Configuration

Currently this package doesn't have a configuration file.
By default all Gravatar url's return a HTTP 404 Not Found when not available, this behaviour is controlled by the imageset.

You can set a different imageset, size or rating on runtime using the following methods:

```php
// Available imagesets
// [ 404 | mm | identicon | monsterid | wavatar ]
Gravatar::setImageset($imageset);

// Available size range
// [ 1 - 2048 ]
Gravatar::setSize($size);

// Available ratings
// [ g | pg | r | x ]
Gravatar::setRating($rating);
```

You can also get the currently set imageset, size or rating using the following methods:

```php
Gravatar::getImageset();

Gravatar::getSize();

Gravatar::getRating();
```

## Support

Bugs and feature request are tracked on [GitHub](https://github.com/distortedfusion/gravatar/issues)

## Credits

- [Kevin Dierkx](https://github.com/kevindierkx)

## License

The MIT License (MIT). Please see [License File](https://github.com/distortedfusion/gravatar/blob/master/LICENSE) for more information.
