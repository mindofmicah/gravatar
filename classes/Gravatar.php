<?php
class Gravatar
{
	const RATING_G = 'g';
	const RATING_PG = 'pg';
	const RATING_R = 'r';
	const RATING_X = 'x';

	protected $rating;

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
}
