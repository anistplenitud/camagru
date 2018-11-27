function hasGetUserMedia() {
  return !!(navigator.mediaDevices &&
    navigator.mediaDevices.getUserMedia);
}

if (hasGetUserMedia()) {

	const	constraints = {
	video : true	};
  
  	//const video = document.querySelector('video');
  	const captureVideoButton = document.querySelector('#screenshot .capture-button');
  	const screenshotButton = document.querySelector('#screenshot-button');
  	const img = document.querySelector('#screenshot img');
	const video = document.querySelector('#screenshot video');
	const canvas = document.createElement('canvas');

	navigator.mediaDevices.getUserMedia(constraints).then((stream) => {video.srcObject = stream});

	screenshotButton.onclick = video.onclick = function() {
	canvas.width = video.videoWidth;
	canvas.height = video.videoHeight;
	canvas.getContext('2d').drawImage(video, 0, 0);
  // Other browsers will fall back to image/png
	img.src = canvas.toDataURL('image/webp');
	test = document.getElementById('hidden_img');
	test.value = canvas.toDataURL();
  document.getElementById('btn').style.display = 'block';
	};
 
} else {
  alert('getUserMedia() is not supported by your browser');
}

function duplicateValue(a, b) {
	document.getElementById(b).value = document.getElementById(a).value;
} 

document.getElementById('status').onchange = function() {
	duplicateValue('status','status2');
}


function previewImg(input) {
  const img = document.querySelector('#screenshot img');

  var reader = new FileReader();

  reader.onload = function(e) {
    img.src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
  document.getElementById('btn2').style.display = 'block';
  alert("Only PNG Images can get stickers");
}

function remove()
{
  var item = event.target;
   var body = document.getElementsByTagName("BODY")[0];
   var display = document.getElementById("display");

   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        display.removeChild(item.parentNode.parentNode); 
      }
    }
    xhttp.open("POST", "deletemyimage.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image_info="+item.parentNode.elements[0].value);
}


function loadmask()
{
  var mask = event.target;
  var mask_overlay = document.getElementById("stickers_preview");
  var input_1 = document.getElementById("frm_upload_sticker");
  var input_2 = document.getElementById("frm_selfie_sticker");

  mask_overlay.src = mask.src;
  input_1.value = mask.src;
  input_2.value = mask.src;
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

    left_nav.onclick = function() {
    	xhttp.open("POST", "display_my_images.php", true);
   		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   		xhttp.send("n=0");	
    }
}






