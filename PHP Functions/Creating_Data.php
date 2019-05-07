<?php
$namevariable = "gwen stefani";
$commentvariable = "hi, blah blah blah blah";
$datevariable = "1999-02-03";

$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "DatabaseName";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

//IMPORTANT, DATE VARIABLE MUST BE IN THE FORM OF YYYY-MM-DD OR IT WILL NOT WORK
$sql = "INSERT INTO contact (Name, Comment, Date)
VALUES ('$namevariable', '$commentvariable', '$datevariable')";
echo "1";
if ($mysqli_query($conn, $sql)) {
	echo "New Record Created Successfully";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
echo "2";
mysqli_close($conn);
?>