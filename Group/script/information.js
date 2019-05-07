/*
filename: information.js
target file:ContactUs.html 
created date 29/04/2019
update 29/04/2019
author yichen

*/

"use strict";
function validate(){
	var errMsg="";
	var result = true;
	//elements for dob
	var a = new Date();
	var b =a.getFullYear();
	var d = document.getElementById("dob").value;
    var c = document.getElementById("dob").value.slice(-4);
	var age = b - Number(c);
	//element for state and postcode
	var postcode = Number(document.getElementById("PC").value.slice(0,1));
	var poststate = document.getElementById("state").value;
	//elements for "others" checkbox
	var text1 = document.getElementById("textother").value;
	var ckboc = document.getElementById("others");
	//element for error
	var error = document.getElementById("error");
	
	//checking dob
	if((!d.match(/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/))){
		errMsg = errMsg+"your birthday should match dd/mm/yyyy";
		result = false;
	} else {
		if (age<15)
		{
			errMsg = errMsg +"your age must be 15 or older\n";
			result = false;
		} else if (age>80)
		{
			errMsg = errMsg +"your age must be 80 or younger\n";
			result = false;
		}
	}
	
	//checking state and postcode
	switch(postcode){
		case 0:
		if (poststate!=="NT" || poststate!=="ACT")
		{
		errMsg = errMsg + "you should type the correct postcode";
		result = false; 	 
		}
		break;
		case 1:
		if (poststate !=="NSW")
			{
			 errMsg = errMsg + "you should type the correct postcode";
			 result = false; 
			}
			break;
		case 2:
			if (poststate !=="NSW")
			{
			 errMsg = errMsg + "you should type the correct postcode";
			 result = false; 
			}
			break;
		case 3:
		if (poststate !== "VIC")
			{
			errMsg = errMsg + "you should type the correct postcode";
			result = false;
			}
			break;
		case 4 :
		if (poststate!=="QLD")
		{
		errMsg = errMsg + "you should type the correct postcode";
		result = false; 	 
		}	
		break;
		case 5:
		if (poststate!=="SA")
		{
		errMsg = errMsg + "you should type the correct postcode";
		result = false; 	 
		}	
		break;
		case 6:
		if (postcode!=="WA")
		{
		 errMsg = errMsg + "you should type the correct postcode";
		result = false; 	
		}
		break;
		case 7 :
		if (poststate!=="TAS")
		{
		errMsg = errMsg + "you should type the correct postcode";
		result = false; 	 
		}
		break;
		case 8 :
		if (poststate !== "VIC")
			{
			errMsg = errMsg + "you should type the correct postcode";
			result = false;
			}
			break;
		case 9 :
			if (poststate!=="QLD")
		{
		errMsg = errMsg + "you should type the correct postcode";
		result = false; 	 
		}	
		break;
	}
	
	storinformation();
	
	//checking the "other" checkbox
	if(ckboc.checked === true && text1 === "")
	{
	errMsg = errMsg + "you should type the other information";
     result = false; 
	}
	
	if(errMsg != ""){
		error.textContent = errMsg;
	}
	
	return result;
}



//save data
function storinformation(){
	sessionStorage.FirstName= document.getElementById("fname").value;
	sessionStorage.LastName= document.getElementById("lname").value;
	sessionStorage.DoB= document.getElementById("dob").value;
	sessionStorage.StreetAdress= document.getElementById("sadress").value;
	sessionStorage.Suburb= document.getElementById("Suburb").value;
	sessionStorage.state= document.getElementById("state").value;
	sessionStorage.postcode= document.getElementById("PC").value;
	sessionStorage.email= document.getElementById("Eadress").value;
	sessionStorage.phone= document.getElementById("Pnumber").value;
	sessionStorage.textother = document.getElementById("textother").value;
	
	
	if(document.getElementById("male").value = "male"){
		sessionStorage.gender = "male";
	} else if(document.getElementById("female").value = "female"){
		sessionStorage.gender = "female";
	}
	
	if(document.getElementById("LP").checked){
		sessionStorage.LPVC= document.getElementById("LP").value;
	}
	if(document.getElementById("Pick").checked){
		sessionStorage.Pick= document.getElementById("Pick").value;
	}
	if(document.getElementById("PCS").checked){
	sessionStorage.PCS= document.getElementById("PCS").value;
	}
	if(document.getElementById("others").checked){
	sessionStorage.other= document.getElementById("others").value;
	}
}
//
function prefillform(){
	if (sessionStorage.FirstName != undefined)
	{
		document.getElementById("fname").value = sessionStorage.FirstName;
		document.getElementById("lname").value = sessionStorage.LastName;
		document.getElementById("dob").value = sessionStorage.DoB;
		document.getElementById("sadress").value = sessionStorage.StreetAdress;
		document.getElementById("Suburb").value = sessionStorage.Suburb;
		document.getElementById("state").value = sessionStorage.state;
		document.getElementById("PC").value = sessionStorage.postcode;
		document.getElementById("Eadress").value = sessionStorage.email;
		document.getElementById("Pnumber").value = sessionStorage.phone;
		document.getElementById("textother").value = sessionStorage.textother;
		
		if (sessionStorage.gender === "male")
		{
			document.getElementById("male").value = "male";
		}
		else if (sessionStorage.gender === "female")
		{
			document.getElementById("female").value = "female";
		}
		if (sessionStorage.LPVC !=undefined)
		{
			document.getElementById("LP").checked = true;
		}
	if (sessionStorage.Pick !=undefined)
		{
			document.getElementById("Pick").checked = true;
		}
	if (sessionStorage.PCS !=undefined)
		{
			document.getElementById("PCS").checked = true;
		}
	if (sessionStorage.other != undefined)
	{
		document.getElementById("others").checked = true;
	}
	}
}

function init(){
	var regForm = document.getElementById("regForm");
	regForm.onsubmit = validate;
	transferData();
	prefillform();
}


window.onload = init;

