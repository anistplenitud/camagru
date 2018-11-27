function togglecomments() {
  var item = event.target;

  x = event.target.parentNode.getElementsByClassName("comments");

  if (x[0].style.display != 'none') {
    for (i= 0; i < x.length; i++) {
        x[i].style.display = 'none';
    }    
  }
  else
  {
   for (i= 0; i < x.length; i++) {
        x[i].style.display = 'block';
    }     
  }
  
}

function like()
{

  var item = event.target;

   var body = document.getElementsByTagName("BODY")[0];
   var display = document.getElementById("display");

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       n_span = item.parentNode.lastChild;
       n_span.innerHTML = this.responseText;
      item.value = "liked";
      }
    }

    if (item.value != "liked")
    { 
      xhttp.open("POST", "likeimage.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("image_info="+item.parentNode.elements[0].value);
    }
}

function add_comment()
{
  var item = event.target;

   var body = document.getElementsByTagName("BODY")[0];
   var display = document.getElementById("display");

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        item.parentNode.elements[1].value = "";
      addnew = this.responseText;
      var newdiv = document.createElement("DIV");
      var t = document.createTextNode(addnew);
      newdiv.appendChild(t);
      item.parentNode.parentNode.appendChild(newdiv);
      item.parentNode.parentNode.insertBefore(newdiv, item.parentNode.parentNode.childNodes[1]);
      }
    }

    if (item.parentNode.elements[1].value && item.parentNode.elements[0].value ) {
        xhttp.open("POST", "addcomment.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("image_info="+item.parentNode.elements[0].value
      +"&comment="+item.parentNode.elements[1].value);
    }
    else
    {
      alert("Add Comment");
    }

}



window.onload = function() {
	var display = document.getElementById("display");
	var xhttp = new XMLHttpRequest();

  	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
     		display.innerHTML = this.responseText;
     	}
    }

    var left_nav = document.getElementById('left_nav');
    var right_nav = document.getElementById('right_nav');

    xhttp.open("POST", "display_images.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=7");  

    left_nav.onclick = function() {
    	xhttp.open("POST", "display_images.php", true);
   		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   		xhttp.send("email=4");	
    }

    right_nav.onclick = function() {
    	xhttp.open("POST", "display_images.php", true);
   		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   		xhttp.send("email=5");	
    }


}
