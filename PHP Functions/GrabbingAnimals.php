<?php
error_reporting(0);
session_start();

class GrabbingAnimals extends Mysql
{
	private $test;
    public function __construct()
	{   
		$this->test = $test;
        if ($this->test) {
			parent::__construct();
		}
	}
    public function run() {
        $sql = "SELECT * FROM `Pets`";
        $result = mysqli_query($this->mysqli, $sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                array_push($data, $row);
            }
			if ($this->test) {
				return json_encode(["isError" => true, "message" => "Table found"]);
			} else {
				return json_encode(["isError" => true, "message" => $data]);
			}
        } else {
            return json_encode(["isError" => false, "message" => "No result"]);
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