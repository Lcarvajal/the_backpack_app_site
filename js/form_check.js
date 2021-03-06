function validateUser() {
	// store all info in variables
	var username = document.forms["form"]["username"].value;

	// check if username is an email filled out correctly	
	if( !isEmail( username ) 
		|| username == "" 
		|| username == null ) {
		return false;
	}
	
	return true;
}

function validateNewUser() {

	// store all info in variables
	var firstName = document.forms["new_user"]["firstname"].value;
	var lastName = document.forms["new_user"]["lastname"].value;
	var email = document.forms["new_user"]["new_email"].value;
	var re_email = document.forms["new_user"]["re_email"].value;

	// check if form is filled out correctly	
	if( !isAlpha( firstName ) 
		|| firstName == "" 
		|| firstName == null) {

		return false;
	}
	else if( !isAlpha( lastName ) 
		|| lastName == "" 
		|| lastName == null ) {
		return false;
	}
	else if( !isEmail( email ) 
		|| email == "" 
		|| email == null ) {
		return false;
	}

	if( email.toLowerCase() != re_email.toLowerCase() ) {
		return false;
	}
	
	return true;

}

// checks if string is only composed of letters
function isAlpha(s) {
	var letters = /^[a-z]+$/;

	if( s.toLowerCase().match( letters ) )
		return true;

	return false;
}

//  checks if '@' only occurs once 
function isEmail(e) {
	// number of times '@' occurs
	var n = e.split('@').length - 1;
	

	if( n != 1 )
		return false;
	
	return true;
}
