<?php
$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

$State = [
	'VIC',
	'NSW',
	'QLD',
	'NT',
	'WA',
	'SA',
	'TAS',
	'ACT'
];

$PetState = [
	'LP',
	'Pick',
	'PCS',
	'others',
];

if (!in_array($_POST['State'], $State)) {
	die(json_encode(["isError" => true, "message" => "Invalid or unknown pet species"]));
} else if (strlen($_POST['FirstName']) == 0 || strlen($_POST['FirstName']) > 255) {
	die(json_encode(["isError" => true, "message" => "First Name must be between 1 and 255 characters"]));
} else if (strlen($_POST['LastName']) == 0 || strlen($_POST['LastName']) > 255) {
	die(json_encode(["isError" => true, "message" => "Last Name must be between 1 and 255 characters"]));
}  else if (!strtotime($_POST['DOB'])) {
	die(json_encode(["isError" => true, "message" => "Invalid date of birth"]));
} else if ($_POST['Gender'] != "male" || $_POST['Gender'] != "female") {
	die(json_encode(["isError" => true, "message" => "Invalid or unknown pet gender"]));
} else if (strlen($_POST['StreetAddress']) == 0 || strlen($_POST['StreetAddress']) > 255) {
	die(json_encode(["isError" => true, "message" => "Street Address must be between 1 and 255 characters"]));
} else if (strlen($_POST['SuburbTown']) == 0 || strlen($_POST['SuburbTown']) > 255) {
	die(json_encode(["isError" => true, "message" => "Suburb/Town must be between 1 and 255 characters"]));
} else if (strlen($_POST['PostCode']) != 4 || filter_var(FILTER_SANITIZE_NUMBER_INT, $_POST['PostCode'])) {
	die(json_encode(["isError" => true, "message" => "Post Code must be 4 digits"]));
} else if (strlen($_POST['EmailAddress']) == 0 || strlen($_POST['EmailAddress']) > 255) {
	die(json_encode(["isError" => true, "message" => "Email Address must be between 1 and 255 characters"]));
} else if (strlen($_POST['PhoneNumber']) != 10 || filter_var(FILTER_SANITIZE_NUMBER_INT, $_POST['PhoneNumber'])) {
	die(json_encode(["isError" => true, "message" => "Phone Number must 10 digits"]));
} else if (!in_array($_POST['PetState'], $PetState)) {
	die(json_encode(["isError" => true, "message" => "Invalid or unknown pet state"]));
} else if ($_POST['PetState']['others'] && strlen($_POST['Comment']) == 0) {
	die(json_encode(["isError" => true, "message" => "Comment can't be empty"]));
}

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
	'" . $_POST['FirstName'] . "',
	'" . $_POST['LastName'] . "',
	'" . $_POST['DOB'] . "',
	'" . $_POST['Gender'] . "',
	'" . $_POST['StreetAddress'] . "',
	'" . $_POST['SuburbTown'] . "',
	'" . $_POST['State'] . "',
	'" . $_POST['PostCode'] . "',
	'" . $_POST['EmailAddress'] . "',
	'" . $_POST['PhoneNumber'] . "',
	'" . serialize($_POST['PetState']) . "',
	'" . ($_POST['Comment'] ?? "empty") . "',
	NOW()
)";

if (mysqli_query($conn, $sql)) {
	echo json_encode(["isError" => false, "message" => "New Record Created Successfully"]);
} else {
	echo json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}
mysqli_close($conn);

?>