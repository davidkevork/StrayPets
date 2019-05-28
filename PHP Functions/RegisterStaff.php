<?php
error_reporting(0);
session_start();

class RegisterStaff extends Mysql
{
  private $test;
  public function __construct($test = false)
	{
		$this->test = $test;
		if ($this->test) {
			parent::__construct();
		}
  }
	public function validate() {
		if (strlen($_POST['username']) == 0 || strlen($_POST['username']) > 255) {
				return ["isError" => true, "message" => "Username must be between 1 and 255 characters"];
		} else if (strlen($_POST['password']) == 0 || strlen($_POST['password']) > 255) {
				return ["isError" => true, "message" => "Password must be between 1 and 255 characters"];
		}
		return ["isError" => false, "message" => "Validation success"];
	}
  public function run() {
		$validate = $this->validate();
		if ($validate["isError"] == false) {
			$sql = "INSERT INTO `staff` (`username`, `password`) VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] ."')";
			
			if (mysqli_query($this->mysqli, $sql)) {
				return json_encode(["isError" => false, "message" => "New Staff Created Successfully"]);
			} else {
				return json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($this->mysqli)]);
			}
		} else {
			return $validate;
		}
  }
  public function __destruct()
	{
		if ($this->test) {
			parent::__destruct();
		}
	}
}

?>