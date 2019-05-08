<?php
$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
    die(json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]));
}

$sql = "SELECT * FROM contact";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $data = [];
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($data, $result);
		$i++;
    }
    echo json_encode(["isError" => false, "message" => $data]);
} else {
    echo json_encode(["isError" => true, "message" => "No result"]);
}
mysqli_close($conn);

?>