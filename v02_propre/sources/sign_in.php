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
		<div class="texte"> <strong>Connexion </strong> </div>
<div class="id">
<form method="post" action= "#">

<label>Pseudo ou Adresse e-mail: <input type="text" name="pseudo" /></label><br/>

<label>Mot de passe: <input type="password" name="passe"/></label><br/>

<input class="submit_button" type="submit" value="Me connecter"/>

</form> <div><br/> <a href="./forgotpasswd.php">mot de passe oublié ?</a> </div>
	</div>
	</div>

	<?php include("parts/footer.php"); ?>
</BODY>
