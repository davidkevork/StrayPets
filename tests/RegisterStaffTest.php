<?php
require_once (__DIR__).'/../PHP Functions/includeAll.php';

use PHPUnit\Framework\TestCase;

class RegisterStaffTest extends TestCase
{
  protected function setUp(): void
	{
    $_POST = array();
    $_GET = array();
    $_FILES = array();

    $this->RegisterStaff = new RegisterStaff(true);
  }
  public function testRegisterStaffWorking(): void
  {
    $_POST['username'] = 'username';
    $_POST['password'] = 'password';
    $output = $this->RegisterStaff->validate();

    $this->assertEquals(false, $output["isError"]);
    $this->assertEquals("Validation success", $output["message"]);
  }
  public function testRegisterStaffInvalidUsername(): void
  {
    $_POST['username'] = '';
    $_POST['password'] = 'password';
    $output = $this->RegisterStaff->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Username must be between 1 and 255 characters", $output["message"]);
  }
  public function testRegisterStaffInvalidPassword(): void
  {
    $_POST['username'] = 'username';
    $_POST['password'] = '';
    $output = $this->RegisterStaff->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Password must be between 1 and 255 characters", $output["message"]);
  }
}

?>