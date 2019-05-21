<?php
require 'vendor/autoloader.php';
use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\common\Exception\S3Exception;

session_start();

$servername = "rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com";
$username = "username";
$password = "password";
$dbName = "messages";


if (!isset($_SESSION['username']) || !isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true) {
  die(json_encode(["isError" => true, "message" => "Please login before adding pets"]));
}

$Species = [
	'Dog',
	'Cat',
	'Fish',
	'Bird',
	'Horse',
	'Turtle',
	'Rabbit',
	'Snake'
];

if (!in_array($_POST['Species'], $Species)) {
	die(json_encode(["isError" => true, "message" => "Invalid or unknown pet species"]));
} else if (strlen($_POST['Breed']) == 0 || strlen($_POST['Breed']) > 255) {
	die(json_encode(["isError" => true, "message" => "Pet Breed can't be empty"]));
} else if (strlen($_POST['PetName']) == 0 || strlen($_POST['PetName']) > 255) {
	die(json_encode(["isError" => true, "message" => "Pet Name can't be empty"]));
} else if (strlen($_POST['PetDescription']) == 0 || strlen($_POST['PetDescription']) > 255) {
	die(json_encode(["isError" => true, "message" => "Pet Description can't be empty"]));
} else if (!strtotime($_POST['DOB'])) {
	die(json_encode(["isError" => true, "message" => "Invalid pet date of birth"]));
} else if ($_POST['Gender'] != "male" || $_POST['Gender'] == "female") {
	die(json_encode(["isError" => true, "message" => "Invalid or unknown pet gender"]));
} else if (!in_array(getimagesize($_FILES['PetImage'])[2], array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))) {
	die(json_encode(["isError" => true, "message" => "Invalid file type uploaded"]));
}

$conn = mysqli_connect($servername, $username, $password, $dbName);

if (!$conn) {
	die(json_encode(["isError" => true, "message" => "Connection failed: " . mysqli_connect_error()]));
}

$file = $_FILES['PetImage'];

$s3_client = new S3Client(['version' => 'latest', 'region' => 'ap-southeast-2']);

//upload the file to the EC2 instance
$file_tmp = $_FILES['image']['tmp_name'];
$is_file_uploaded = move_uploaded_file(
					$_FILES["PetImage"]['tmp_name'],
					dirname(__FILE__)."/images/{$file['name']}");
if ($is_file_uploaded){
				$uploader = new MultipartUploader($s3_client, dirname(__FILE__)."/images/{$file['name']}",
					['bucket'=>'dprojectbucket', 'key'=>$file['name'], 'SourceFile' => 'images']);
				try {
					$result = $uploader->upload();
				} catch (S3Exception $e) {
					echo "notworking";
				}	
} else {
	$url = null;
}
$url = "https://s3-ap-southeast-2.amazonaws.com/dprojectbucket/";
$url .= $file['name'];
		
$sql = "INSERT INTO `Pets` (
	`Species`,
	`Breed`,
	`DOB`,
	`Gender`,
	`PetName`,
	`PetDescription`,
	`PetImage`
) VALUES (
	'" . $_POST['Species'] . "',
	'" . $_POST['Breed'] . "',
	'" . $_POST['DOB'] . "',
	'" . $_POST['Gender'] . "',
	'" . $_POST['PetName'] . "',
	'" . $_POST['PetDescription'] . "',
	'" . $url . "'
)";

if (mysqli_query($conn, $sql)) {
	echo json_encode(["isError" => false, "message" => "New Record Created Successfully"]);
} else {
	echo json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($conn)]);
}
mysqli_close($conn);

?>