<?php
$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
	die(json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]));
}

$sql = "INSERT INTO `staff` (`username`, `password`) VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] ."')";

if (mysqli_query($conn, $sql)) {
	echo json_encode(["isError" => false, "message" => "New Staff Created Successfully"]);
	sleep(4);
    header('Location: http://ec2-13-210-163-91.ap-southeast-2.compute.amazonaws.com/Website/StaffLogin.html');
} else {
	echo json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}
mysqli_close($conn);

?>