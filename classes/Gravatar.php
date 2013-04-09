<?php
class Gravatar
{
	public function process($input)
	{
		return 'http://gravatar.com/avatar/'. md5(strtolower($input)) . '.jpg';
	}

	static public function quickProcess($input)
	{
		$gravatar = new Gravatar();
		return $gravatar->process($input);
	}
}
