<?php
    session_start();
        if (!isset($_SESSION['login']))
        {
            header('Location: ../user/login.php');
            exit();
        }

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

        <div class="block-form">
        <H2> Mon Profile </H2>

        <?php echo("Login: ".$result['login']);
            echo"</br></br>";
            echo("email: ".$result['mail']);
            echo"</br></br>";
            ?>
            <a href="" class="small-text">changez vos informations de compte</a>
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
            <tr>
              <td><img class="miniature-photo" src="../../ressources/img/example.png"></img></td>
              <td><img class="miniature-photo" src="../../ressources/img/example.png"></img></td>
            </tr>
            <tr>
              <td><img class="miniature-photo" src="../../ressources/img/example.png"></img></td>
              <td><img class="miniature-photo" src="../../ressources/img/example.png"></img></td>
            </tr>
<tr>
  <td><img class="miniature-photo" src="../../ressources/img/example.png"></img></td>
  <td><img class="miniature-photo" src="../../ressources/img/example.png"></img></td>
</tr>
<tr>
  <td><img class="miniature-photo" src="../../ressources/img/example.png"></img></td>
  <td><img class="miniature-photo" src="../../ressources/img/example.png"></img></td>
</tr>

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


