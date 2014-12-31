<?php namespace Kevindierkx\GravatarHelper;

class Helper {

	/**
	 * @var string
	 */
	protected $httpUrl  = 'http://www.gravatar.com/avatar/';

	/**
	 * @var string
	 */
	protected $httpsUrl = 'https://secure.gravatar.com/avatar/';

	/**
	 * @var int
	 */
	protected $size = 80;

	/**
	 * @var string
	 */
	protected $rating = 'g';

	/**
	 * @var string
	 */
	protected $imageSet = '404';

	/**
	 * @var array
	 */
	protected $availableRatings = ['g', 'pg', 'r', 'x'];

	/**
	 * @var array
	 */
	protected $availableImageSets = ['404', 'mm', 'identicon', 'monsterid', 'wavata', 'retro', 'blank'];

	/**
	 * Initialize Gravatar Helper.
	 *
	 * @param  int     $size
	 * @param  string  $rating
	 * @param  string  $imageSet
	 */
	public function __construct($size = null, $rating = null, $imageSet = null)
	{
		if ( ! is_null($size) ) $this->setSize($size);

		if ( ! is_null($rating) ) $this->setRating($rating);

		if ( ! is_null($imageSet) ) $this->setImageSet($imageSet);
	}

	/**
	 * Get gravatar image from email.
	 *
	 * @param  string   $email
	 * @param  int      $size
	 * @param  string   $alt
	 * @param  array    $attributes
	 * @param  boolean  $secure
	 * @return string
	 */
	public function image($email, $size = null, array $attributes = array(), $secure = true)
	{
		return '<img src="'.$this->url($email, $size, $secure).'"'.$this->attributes($attributes).'>';
	}

	/**
	 * Get gravatar url from email
	 *
	 * @param  string   $email
	 * @param  int      $size
	 * @param  boolean  $secure
	 * @return string
	 */
	public function url($email, $size = null, $secure = true)
	{
		if ( ! is_null($size) ) $this->validateSize($size);

		$url = $secure ? $this->httpsUrl : $this->httpUrl;
		$url .= hash('md5', strtolower(trim($email)));

		$params = array();
		$params['s'] = $size ?: $this->size;
		$params['r'] = $this->rating;
		$params['d'] = $this->imageSet;
		$url .= '?' . http_build_query(array_filter($params));

		return $url;
	}

	/**
	 * Get image set.
	 *
	 * @return string
	 */
	public function getImageSet()
	{
		return $this->imageSet;
	}

	/**
	 * Set image set.
	 *
	 * @param  string  $imageSet
	 * @throws \InvalidArgumentException
	 */
	public function setImageSet($imageSet)
	{
		if ( ! in_array($imageSet, $this->availableImageSets) ) {
			throw new \InvalidArgumentException('Invalid Gravatar image set.');
		}

		$this->imageSet = $imageSet;
	}

	/**
	 * Get rating.
	 *
	 * @return string
	 */
	public function getRating()
	{
		return $this->rating;
	}

	/**
	 * Set rating.
	 *
	 * @param  string  $rating
	 * @throws \InvalidArgumentException
	 */
	public function setRating($rating)
	{
		if ( ! in_array($rating, $this->availableRatings) ) {
			throw new \InvalidArgumentException('Invalid Gravatar rating.');
		}

		$this->rating = $rating;
	}

	/**
	 * Get size.
	 *
	 * @return int
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Set size.
	 *
	 * @param  string  $size
	 * @throws \InvalidArgumentException
	 */
	public function setSize($size)
	{
		$this->validateSize($size);

		$this->size = $size;
	}

	/**
	 * Validate provided size.
	 *
	 * @param  int  $size
	 * @return boolean
	 * @throws \InvalidArgumentException
	 */
	protected function validateSize($size)
	{
		if ( ! is_int($size) && ! ctype_digit($size) ) {
			throw new \InvalidArgumentException('Avatar size specified must be an integer');
		}

		if ( $size < 0 || $size > 2048 ) {
			throw new \InvalidArgumentException('Avatar size must be within 0 pixels and 2048 pixels');
		}
	}

	/**
	 * Build an HTML attribute string from an array.
	 *
	 * @param  array  $attributes
	 * @return string
	 */
	protected function attributes($attributes)
	{
		$html = [];

		// For numeric keys we will assume that the key and the value are the same
		// as this will convert HTML attributes such as "required" to a correct
		// form like required="required" instead of using incorrect numerics.
		foreach ( (array) $attributes as $key => $value ) {
			$element = $this->attributeElement($key, $value);

			if ( ! is_null($element) ) $html[] = $element;
		}

		return count($html) > 0 ? ' '.implode(' ', $html) : null;
	}

	/**
	 * Build a single attribute element.
	 *
	 * @param  string  $key
	 * @param  string  $value
	 * @return string
	 */
	protected function attributeElement($key, $value)
	{
		if ( is_numeric($key) ) {
			$key = $value;
		}

		if ( ! is_null($value) ) {
			return $key.'="'.$value.'"';
		}
	}
}
