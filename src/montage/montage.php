<?php
		session_start();

?>

<!DOCTYPE html>
<HTML>

<HEAD>
	<?php include("../../ressources/view/head.html"); ?>
<LINK rel="stylesheet" href="./ressources/css/montage.css" />
</HEAD>
<script>
function selectIt(img){
    var name = img.src;
	img.style.border='solid 2px blue';
	//or 	img.style.border='solid 2px #00f0';

}
</script>
<BODY>
	<?php include("../../ressources/view/header.php"); ?>

	<div class="content">

		<form name="form_montage_main">
<DIV class="content_montage">
	<div class="main_montage">  <!-- layout-content -->
		<div class="montage">
			<div class="left_montage">
				Objets
				<ul class="menu_montage"><li class="menu_2"><img class="pp" src="../../ressources/img/icones/point.png" id="../../ressources/img/icones/point.png" ><img onclick="selectIt(this)" class="img_flt" src="../../ressources/img/filtres/filtre1.png" alt=filtre1></li>
				    <li class="menu_2"><img class="pp" src="../../ressources/img/icones/point.png" width=8px heigh=auto ><img class="img_flt" src="../../ressources/img/filtres/filtre2.png" alt=filtre2></img></li>
				    <li class="menu_2"><img class="pp"  src="../../ressources/img/icones/point.png" width=8px heigh=auto ><img class="img_flt" src="../../ressources/img/filtres/filtre3.png" alt=filtre3></img></li>
				    <li class="menu_2"><img class="pp" src="../../ressources/img/icones/point.png" width=8px heigh=auto ><img class="img_flt" src="../../ressources/img/filtres/filtre4.gif" alt=filtre4></img></li>
 <li class="menu_2"><img class="pp" src="../../ressources/img/icones/point.png" width=8px heigh=auto ><img class="img_flt" src="../../ressources/img/filtres/filtre5.png" alt=filtre5></img></li>
				</ul>	
			</div>

			<div class="mid_montage">
			<Video id="video"alt="Webcam"></video>
			</BR><button id="startbutton"> <img class="icone" src="../../ressources/img/icones/photo.png" alt="Prendre une photo"> </button><img id="reset" class="icone" src="../../ressources/img/icones/error.png" alt="discard" label="Supprimer"> </pre>
				<div class="invisible"><canvas id="canvas"> </canvas></div>
			</div>

			<div class="right_montage">
			Cadres
				<ul  class="menu_montage"><li class="menu_2"> <li class="menu_2"><img class="img_flt" src="../../ressources/img/filtres/cadre1.gif" alt=cadre1></img></li>
				    
				    <li class="menu_2"><img class="pp" src="../../ressources/img/icones/point.png" width=8px heigh=auto ><img class="img_flt" src="../../ressources/img/filtres/cadre3.png" alt=cadre1></img></li>
				    <li class="menu_2"><img class="pp" src="../../ressources/img/icones/point.png" ><img class="img_flt" src="../../ressources/img/filtres/cadre4.png" alt=cadre1></img></li>
				</ul>	
			</div>

		</div></BR>
		<div class="appercu_montage" style="display:none;" id="app_montage">  <!-- layout-adv-->
			</BR>
<img src="" id="photo" alt="appercu du montage">
			</BR><a href="save_montage.php" ><img  class="icone" src="../../ressources/img/icones/ok.png" alt="save"></a> 
		</div>

	</div>	
	<div class=side_montage><img class="icone" src="../../ressources/img//icones/dossier_photo.png" alt="Historique" nale="Historique"></br> </br> </br></br> 

	</div>

</DIV>
	</div>

	<?php include("../../ressources/view/footer.php"); ?>
</BODY>


		<script>
(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 320,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
    photo.setAttribute('class', "inherit");
    document.getElementById('app_montage').style.display = "block";
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

})();

/*
  function savefiltre() {
	filtres = sessionStorage.getItem('filtre');


	// Save data to sessionStorage
sessionStorage.setItem('key', 'value');

// Get saved data from sessionStorage
var data = sessionStorage.getItem('key');

// Remove saved data from sessionStorage
sessionStorage.removeItem('key');

// Remove all saved data from sessionStorage
sessionStorage.clear();
	if (sessionStorage.length == 0)
	{
		document.getElementById('startbutton').style.display = "none";
		document.getElementById('reset').style.display = "none";
	}

  }*/

reset.onclick = function()
{
	sessionStorage.clear();
	if (sessionStorage.length == 0)
	{
		document.getElementById('startbutton').style.display = "none";
		document.getElementById('reset').style.display = "none";
	}
}

</script>
