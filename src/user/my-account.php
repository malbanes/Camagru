<?php session_start();
 	if (!isset($_SESSION['login']))
	{
		header('Location: ../user/login.php');
		exit();
	}
	include '../../ressources/entities/escape.php';
	include './fonctions/inscription.php';

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
<HTML>

<HEAD>
	<?php include("../../ressources/view/head.html"); ?>
	<LINK rel="stylesheet" href="./ressources/css/sign.css" />
</HEAD>

<BODY>
	<?php include("../../ressources/view/header.php"); ?>

<div class="content">


 <div class="connexion">
		<div class="texte"> <strong>Mon compte</strong></div>
<div class="id">
	<?php echo("Login: ".$result['login']);
		echo"</br></br>";
echo("email: ".$result['mail']);
		echo"</br></br>";
	?>
	<a href="">Préférences</a>
	 </div>
	</div>
	</div>

	<?php include("../../ressources/view/footer.php"); ?>
</BODY>

