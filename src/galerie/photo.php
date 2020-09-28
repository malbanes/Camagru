<?php
    session_start();

    include 'fonctions/galerie_fonctions.php';

    if(!isset($_GET['photo']) || empty($_GET['photo'])){
        header('Location: http://localhost:8080/src/home/error.php');
        exit();
    }
    $safe_id_photo = intval($_GET['photo']);
    $data = get_photo_info($safe_id_photo);
    if (!isset($data) || empty($data))
    {
        header('Location: http://localhost:8080/src/home/error.php');
        exit();
    }
    $data_photo= $data[0];
    $author = get_username($data_photo['id_user']);
    //print_r ($data_photo);
    
    //Get likes
    
    //get comments
    


    ?>


<!DOCTYPE html>
<html>

<head>
    <?php include("../../ressources/view/head.html"); ?>
    <title>Camagru-Home</title>
</head>

<body>
    <div id="page">
        <div id="header">
            <?php include("../../ressources/view/header.php"); ?>
        </div>

        <div id="content">
        </br></br>
            <div class = "center">
            <H2> Post de <?php echo($author[0]['login']); ?> </H2>
            <div class = "show_montage">
<img src= <?php echo("../../".$data_photo['link']); ?> alt='montage' ></img>

            </div>

            <div class="comments">
            </div>


            </div>
        </br></br>
        </div>

        <div id="footer">
            <?php include("../../ressources/view/footer.php"); ?>
        </div>

    </div>
</body>

</html>

