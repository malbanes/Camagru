<?php
		session_start();

?>

<!DOCTYPE html>
<HTML>

<HEAD>
	<?php include("parts/head.html"); ?>
	<LINK rel="stylesheet" href="../css/sign.css" />
</HEAD>

<BODY>
	<?php include("parts/header.php"); ?>

	<div class="content"> <div class="connexion">
		<div class="texte"> <strong>Inscription</strong>, C’est gratuit  </div>
<div class="id">
<form method="post" action="check_sign_up.php">
<label for="identifiant" >Identifiant:</label> <input type="text" name="identifiant" id="identifiant" placeholder="Choisissez un nom" 
<?PHP if ($_SESSION['inscription-identifiant'] == "KO" ||
			$_SESSION['flag-user-exists'] == "KO")
			{echo "class='invalid'";}?>/><br/>

<label>Adresse e-mail: <input type="text" name="email" id="email" placeholder="exemple@gmail.fr" 
<?PHP if ($_SESSION['inscription-mail'] == "KO" ||
			$_SESSION['flag-regex-mail'] == "KO" || $_SESSION['flag-mail-exists'] == "KO")
			{echo "class='invalid'";}?>/></label><br/>

<label>Mot de passe: <input type="password" name="password1" id="password1" placeholder="Choisissez un mot de passe" 
<?PHP if ($_SESSION['inscription-password1'] == "KO" ||
			$_SESSION['flag-regex-password'] == "KO")
			{echo "class='invalid'";}?>/></label><br/>

<label>Confirmation du mot de passe: <input type="password" name="password2" id="p	assword2" placeholder="Confirmez mot de passe"
<?PHP if ($_SESSION['inscription-password2'] == "KO")
			{echo "class='invalid'";}?>/></label><br/>


<input class="submit_button" type="submit" name="submit" value="Envoyer"/>
</form></div>
	</div>
	</div>

	<?php include("parts/footer.php"); ?>
</BODY>
