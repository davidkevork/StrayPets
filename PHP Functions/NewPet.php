<?php
error_reporting(0);
require_once (__DIR__).'/../vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\common\Exception\S3Exception;
session_start();

class NewPet extends Mysql
{
  private $test;
  protected $_destination;
  public function __construct($test = false, $destination)
	{
		$this->_destination = rtrim($destination, '/');
		$this->test = $test;
		if (!$this->test) {
			parent::__construct();
		}
	}

  public function validate() {
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
		
	  $Gender = [
			'male',
			'female',
		];

	  <?php
error_reporting(0);
require_once (__DIR__).'/../vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\MultipartUploader;
use Aws\common\Exception\S3Exception;
session_start();

class NewPet extends Mysql
{
  private $test;
  protected $_destination;
  public function __construct($test = false, $destination)
	{
		$this->_destination = rtrim($destination, '/');
		$this->test = $test;
		if (!$this->test) {
			parent::__construct();
		}
	}

  public function validate() {
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
		
	  $Gender = [
			'male',
			'female',
		];

	  if (!in_array($_POST['Species'], $Species)) {
			return json_encode(["isError" => true, "message" => "Invalid or unknown pet species"]);
		} else if (strlen($_POST['Breed']) == 0 || strlen($_POST['Breed']) > 255) {
			return json_encode(["isError" => true, "message" => "Pet Breed must be between 1 and 255 characters"]);
		} else if (strlen($_POST['PetName']) == 0 || strlen($_POST['PetName']) > 255) {
			return json_encode(["isError" => true, "message" => "Pet Name must be between 1 and 255 characters"]);
		} else if (strlen($_POST['PetDescription']) == 0 || strlen($_POST['PetDescription']) > 255) {
			return json_encode(["isError" => true, "message" => "Pet Description must be between 1 and 255 characters"]);
		} else if (!strtotime($_POST['DOB'])) {
			return json_encode(["isError" => true, "message" => "Invalid pet date of birth"]);
		} else if (!in_array($_POST['Gender'], $Gender)) {
			return json_encode(["isError" => true, "message" => "Invalid or unknown pet gender"]);
		} else if (!in_array(pathinfo($_FILES['PetImage']['name']), ['jpg','gif','png'])) {
			return json_encode(["isError" => true, "message" => "Invalid file type uploaded"]);
		}
		
		if(empty($_FILES[$PetImage]) or !is_uploaded_file($_FILES[$PetImage]['tmp_name']))
		{
			return 
		}
		
		return ["isError" => false, "message" => "Validation success"];
  }
  public function run() {
		if (!isset($_SESSION['username']) || !isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true) {
			return json_encode(["isError" => true, "message" => "Please login before adding pets"]);
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
		
		$Gender = [
			'male',
			'female',
		];
		
		if (!in_array($_POST['Species'], $Species)) {
			return json_encode(["isError" => true, "message" => "Invalid or unknown pet species"]);
		} else if (strlen($_POST['Breed']) == 0 || strlen($_POST['Breed']) > 255) {
			return json_encode(["isError" => true, "message" => "Pet Breed must be between 1 and 255 characters"]);
		} else if (strlen($_POST['PetName']) == 0 || strlen($_POST['PetName']) > 255) {
			return json_encode(["isError" => true, "message" => "Pet Name must be between 1 and 255 characters"]);
		} else if (strlen($_POST['PetDescription']) == 0 || strlen($_POST['PetDescription']) > 255) {
			return json_encode(["isError" => true, "message" => "Pet Description must be between 1 and 255 characters"]);
		} else if (!strtotime($_POST['DOB'])) {
			return json_encode(["isError" => true, "message" => "Invalid pet date of birth"]);
		} else if (!in_array($_POST['Gender'], $Gender)) {
			return json_encode(["isError" => true, "message" => "Invalid or unknown pet gender"]);
		} else if (!in_array(pathinfo($_FILES['PetImage']['name']), ['jpg','gif','png'])) {
			return json_encode(["isError" => true, "message" => "Invalid file type uploaded"]);
		}

		$file = $_FILES['PetImage'];

		$s3_client = new S3Client(['version' => 'latest', 'region' => 'ap-southeast-2']);

		//upload the file to the EC2 instance
		$is_file_uploaded = move_uploaded_file($_FILES["PetImage"]['tmp_name'], dirname(__FILE__)."/images/{$file['name']}");
		if ($is_file_uploaded){
			$uploader = new MultipartUploader($s3_client, dirname(__FILE__)."/images/{$file['name']}",
				['bucket'=>'dprojectbucket', 'key'=>$file['name'], 'SourceFile' => 'images']);
			try {
				$uploader->upload();
			} catch (S3Exception $e) {
				return json_encode(["isError" => true, "message" => "Unable to upload file"]);
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

		if (mysqli_query($this->mysqli, $sql)) {
			return json_encode(["isError" => false, "message" => "New Record Created Successfully"]);
		} else {
			return json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($this->mysqli)]);
		}
  }
  public function __destruct()
	{
		if (!$this->test) {
			parent::__destruct();
		}
	}
}

?>
		
		if(empty($_FILES[$PetImage]) or !is_uploaded_file($_FILES[$PetImage]['tmp_name']))
		{
			return json_encode(["isError" => true, "message" => "File not found"]);
		}
		return move_uploaded_file($_FILES[$PetImage]['tmp_name'], $this->_destination . '/' . $_FILES[$PetImage]['name']);
		
		return ["isError" => false, "message" => "Validation success"];
  }
  public function run() {
		if (!isset($_SESSION['username']) || !isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true) {
			return json_encode(["isError" => true, "message" => "Please login before adding pets"]);
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
		
		$Gender = [
			'male',
			'female',
		];
		
		if (!in_array($_POST['Species'], $Species)) {
			return json_encode(["isError" => true, "message" => "Invalid or unknown pet species"]);
		} else if (strlen($_POST['Breed']) == 0 || strlen($_POST['Breed']) > 255) {
			return json_encode(["isError" => true, "message" => "Pet Breed must be between 1 and 255 characters"]);
		} else if (strlen($_POST['PetName']) == 0 || strlen($_POST['PetName']) > 255) {
			returnjson_encode(["isError" => true, "message" => "Pet Name must be between 1 and 255 characters"]);
		} else if (strlen($_POST['PetDescription']) == 0 || strlen($_POST['PetDescription']) > 255) {
			return json_encode(["isError" => true, "message" => "Pet Description must be between 1 and 255 characters"]);
		} else if (!strtotime($_POST['DOB'])) {
			return json_encode(["isError" => true, "message" => "Invalid pet date of birth"]);
		} else if (!in_array($_POST['Gender'], $Gender)) {
			return json_encode(["isError" => true, "message" => "Invalid or unknown pet gender"]);
		} else if (!in_array(pathinfo($_FILES['PetImage']['name']), ['jpg','gif','png'])) {
			return json_encode(["isError" => true, "message" => "Invalid file type uploaded"]);
		}

		$file = $_FILES['PetImage'];

		$s3_client = new S3Client(['version' => 'latest', 'region' => 'ap-southeast-2']);

		//upload the file to the EC2 instance
		$is_file_uploaded = move_uploaded_file($_FILES["PetImage"]['tmp_name'], dirname(__FILE__)."/images/{$file['name']}");
		if ($is_file_uploaded){
			$uploader = new MultipartUploader($s3_client, dirname(__FILE__)."/images/{$file['name']}",
				['bucket'=>'dprojectbucket', 'key'=>$file['name'], 'SourceFile' => 'images']);
			try {
				$uploader->upload();
			} catch (S3Exception $e) {
				return json_encode(["isError" => true, "message" => "Unable to upload file"]);
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

		if (mysqli_query($this->mysqli, $sql)) {
			return json_encode(["isError" => false, "message" => "New Record Created Successfully"]);
		} else {
			return json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($this->mysqli)]);
		}
  }
  public function __destruct()
	{
		if (!$this->test) {
			parent::__destruct();
		}
	}
}

?>