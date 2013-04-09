<?php
require 'classes/Gravatar.php';
class GravatarTest extends PHPUnit_Framework_TestCase
{
	public function testBasicProcess()
	{
		$inputs = array(
			'michaeleschbacher@gmail.com',
			'MichaelEschbacher@gmail.com',
			'MiChAeLeSCHBAcher@GMail.com'
		);	
		$expected_src = 'http://gravatar.com/avatar/561ccc0d8cbba335270496228d17864a.jpg';

		$gravatar = new Gravatar();
		foreach ($inputs as $input) {
			$this->assertEquals($expected_src, $gravatar->process($input));
		}
	}

	public function testQuickProcess()
	{
		$inputs = array(
			'michaeleschbacher@gmail.com',
			'MichaelEschbacher@gmail.com',
			'MiChAeLeSCHBAcher@GMail.com'
		);	
		$expected_src = 'http://gravatar.com/avatar/561ccc0d8cbba335270496228d17864a.jpg';

		foreach ($inputs as $input) {
			$this->assertEquals($expected_src, Gravatar::quickProcess($input));
		}
	}

	public function testSetRatingWithValidValue()
	{
		$inputs = array(
			'g'=>'g',
			Gravatar::RATING_G =>'g',
			'pg'=>'pg',
			'r'=>'r',
			'R'=>'r',
			Gravatar::RATING_PG => 'pg',
			'X'=>'x'
		);
	
		$gravatar = new MockGravatar;
		foreach ($inputs as $input => $expected) {
			$gravatar->setRating($input);
			$this->assertEquals($expected, $gravatar->rating);
		}
	}

	public function testSetRatingWithInvalidValue()
	{
		$invalids = array(
			'gh', 'taco', 'm', 'f'
		);

		$gravatar = new Gravatar;
		foreach ($invalids as $input) {
			try {
				$gravatar->setRating($input);
			} catch (Exception $e) {
				continue;
			}
			$this->fail('Should have thrown an exception');
		}
	}
}

class MockGravatar extends Gravatar
{
	public function __get($param)
	{
		return $this->$param;
	}
	public function __set($param, $value)
	{
		$this->$param = $value;
	}
}
