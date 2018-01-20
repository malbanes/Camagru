<?php
		session_start();

?>

<!DOCTYPE html>
<HTML>

<HEAD>
	<?php include("parts/head.html"); ?>
</HEAD>

<BODY>
	<?php include("parts/header.php"); ?>

	<div class="content">

		<form name="form_montage_main">
<DIV class="content_montage">
	<div class="main_montage">  <!-- layout-content -->
		<div class="montage">
			<div class="left_montage">
				Cadre
				<ul class="menu_montage"><li class="menu_2">img1</li>
				    <li class="menu_2">img2</li>
				    <li class="menu_2">img3</li>
				    <li class="menu_2">img4</li>
				</ul>	
			</div>

			<div class="mid_montage">
			<Video id="video"alt="Webcam"></video>
			</BR><button id="startbutton"> Take picture </button>
				<div class="invisible"><canvas id="canvas"> </canvas></div>
			</div>

			<div class="right_montage">
			Objets
				<ul  class="menu_montage"><li class="menu_2"><img src="./graph.jpeg"alt="imgA"></li>
				    <li class="menu_2"><img src="./graph.jpeg" alt="imgB"></li>
				    <li class="menu_2"><img src="./graph.jpeg" alt="imgC"></li>
				    <li class="menu_2"><img src="./graph.jpeg" alt="imgD"></li>
				</ul>	
			</div>

		</div></BR>
		<div class="appercu_montage">  <!-- layout-adv-->
			<img alt="appercu du montage"></BR>
<img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
			</BR><button> Save </button> <button> Discard </button>
		</div>

	</div>	
	<div class=side_montage>
				<ul><li>Photo1</li>
				    <li>Photo2</li>
				    <li>Photo3</li>
				    <li>Photo4</li>
				</ul>	
	</div>

</DIV>
	</div>

	<?php include("parts/footer.php"); ?>
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
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

})();
</script>
