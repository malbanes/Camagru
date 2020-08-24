<?php session_start();
     if (isset($_SESSION['login']))
    {
        header('Location: ../user/profile.php');
        exit();
    }
    include '../../ressources/entities/escape.php';
    include './fonctions/connexion.php';

if (isset($_POST['submit']))
{
$error=0;
//Existance
if (check_form("login", $_POST['identifiant'])==0) {$error++;}
if (check_form("password1", $_POST['password1'])==0) {$error++;}
$password1=Escape::bdd($_POST['password1']);
$password=hash('sha512', $password1);
$login= Escape::bdd($_POST['identifiant']);
// Connexion à la base de données
    if ($error==0)
    {

     try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru");
        $requete = $bdd->prepare("SELECT * FROM `user` WHERE `login`= :login");
        $requete->bindParam(':login', $login);
        $requete->execute();
        $result = $requete->fetch();
        if ($result  != NULL){
            $mdp=$result['mdp'];
            $actif=$result['actif'];
            if ($mdp != $password)
            {$_SESSION['check-login'] = "Mauvais login ou mot de passe";$error++;}
            }

        else {$_SESSION['check-login'] = "Mauvais login";
        $error++;
        }
    }
    catch (PDOException $e) {
        print "Erreur : ".$e->getMessage()."<br/>";
        die();
    }
    if ($error==0)
    {
        $_SESSION['success'] = "Connection réussi.";
        $_SESSION['login'] = $login;
        echo "<meta http-equiv='refresh' content='0,url=../home/home.php'>";
    }}



}
?>

<!DOCTYPE html>
<HTML>


<head>
    <?php include("../../ressources/view/head.html"); ?>
    <title>Camagru-Login</title>
</head>

<body>
    <div id="page">
        <div id="header">
            <?php include("../../ressources/view/header.php"); ?>
        </div>

        <div id="content">
        </br></br>
<div class = "block-form">

        <H2> Connection </H2>
<! -- View formulaire inscription -->

<form method="post" action="">
<label for="identifiant" >Identifiant:</label> <input type="text" name="identifiant" id="identifiant" placeholder="Identifiants"/></label>
<?PHP if (isset($_SESSION['check-login']))
            {echo "<div class='erreur'>".$_SESSION['check-login']."</div>";$_SESSION['check-login']=NULL;}?><br/><br/>

<label>Mot de passe: <input type="password" name="password1" id="password1" placeholder="Mot de passe"
/></label>
<?PHP if (isset($_SESSION['check-password1']))
            {echo "<div class='erreur'>".$_SESSION['check-password1']."</div>";$_SESSION['check-password1']=NULL;}?><br/>

<input class="submit_button" type="submit" name="submit" value="Envoyer"/>
<a href="" class="small-text"> mot de passe oublié ? </a>
</form>
</div>

        </br></br>
        </div>

        <div id="footer">
            <?php include("../../ressources/view/footer.php"); ?>
        </div>

    </div>
</body>

</html>
