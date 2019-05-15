<?php
$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
	die(json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]));
}

$sql = "INSERT INTO `contact` (
	`FirstName`,
	`LastName`,
	`DOB`,
	`Gender`,
	`StreetAddress`,
	`SuburbTown`,
	`State`,
	`PostCode`,
	`EmailAddress`,
	`PhoneNumber`,
	`PetState`,
	`Comment`,
	`Date`
) VALUES (
	'" + $_POST['FirstName'] + "',
	'" + $_POST['LastName'] + "',
	'" + $_POST['DOB'] + "',
	'" + $_POST['Gender'] + "',
	'" + $_POST['StreetAddress'] + "',
	'" + $_POST['SuburbTown'] + "',
	'" + $_POST['State'] + "',
	'" + $_POST['PostCode'] + "',
	'" + $_POST['EmailAddress'] + "',
	'" + $_POST['PhoneNumber'] + "',
	'" + $_POST['PetState'] + "',
	'" + $_POST['Comment'] + "',
	'NOW()'
)";

if (mysqli_query($conn, $sql)) {
	echo json_encode(["isError" => false, "message" => "New Record Created Successfully"]);
} else {
	echo json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}
mysqli_close($conn);

?>