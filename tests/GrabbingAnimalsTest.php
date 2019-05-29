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
    $this->GrabbingAnimals = new GrabbingAnimals(true);
  }
  public function testNoData(): void
  {
    $output = $this->GrabbingAnimals->run();
    $this->assertEquals(false, $output["isError"]);
    $this->assertEquals("No result", $output["message"]);
  }
  public function testData(): void
  {
    $output = $this->GrabbingAnimals->run();
    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Table found", $output["message"]);
  }
}
?>