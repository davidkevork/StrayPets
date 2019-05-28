<?php
require_once (__DIR__).'/../PHP Functions/includeAll.php';

use PHPUnit\Framework\TestCase;

class CreatingDataTest extends TestCase
{
  protected function setUp(): void
	{
    $_POST = array();
    $_GET = array();
    $_FILES = array();

    $this->CreatingData = new CreatingData(true);
  }
  public function testCreatingDataWorking(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(false, $output["isError"]);
    $this->assertEquals("Validation success", $output["message"]);
  }
  public function testCreatingDataInvalidState(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "NoIdeaWhichStateItIs",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Invalid or unknown state", $output["message"]);
  }
  public function testCreatingDataInvalidFirstName(): void
  {
    $_POST = [
      "FirstName" => "",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("First Name must be between 1 and 255 characters", $output["message"]);
  }
  public function testCreatingDataInvalidLastName(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Last Name must be between 1 and 255 characters", $output["message"]);
  }
  public function testCreatingDataInvalidDOB(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "NotADate",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Invalid date of birth", $output["message"]);
  }
  public function testCreatingDataInvalidGender(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "Abnormal",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Invalid or unknown pet gender", $output["message"]);
  }
  public function testCreatingDataInvalidStreetAddress(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Street Address must be between 1 and 255 characters", $output["message"]);
  }
  public function testCreatingDataInvalidSuburbTown(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Suburb/Town must be between 1 and 255 characters", $output["message"]);
  }
  public function testCreatingDataInvalidPostCode(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "NotAPostCode",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Post Code must be 4 digits", $output["message"]);
  }
  public function testCreatingDataInvalidEmailAddress(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Email Address must be between 1 and 255 characters", $output["message"]);
  }
  public function testCreatingDataInvalidPhoneNumber(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Phone Number must 10 digits", $output["message"]);
  }
  public function testCreatingDataInvalidPetState(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "ThisIsInvalidPetState"
      ],
      "Comment" => "rdhdxtjfc fjhg yfg tukghjgbn"
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Invalid or unknown pet state", $output["message"]);
  }
  public function testCreatingDataInvalidComment(): void
  {
    $_POST = [
      "FirstName" => "sgdhf",
      "LastName" => "Szdhxfcj",
      "DOB" => "2019-05-15",
      "Gender" => "male",
      "StreetAddress" => "zgfXzh",
      "SuburbTown" => "sGzhdfxjcg",
      "State" => "VIC",
      "PostCode" => "3000",
      "EmailAddress" => "jhbkn@vgkgjbh.com",
      "PhoneNumber" => "0456123456",
      "PetState" => [
        "LP",
        "Pick",
        "others"
      ],
      "Comment" => ""
    ];
    $output = $this->CreatingData->validate();

    $this->assertEquals(true, $output["isError"]);
    $this->assertEquals("Comment can't be empty", $output["message"]);
  }
}

?>