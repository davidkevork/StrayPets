<?php
error_reporting(0);
session_start();

class CreatingData extends Mysql
{
  private $test;
  public function __construct($test = false)
	{
		$this->test = $test;
		if (!$this->test) {
			parent::__construct();
		}
	}
	public function array_in_array($needle, $haystack) {
		$output = true;
		foreach ($needle as $value) {
			if (!in_array($value, $haystack)) {
				$output = false;
			}
		}
		return $output;
	}
	public function validate() {
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

		$Gender = [
			'male',
			'female',
		];

		if (!in_array($_POST['State'], $State)) {
			return ["isError" => true, "message" => "Invalid or unknown state"];
		} else if (strlen($_POST['FirstName']) == 0 || strlen($_POST['FirstName']) > 255) {
			return ["isError" => true, "message" => "First Name must be between 1 and 255 characters"];
		} else if (strlen($_POST['LastName']) == 0 || strlen($_POST['LastName']) > 255) {
			return ["isError" => true, "message" => "Last Name must be between 1 and 255 characters"];
		}  else if (!strtotime($_POST['DOB'])) {
			return ["isError" => true, "message" => "Invalid date of birth"];
		} else if (!in_array($_POST['Gender'], $Gender)) {
			return ["isError" => true, "message" => "Invalid or unknown pet gender"];
		} else if (strlen($_POST['StreetAddress']) == 0 || strlen($_POST['StreetAddress']) > 255) {
			return ["isError" => true, "message" => "Street Address must be between 1 and 255 characters"];
		} else if (strlen($_POST['SuburbTown']) == 0 || strlen($_POST['SuburbTown']) > 255) {
			return ["isError" => true, "message" => "Suburb/Town must be between 1 and 255 characters"];
		} else if (strlen($_POST['PostCode']) != 4 || filter_var(FILTER_SANITIZE_NUMBER_INT, $_POST['PostCode'])) {
			return ["isError" => true, "message" => "Post Code must be 4 digits"];
		} else if (strlen($_POST['EmailAddress']) == 0 || strlen($_POST['EmailAddress']) > 255) {
			return ["isError" => true, "message" => "Email Address must be between 1 and 255 characters"];
		} else if (strlen($_POST['PhoneNumber']) != 10 || filter_var(FILTER_SANITIZE_NUMBER_INT, $_POST['PhoneNumber'])) {
			return ["isError" => true, "message" => "Phone Number must 10 digits"];
		} else if (!$this->array_in_array($_POST['PetState'], $PetState)) {
			return ["isError" => true, "message" => "Invalid or unknown pet state"];
		} else if (in_array('others', $_POST['PetState']) && strlen($_POST['Comment']) == 0) {
			return ["isError" => true, "message" => "Comment can't be empty"];
		}
		return ["isError" => false, "message" => "Validation success"];
	}
  public function run() {
		$validate = $this->validate();
		if ($validate["isError"] == false) {
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
			
			if (mysqli_query($this->mysqli, $sql)) {
				return json_encode(["isError" => false, "message" => "New Record Created Successfully"]);
			} else {
				return json_encode(["isError" => true, "message" => "Error: " . $sql . "<br>" . mysqli_error($this->mysqli)]);
			}
		} else {
			return $validate;
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