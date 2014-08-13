<?php namespace Distortedfusion\Gravatar\Laravel;

use Distortedfusion\Gravatar\Gravatar;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class GravatarServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('distortedfusion/gravatar', 'distortedfusion/gravatar', __DIR__.'/..');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['gravatar'] = $this->app->share(function($app)
        {
            return new Gravatar();
        });
    }
}
