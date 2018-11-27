function validateForm() {
 
	function validatePass(pass) {
    var re = /^.*(?=.{8,16})(?=.*\d)(?=.*[A-Z]).*$/;
    return re.test(String(pass));
    }
	
	var x = document.forms["signup_form"]["password"].value;
	var c_x = document.forms["signup_form"]["c_password"].value;

	if ((!validatePass(x)) || (x != c_x))
	{
		alert("Password must conatain : \natleast 1 number,\n1 CAPITAL LETTER, \n and must 8-16 chars long.");
		return false;
	}

}