<?php
error_reporting(0);
session_start();

class GrabbingAnimals extends Mysql
{
    private $test;
    public function __construct($test = false)
	{
        $this->test = $test;
        if (!$this->test) {
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
            return json_encode(["isError" => false, "message" => $data]);
        } else {
            return json_encode(["isError" => true, "message" => "No result"]);
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