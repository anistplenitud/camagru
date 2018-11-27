function validatePass(pass) {
    var re = /^.*(?=.{8,16})(?=.*\d)(?=.*[A-Z]).*$/;
    return re.test(String(pass));
}

function requestpasschange() {

  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText + "<br> It is done!";
      document.getElementById("c_passwd").value ='';
      document.getElementById("passwd").value = '';

    }
  };

  var x = document.getElementById("c_passwd").value;
  var c_x = document.getElementById("passwd").value;
  var t_k = document.getElementById("reset_token").value;

  if ((!validatePass(x)) || (x != c_x) || !(t_k))
  {
    alert("Password must conatain : \natleast 1 number,\n1 CAPITAL LETTER, \n and must 8-16 chars long. AND New Password fields must be the same!");
    return false;
  }
  else
  {
    xhttp.open("POST", "newpassword.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email="+document.getElementById("email").value
    +"&c_passwd="+document.getElementById("c_passwd").value
    +"&reset_token="+document.getElementById("reset_token").value);
  }
}

function validateEmail(pass) {
  var re = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
  return re.test(String(pass));
}

function requestemailchange() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo2").innerHTML = this.responseText;
      document.getElementById("email_c").value ='';
    }
  };

  if (!validateEmail(document.getElementById("email_c").value) || (document.getElementById("email_c").value != document.getElementById("email_cc").value))
  {
    alert("Email Invalid or Emails don't match");
  }
  else
  {
    xhttp.open("POST", "newemail.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email="+document.getElementById("email_c").value); 
  }
  
}

function requestdetailchange() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo4").innerHTML = this.responseText;
      document.getElementById("name").value ='';
      document.getElementById("surname").value ='';
    }
  };

  if (document.getElementById("name").value == '' || document.getElementById("surname").value == '')
  {
    alert("Enter Details");
  }
  else
  {
    xhttp.open("POST", "newdetails.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("name="+document.getElementById("name").value
      +"&surname="+document.getElementById("surname").value); 
  }
  
}


function notificationchange() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo3").innerHTML = this.responseText + "<br> It is done!";
      if ((document.getElementById("notif_choice").value) == 0) {
        document.getElementById("notif_choice").value = 1;
      }
      else {
        document.getElementById("notif_choice").value = 0; 
      }
    }
  };

  xhttp.open("POST", "emailnotfications.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("choice="+document.getElementById("notif_choice").value);
}