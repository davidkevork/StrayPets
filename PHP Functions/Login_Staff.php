<?php

session_start();

$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
    die(json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]));
}

$sql = "SELECT * FROM `staff` WHERE `username` = '" . $_POST['username'] . "' AND  `password` = '" . $_POST['password'] . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['isLoggedIn'] = true;
    echo json_encode(["isError" => false, "message" => "Login success"]);
    sleep(4);
    header('Location: http://ec2-13-210-163-91.ap-southeast-2.compute.amazonaws.com/Website/ViewContact.html');
} else {
    echo json_encode(["isError" => true, "message" => "No result"]);
}
mysqli_close($conn);

?>