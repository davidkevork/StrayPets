<?php
$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
	die(json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]));
}

$sql = "INSERT INTO `pets`(
	`Species`,
	`Breed`,
	`DOB`,
	`Gender`,
	`PetName`,
	`PetDescribe`,

) VALUES (
	'" + $_POST['Species'] + "',
	'" + $_POST['Breed'] + "',
	'" + $_POST['DOB'] + "',
	'" + $_POST['Gender'] + "',
	'" + $_POST['PetName'] + "',
	'" + $_POST['PetDescribe'] + "',

)";

if (mysqli_query($conn, $sql)) {
	echo json_encode(["isError" => false, "message" => "New Record Created Successfully"]);
} else {
	echo json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}
mysqli_close($conn);

?>