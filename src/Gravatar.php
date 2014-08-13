<?php namespace Distortedfusion\Gravatar;

class Gravatar
{
    /**
     * URL constants for the Gravatar images.
     *
     * @var string
     */
    protected $httpUrl  = 'http://www.gravatar.com/avatar/';
    protected $httpsUrl = 'https://secure.gravatar.com/avatar/';

    /**
     * Size in pixels, defaults to 80px.
     * [ 1 - 2048 ]
     *
     * @var integer
     */
    protected $size = 80;

    /**
     * Maximum rating (inclusive)
     * [ g | pg | r | x ]
     *
     * @var string
     */
    protected $rating = 'g';

    /**
     * Default imageset to use.
     * [ 404 | mm | identicon | monsterid | wavatar ]
     *
     * @var string
     */
    protected $imageset = '404';

    /**
     * Available Gravatar ratings.
     *
     * @var array
     */
    protected $availableRatings = array('g', 'pg', 'r', 'x');

    /**
     * Available default imagesets.
     *
     * @var array
     */
    protected $availableImagesets = array('404', 'mm', 'identicon', 'monsterid', 'wavata');

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
        // Start building the URL, and deciding if we're doing this via HTTPS or HTTP.
        $url = $secure ? $this->httpsUrl : $this->httpUrl;

        // Hash email.
        $url .= hash('md5', strtolower(trim($email)));

        // Build the parameters
        $params = array();
        $params['s'] = $size ?: $this->size;
        $params['r'] = $this->rating;
        $params['d'] = $this->imageset;
        $url .= '?'.http_build_query(array_filter($params));

        // And we're done.
        return $url;
    }

    /**
     * Get Current imageset.
     *
     * @return string
     */
    public function getImageset()
    {
        return $this->imageset;
    }

    /**
     * Set Gravatar rating.
     *
     * @param  string  $rating
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setImageset($imageset)
    {
        if (! in_array($imageset, $this->availableImagesets)) {
            throw new \InvalidArgumentException('Invalid Gravatar imageset');
        }

        $this->imageset = $imageset;
    }

    /**
     * Get Gravatar rating.
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set Gravatar rating.
     *
     * @param  string  $rating
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setRating($rating)
    {
        if (! in_array($rating, $this->availableRatings)) {
            throw new \InvalidArgumentException('Invalid Gravatar rating.');
        }

        $this->rating = $rating;
    }

    /**
     * Get Gravatar size.
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set Gravatar size
     *
     * @param  string  $size
     * @return void
     * @throws \InvalidArgumentException
     */
    public function setSize($size)
    {
        if (! is_int($size) && ! ctype_digit($size)) {
            throw new \InvalidArgumentException('Avatar size specified must be an integer');
        }

        if ($size > 512 || $size < 0) {
            throw new \InvalidArgumentException('Avatar size must be within 0 pixels and 512 pixels');
        }

        $this->size = $size;
    }

    /**
     * Build an HTML attribute string from an array.
     *
     * @param  array  $attributes
     * @return string
     */
    protected function attributes($attributes)
    {
        $html = array();

        // For numeric keys we will assume that the key and the value are the same
        // as this will convert HTML attributes such as "required" to a correct
        // form like required="required" instead of using incorrect numerics.
        foreach ((array) $attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
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
        if (is_numeric($key)) {
            $key = $value;
        }

        if (! is_null($value)) {
            return $key.'="'.$value.'"';
        }
    }
}
