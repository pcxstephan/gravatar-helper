<?php namespace Kevindierkx\GravatarHelper\Laravel;

use Illuminate\Support\ServiceProvider;
use Kevindierkx\GravatarHelper\Helper;

class GravatarServiceProvider extends ServiceProvider {

	/**
	 * {@inheritdoc}
	 */
	protected $defer = true;

	/**
	 * {@inheritdoc}
	 */
	public function boot()
	{
		$this->package('kevindierkx/gravatar-helper', 'gravatar-helper', __DIR__ . '/..');
	}

	/**
	 * {@inheritdoc}
	 */
	public function register()
	{
		$this->app->bindShared('gravatar', function ($app)
		{
			return new Helper(
				$app['config']['gravatar-helper::size'],
				$app['config']['gravatar-helper::rating'],
				$app['config']['gravatar-helper::image_set']
			);
		});
	}

	/**
	 * {@inheritdoc}
	 */
	public function provides()
	{
		return ['gravatar'];
	}

}
