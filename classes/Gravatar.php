<?php
class Gravatar
{
	const RATING_G = 'g';
	const RATING_PG = 'pg';
	const RATING_R = 'r';
	const RATING_X = 'x';

	const SIZE_MIN = 1;
	const SIZE_MAX = 2048;

	protected $rating, $size, $isForceDefaultEnabled, $isSecure;

	public function process($input)
	{
		return 'http://gravatar.com/avatar/'. md5(strtolower($input)) . '.jpg';
	}

	public function setRating($new_rating)
	{
		$constant_name = 'self::RATING_' . strtoupper($new_rating);
		if (!defined($constant_name)) {
			throw new Exception();
		}

		$this->rating = constant($constant_name);
	}

	static public function quickProcess($input)
	{
		$gravatar = new Gravatar();
		return $gravatar->process($input);
	}

	public function setSize($new_size)
	{
		$new_size = intval($new_size);
		if ($new_size < self::SIZE_MIN || $new_size > self::SIZE_MAX) {
			throw new Exception('This value is outside of the available range');
		}
		$this->size = $new_size;
	}

	public function setIsForceDefaultEnabled($new_value)
	{
		$this->isForceDefaultEnabled = !!$new_value;
	}

	public function setIsSecure($new_value)
	{
		$this->isSecure = !!$new_value;
	}	
}
