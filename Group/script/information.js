"use strict";

function validate() {
    let errMsg = "";
		let result = true;
		
		const DOBValue = document.getElementById("DOB").split("-");
		const CurrentYear = new Date().getFullYear();
		const Age = CurrentYear - DOBValue[2];
		
		const PostCode = document.getElementById("PostCode").value;
		const State = document.getElementById("State").value;
		const Comment = document.getElementById("Comment").value;
    const other = document.getElementById("others");
    const error = document.getElementById("error");

    //checking dob
		if (Age < 15) {
			errMsg = errMsg + "your age must be 15 or older\n";
			result = false;
		} else if (Age > 80) {
			errMsg = errMsg + "your age must be 80 or younger\n";
			result = false;
		}

		const PostCodeString = PostCode.toString();
		switch (State) {
			case 'VIC':
				if (PostCodeString.indexOf('3') !== 0 && PostCodeString.indexOf('8') !== 0) {
					result = false;
				}
				break;
			case 'NSW':
				if (PostCodeString.indexOf('1') !== 0 && PostCodeString.indexOf('2') !== 0) {
					result = false;
				}
				break;
			case 'QLD':
				if (PostCodeString.indexOf('4') !== 0 && PostCodeString.indexOf('9') !== 0) {
					result = false;
				}
				break;
			case 'NT':
				if (PostCodeString.indexOf('0') !== 0) {
					result = false;
				}
				break;
			case 'WA':
				if (PostCodeString.indexOf('6') !== 0) {
					result = false;
				}
				break;
			case 'SA':
				if (PostCodeString.indexOf('5') !== 0) {
					result = false;
				}
				break;
			case 'TAS':
				if (PostCodeString.indexOf('7') !== 0) {
					result = false;
				}
				break;
			case 'ACT':
				if (PostCodeString.indexOf('0') !== 0) {
					result = false;
				}
				break;
			default:
				result = false;
		}

    storinformation();

    //checking the "other" checkbox
    if (other.checked === true && Comment === "") {
			errMsg = errMsg + "you should type the other information";
			result = false;
    }

    if (errMsg != "") {
			error.textContent = errMsg;
		}

    return result;
}

//save data
function storinformation() {
    sessionStorage.FirstName = document.getElementById("FirstName").value;
    sessionStorage.LastName = document.getElementById("LastName").value;
    sessionStorage.DOB = document.getElementById("DOB").value;
    sessionStorage.StreetAdress = document.getElementById("StreetAdress").value;
    sessionStorage.SuburbTown = document.getElementById("SuburbTown").value;
    sessionStorage.State = document.getElementById("State").value;
    sessionStorage.PostCode = document.getElementById("PostCode").value;
    sessionStorage.EmailAddress = document.getElementById("EmailAddress").value;
    sessionStorage.PhoneNumber = document.getElementById("PhoneNumber").value;
    sessionStorage.Comment = document.getElementById("Comment").value;

    sessionStorage.gender = document.getElementById("female").value;

    sessionStorage.LPVC = document.getElementById("LP").checked;
    sessionStorage.Pick = document.getElementById("Pick").checked;
    sessionStorage.PCS = document.getElementById("PCS").checked;
    sessionStorage.other = document.getElementById("others").checked;
}

// http://ec2-13-239-38-4.ap-southeast-2.compute.amazonaws.com/Website/Creating_Data.php
function prefillform() {
    if (sessionStorage.FirstName != undefined) {
        document.getElementById("FirstName").value = sessionStorage.FirstName;
        document.getElementById("LastName").value = sessionStorage.LastName;
        document.getElementById("DOB").value = sessionStorage.DOB;
        document.getElementById("StreetAdress").value = sessionStorage.StreetAdress;
        document.getElementById("SuburbTown").value = sessionStorage.SuburbTown;
        document.getElementById("State").value = sessionStorage.State;
        document.getElementById("PostCode").value = sessionStorage.PostCode;
        document.getElementById("EmailAddress").value = sessionStorage.EmailAddress;
        document.getElementById("PhoneNumber").value = sessionStorage.PhoneNumber;
        document.getElementById("Comment").value = sessionStorage.Comment;

        if (sessionStorage.gender === "male") {
					document.getElementById("male").checked = true;
					document.getElementById("female").checked = false;
				} else {
					document.getElementById("male").checked = false;
					document.getElementById("female").checked = true;
				}
        document.getElementById("LP").checked = sessionStorage.LPVC;
        document.getElementById("Pick").checked = sessionStorage.Pick;
        document.getElementById("PCS").checked = sessionStorage.PCS;
        document.getElementById("others").checked = sessionStorage.other;
    }
}

window.onload = () => {
    document.getElementById("regForm").onsubmit = validate;
    prefillform();
}
