<?php
//Testing
error_reporting(0);
session_start();
class LoginStaff extends Mysql
{
    private $test;
    public function __construct($test = false)
	{
        $this->test = $test;
        if (!$this->test) {
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
            $sql = "SELECT * FROM `staff` WHERE `username` = '" . $_POST['username'] . "' AND  `password` = '" . $_POST['password'] . "'";
            $result = mysqli_query($this->mysqli, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['isLoggedIn'] = true;
                return json_encode(["isError" => false, "message" => "Login success"]);
            } else {
                return json_encode(["isError" => true, "message" => "No result"]);
            }
        } else {
            return $validate;
        }
    }
    public function __destruct()
	{
        if (!$this->test) {
            parent::__destruct();
        }
	}
}
?>