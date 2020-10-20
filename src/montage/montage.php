<?php
    session_start();
        if (!isset($_SESSION['login']))
        {
            header('Location: ../user/login.php');
            exit();
        }
        include 'fonctions/galerie_fonctions.php';


        try{
            include '../../config/database.php';
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->query("USE camagru");
            $requete = $bdd->prepare("SELECT * FROM `user` WHERE `login`= :login");
            $requete->bindParam(':login', $_SESSION['login']);
            $requete->execute();
            $result = $requete->fetch();

        }
        catch (PDOException $e) {
            print "Erreur : ".$e->getMessage()."<br/>";
            die();
        }
        if ($result==NULL)
        {
            header('Location: ../user/login.php');
            exit();
        }

        $_SESSION['id'] = $result['id'];

        if (isset($_SESSION['login'])){
          $data = get_user_id($_SESSION['login']);
          $current_user_id = $data[0]['id'];
      }

      $tab_photos = get_photos_user_date($current_user_id);
?>

<!DOCTYPE html>
<html>

<head>
    <?php include("../../ressources/view/head.html"); ?>
    <title>Camagru-Home</title>


<script>

 function ouvrir_camera() {

  navigator.mediaDevices.getUserMedia({ audio: false, video: { width: 400 } }).then(function(mediaStream) {

   var video = document.getElementById('sourcevid');
   video.srcObject = mediaStream;

   var tracks = mediaStream.getTracks();

   document.getElementById("message").innerHTML= tracks[0].label+" connecté"
   //console.log(tracks[0].label)
   //console.log(mediaStream)

   video.onloadedmetadata = function(e) {
    video.play();
                                                                                    
   };
   document.getElementById("close-cam").setAttribute("class", "visible");
   document.getElementById("open-cam").setAttribute("class", "invisible");
    
  }).catch(function(err) { console.log(err.name + ": " + err.message);

  document.getElementById("message").innerHTML="connection refusé, rechargez la page"});

 }

 function clear_filter() {
  var elements = document.getElementsByClassName("image_filtre_selection");
  for (element of elements) 
  {
    element.className = "image_filtre";
  }
  var canvas_filter = document.getElementById('canvas_filters');
  var ctx = canvas_filter.getContext('2d');
  ctx.clearRect(0, 0, canvas_filter.width, canvas_filter.height);
  ctx.restore();
 }

 function select_filter($this){
  // console.log($this.src)

  if ($this.className == "image_filtre_selection")
  {
    clear_filter();
  }
  else
  {
    clear_filter();
    $this.className = "image_filtre_selection";
    var canvas_filter = document.getElementById('canvas_filters');
    var ctx = canvas_filter.getContext('2d');
    //var img = new Image();
    //img.src = $this.src;
    //img.onload = function() {
      if ($this.id == '1' || $this.id == '2' || $this.id == '3' || $this.id == '4')
      {
        ctx.drawImage($this, 0, 0, 370, 300);
      }
      else 
      {
        ctx.drawImage($this, 0, 0);

      }
    //}

  }
 }

 function photo(){

  var vivi = document.getElementById('sourcevid');
  //var canvas1 = document.createElement('canvas');
  var canvas1 = document.getElementById('cvs')
  //console.log(canvas1)
  var ctx1 =canvas1.getContext('2d');
  canvas1.height=vivi.videoHeight
  canvas1.width=vivi.videoWidth
  ctx1.drawImage(vivi, 0,0, vivi.videoWidth, vivi.videoHeight);
  var canvas2 = document.getElementById('canvas_filters');
  var ctx2 = canvas2.getContext('2d');
  //canvas2.height=vivi.videoHeight
  //canvas2.width=vivi.videoWidth
  var canvasURL;
  var canvasURL2;

  var elements = document.getElementsByClassName("image_filtre_selection");
  var filtre = elements[0];

  canvasURL2 = filtre.src;
  //console.log(canvasURL2)

  //Send picture

    canvasURL = canvas1.toDataURL('image/png');
    document.getElementById('hidden_data').value = canvasURL;
    //canvasURL2 = canvas2.toDataURL('image/png');
    document.getElementById('hidden_data2').value = canvasURL2;

    var fd = new FormData(document.forms["form1"]);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fonctions/transform_image.php', true);
    xhr.send(fd);
 }

 
 function fermer(){

  var video = document.getElementById('sourcevid');
  var mediaStream=video.srcObject;
  //console.log(mediaStream)
  var tracks = mediaStream.getTracks();
  //console.log(tracks[0])
  tracks.forEach(function(track) {
   track.stop();
   document.getElementById("message").innerHTML=tracks[0].label+" déconnecté"
  });
    document.getElementById("close-cam").setAttribute("class", "invisible");
    document.getElementById("open-cam").setAttribute("class", "visible");

  video.srcObject = null;
 }

