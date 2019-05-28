<?php
require_once (__DIR__).'/../PHP Functions/includeAll.php';

use PHPUnit\Framework\TestCase;

class GrabbingDataTest extends TestCase
{
  protected function setUp(): void
	{
    $_POST = array();
    $_GET = array();
    $_FILES = array();

    $this->GrabbingData = new GrabbingData();
  }
  
  public function testGrabbingData(): void
  {
    $output = json_decode($this->GrabbingData->run());
    $this->assertEquals(false, $output["isError"]);
    $this->assertArrayHasKey("message", $output);
  }
}

?>