<?php
$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

if (strlen($_POST['username']) == 0 || strlen($_POST['username']) > 255) {
	die(json_encode(["isError" => true, "message" => "Username must be between 1 and 255 characters"]));
} else if (strlen($_POST['password']) == 0 || strlen($_POST['password']) > 255) {
	die(json_encode(["isError" => true, "message" => "Password must be between 1 and 255 characters"]));
}

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
	die(json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]));
}

$sql = "INSERT INTO `staff` (`username`, `password`) VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] ."')";

if (mysqli_query($conn, $sql)) {
	echo json_encode(["isError" => false, "message" => "New Staff Created Successfully"]);
} else {
	echo json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}
mysqli_close($conn);

?>