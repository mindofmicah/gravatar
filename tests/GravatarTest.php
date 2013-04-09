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
}