</script>
</head>

<body>
    <div id="page">
        <div id="header">
            <?php include("../../ressources/view/header.php"); ?>
        </div>

        <div id="content">
        </br></br>

<! -- Block montage -->

        <div class="block-form">
        <H2> Mes montages </H2>
<div class="main_montage">

<! -- sous-section Filtres -->
                   <div class="left_montage" style="display:inline-block;">
                   <?php

                     $fix_path = "../../";
                     include 'fonctions/filters.php';
                        $datas = get_filters();

                      echo ("<ul class='liste_filtre'>");

                      foreach ($datas as $data)
                      {
                        //echo $data[id_filter];
                        //echo $data[path_filter];

                        echo("<li class='element_filtre'>");
                        echo ("<img class='image_filtre' src='".$fix_path.$data['path_filter']."' alt='filtre' id=".$data['id_filter'].' onclick="select_filter(this);"></img>');

                        echo ("</li>");


                      }
                      echo ("</ul>");


                   ?>
                   </div>

<! -- sous-section Photos -->

<div class="mid_montage" style="display:inline-block;">

<div class="camera"style="position: relative;height: 320px;">
<canvas id="canvas_filters" width="370px" height="300px" style="position: absolute; left:0; top:0; z-index: 1;"></canvas>
<Video id="video"alt="Webcam"></video>
<video id="sourcevid" width="370px" height="300px" autoplay="true" style="position: absolute; left:0; top:0;"></video>
<div id="message" style='height:20px;width:350px;margin:5px;'></div>
</div>

<button id="open-cam" onclick='ouvrir_camera()' >ouvrir camera</button>
<button id="close-cam" class="invisible" onclick='fermer()' >fermer camera</button>
<button onclick='photo()' >prise de photo</button>


<canvas id="cvs" style='display:inline-block'></canvas>

<div>
 <br>
 <form method="post" accept-charset="utf-8" name="form1">
    <input name="hidden_data" id="hidden_data" type="hidden"/>
    <input name="hidden_data2" id="hidden_data2" type="hidden"/>
</form>
</div>


</div>

<! -- sous-section Appercu -->



        </div>
</div>

<! -- Block Photos -->

        <div class="block-form">
    <! -- Cree un tablau de 2/x -->
            <table>
<thead>
            <tr>
              <td><img class="icone" src="../../ressources/img/icones/dossier_photo.png"></img></td>
              <td>Mes photos</td>
            </tr>
</thead>

<?php 
$i = 0;
echo "<tr>";

foreach ($tab_photos as $photo)
    {
            if ($i == 2)
            {
                $i=0;
                echo "</tr><tr>";
            }
                echo '<td><a href="http://localhost:8080/src/galerie/photo.php?photo='.$photo['id_photo'].'"><img class="miniature-photo" src="../../'.$photo['link'].'">  </img></a></td>';

            $i++;    
    } 
    echo "</tr>";
    ?>

            </table>
        </div>

        </br></br>
        </div>


        <div id="footer">
            <?php include("../../ressources/view/footer.php"); ?>
        </div>

    </div>
</body>

</html>


