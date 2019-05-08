<?php
$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
	die(json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]));
}

$namevariable = "gwen stefani";
$commentvariable = "hi, blah blah blah blah";

$sql = "INSERT INTO contact (Name, Comment, Date) VALUES ('$namevariable', '$commentvariable', 'NOW()')";

if (mysqli_query($conn, $sql)) {
	echo json_encode(["isError" => false, "message" => "New Record Created Successfully"]);
} else {
	echo json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}
mysqli_close($conn);

?>