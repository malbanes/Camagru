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
<form method="post" action="#">

<label>Pseudo: <input type="text" name="pseudo" placeholder="Choisissez un nom"/></label><br/>

<label>Mot de passe: <input type="password" name="passe" placeholder="Choisissez un mot de passe"/></label><br/>

<label>Confirmation du mot de passe: <input type="password" name="passe2" placeholder="Confirmez mot de passe"/></label><br/>

<label>Adresse e-mail: <input type="text" name="email" placeholder="exemple@gmail.fr"/></label><br/>

<input class="submit_button" type="submit" value="M'inscrire"/>

</form></div>
	</div>
	</div>

	<?php include("parts/footer.php"); ?>
</BODY>
