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

	public function testSetSizeValidValue()
	{
		$inputs = array(
			1, 45, 2048
		);

		$gravatar = new MockGravatar();
		foreach ($inputs as $input) {
			$gravatar->setSize($input);
			$this->assertEquals($input, $gravatar->size);
		}
	}
	public function testSetSizeInvalidValues()
	{
		$inputs = array(
			'asdf', -5, 2049
		);
		$gravatar = new Gravatar();

		foreach ($inputs as $input) {
			try {
				$gravatar->setSize($input);


			} catch(Exception $e) {

				continue;
			}
			$this->fail($input . ' Should have thrown an exception');		
		}
	}

	public function testSetForceDefault()
	{
		$gravatar = new MockGravatar();
		$gravatar->setIsForceDefaultEnabled(1);
		$this->assertTrue($gravatar->isForceDefaultEnabled);
		$gravatar->setIsForceDefaultEnabled(0);
		$this->assertFalse($gravatar->isForceDefaultEnabled);
	}

	public function testSetIsSecure()
	{
		$gravatar = new MockGravatar();
		$gravatar->setIsSecure(1);
		$this->assertTrue($gravatar->isSecure);
		$gravatar->setIsSecure(0);
		$this->assertFalse($gravatar->isSecure);
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
