<?php
error_reporting(0);
session_start();

class RegisterStaff extends Mysql
{
  public function __construct()
	{   
		parent::__construct();
	}
  public function run() {
		if (strlen($_POST['username']) == 0 || strlen($_POST['username']) > 255) {
			return json_encode(["isError" => true, "message" => "Username must be between 1 and 255 characters"]);
		} else if (strlen($_POST['password']) == 0 || strlen($_POST['password']) > 255) {
			return json_encode(["isError" => true, "message" => "Password must be between 1 and 255 characters"]);
		}

		$sql = "INSERT INTO `staff` (`username`, `password`) VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] ."')";
		
		if (mysqli_query($this->mysqli, $sql)) {
			return json_encode(["isError" => false, "message" => "New Staff Created Successfully"]);
		} else {
			return json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($this->mysqli)]);
		}
  }
  public function __destruct()
	{
		parent::__destruct();
	}
}

?>