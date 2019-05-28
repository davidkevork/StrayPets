<?php
class Mysql
{
	private $hostname = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
	private $username = "username";
	private $password = "password";
  private $dbName = "messages";
	public $mysqli;
	public function __construct()
	{
		$this->mysqli = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbName);
		if (!$this->mysqli) {
			return json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]);
		} else {
			return json_encode(["isError" => false, "message" => "Successfully connection to database"]);
		}
	}
	public function __destruct()
	{
		return mysqli_close($this->mysqli);
	}
}
?>