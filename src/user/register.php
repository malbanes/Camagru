<?PHP session_start();
	if (isset($_SESSION['login']))
	{
		header('Location: ../user/my-account.php');
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
		<div class="texte"> <strong>Inscription</strong>, C’est gratuit  </div>
<div class="id">
<form method="post" action="check_inscription.php">
<label for="identifiant" >Identifiant:</label> <input type="text" name="identifiant" id="identifiant" placeholder="Choisissez un nom" 
<?PHP if (isset($_SESSION['check-login']))
			{echo "class='invalid'";}?>/></label>
<?PHP if (isset($_SESSION['check-login']))
			{echo "<div class='erreur'>".$_SESSION['check-login']."</div>";$_SESSION['check-login']=NULL;}?><br/>

<label>Adresse e-mail: <input type="text" name="email" id="email" placeholder="exemple@gmail.fr" 
<?PHP if (isset($_SESSION['check-mail']))
			{echo "class='invalid'";}?>/></label>
<?PHP if (isset($_SESSION['check-mail']))
			{echo "<div class='erreur'>".$_SESSION['check-mail']."</div>";$_SESSION['check-mail']=NULL;}?><br/>

<label>Mot de passe: <input type="password" name="password1" id="password1" placeholder="Choisissez un mot de passe" 
<?PHP if (isset($_SESSION['check-password1']))
			{echo "class='invalid'";}?>/></label>
<?PHP if (isset($_SESSION['check-password1']))
			{echo "<div class='erreur'>".$_SESSION['check-password1']."</div>";$_SESSION['check-password1']=NULL;}?><br/>


<label>Confirmation du mot de passe: <input type="password" name="password2" id="password2" placeholder="Confirmez mot de passe"
<?PHP if (isset($_SESSION['check-password']))
			{echo "class='invalid'";}?>/></label>
<?PHP if (isset($_SESSION['check-password']))
			{echo "<div class='erreur'>".$_SESSION['check-password']."</div>";$_SESSION['check-password']=NULL;}?><br/>


<input class="submit_button" type="submit" name="submit" value="Envoyer"/>
</form></div>
	</div>
	</div>

	<?php include("../../ressources/view/footer.php"); ?>
</BODY>
