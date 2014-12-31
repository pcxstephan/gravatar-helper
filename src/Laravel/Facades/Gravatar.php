<?php namespace Kevindierkx\GravatarHelper\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Gravatar extends Facade {

	/**
	 * {@inheritdoc}
	 */
	protected static function getFacadeAccessor() { return 'gravatar'; }

}
