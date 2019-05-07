<?php
$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$sql = "SELECT * FROM contact";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$ID[$i] = $row["ID"];
		$name[$i] = $row["Name"];
		$comment[$i] = $row["Comment"];
		$date_of_comment[$i] = $row["Date"];
		$i++;
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>