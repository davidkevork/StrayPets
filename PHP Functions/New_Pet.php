<?php
$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true) {
  die(json_encode(["isError" => true, "message" => "Please login before adding pets"]));
}

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
	die(json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]));
}

$sql = "INSERT INTO `Pets`(
	`Species`,
	`Breed`,
	`DOB`,
	`Gender`,
	`PetName`,
	`PetDescription`
) VALUES (
	'" . $_POST['Species'] . "',
	'" . $_POST['Breed'] . "',
	'" . $_POST['DOB'] . "',
	'" . $_POST['Gender'] . "',
	'" . $_POST['PetName'] . "',
	'" . $_POST['PetDescription'] . "'
)";

if (mysqli_query($conn, $sql)) {
	echo json_encode(["isError" => false, "message" => "New Record Created Successfully"]);
} else {
	echo json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}
mysqli_close($conn);

?>