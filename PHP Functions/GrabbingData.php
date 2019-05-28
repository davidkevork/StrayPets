<?php
session_start();

class GrabbingData extends Mysql
{
    public function __construct()
	{   
		parent::__construct();
	}
    public function run() {
        if (!isset($_SESSION['username']) || !isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true) {
            die(json_encode(["isError" => true, "message" => "Please login before viewing contacts"]));
        }
        $sql = "SELECT * FROM `contact`";
        $result = mysqli_query($this->mysqli, $sql);

        if (mysqli_num_rows($result) > 0) {
            $data = [];
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $row['PetState'] = unserialize($row['PetState']);
                array_push($data, $row);
            }
            echo json_encode(["isError" => false, "message" => $data]);
        } else {
            echo json_encode(["isError" => true, "message" => "No result"]);
        }
    }
    public function __destruct()
	{
		parent::__destruct();
	}
}

?>