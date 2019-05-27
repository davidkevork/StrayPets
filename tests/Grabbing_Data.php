<?php

class StaryPetsTest extends PHPUnit_Framework_TestCase
{
  protected function setUp()
	{
    $_POST = array();
    $_GET = array();
    $_FILES = array();
  }

  private function _execute() {
    ob_start();
    require (__DIR__).'/../PHP Functions/Grabbing_Data.php';
    return ob_get_clean();
  }
  
  public function testGrabbingData()
  {
    $this->expectOutputRegex('{"isError": (true|false),"message": ".*"}');
  }
}

?>