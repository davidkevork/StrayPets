<?php
require (__DIR__).'/../PHP Functions/Mysql.php';
require (__DIR__).'/../PHP Functions/GrabbingAnimals.php';

class StaryPetsTest extends PHPUnit_Framework_TestCase
{
  protected function setUp()
	{
    $_POST = array();
    $_GET = array();
    $_FILES = array();

    $this->GrabbingAnimals = new GrabbingAnimals();
  }
  
  public function testGrabbingAnimals()
  {
    $output = json_decode($this->GrabbingAnimals->run());
    $this->assertEquals(false, $output["isError"]);
    $this->assertArrayHasKey("message", $output);
  }
}

?>