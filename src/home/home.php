<?php
    session_start();
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
            <H2> Bienvenu sur Camagru ! </H2>
            <p class="big-text"> Prenez des photos, faites des montages et partagez-les. </p>
            <img width=40% height=auto src="../../ressources/img/example.png"></img><br/>
            </br> <p class="text">Notez et commentez les photos de vos amis.</p>
            </div>
        </br></br>
        </div>

        <div id="footer">
            <?php include("../../ressources/view/footer.php"); ?>
        </div>

    </div>
</body>

</html>
