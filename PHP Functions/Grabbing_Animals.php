<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true) {
    die(json_encode(["isError" => true, "message" => "Please login before viewing contacts"]));
}

$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
    die(json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]));
}

$sql = "SELECT * FROM `Pets`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $data = [];
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }
    echo json_encode(["isError" => false, "message" => $data]);
} else {
    echo json_encode(["isError" => true, "message" => "No result"]);
}
mysqli_close($conn);

?>