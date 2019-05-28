<?php
require_once (__DIR__).'/../PHP Functions/includeAll.php';

use PHPUnit\Framework\TestCase;

class GrabbingAnimalsTest extends TestCase
{
  protected function setUp(): void
	{
    $_POST = array();
    $_GET = array();
    $_FILES = array();

    $this->GrabbingAnimals = new GrabbingAnimals();
  }
  
  public function testGrabbingAnimals(): void
  {
    $output = json_decode($this->GrabbingAnimals->run());
    $this->assertEquals(false, $output["isError"]);
    $this->assertArrayHasKey("message", $output);
  }
}

?>