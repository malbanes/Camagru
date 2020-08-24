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

    

        /*if (isset($_SESSION['login'])){
        $data = get_user_id($_SESSION['login']);
        $current_user_id = $data[0]['id'];
    }*/
    print_r ($data_photo);


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
            <H2> Post de XX </H2>



            </div>
        </br></br>
        </div>

        <div id="footer">
            <?php include("../../ressources/view/footer.php"); ?>
        </div>

    </div>
</body>

</html>

