<?php
    session_start();
    if (isset($_SESSION['login']))
    {
      header('Location: ../user/profile.php');
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

<div class = "block-form">

        <H2> Inscription </H2>

        <! -- View formulaire inscription -->
        </br></br>
            <form id="registerForm" method="POST" action="check_register.php">
                <label for="myLogin"> Choisissez un nom :</label>
                <input id ="myLogin" name="identifiant" type="text" placeholder="Choisissez un nom">
                <! -- Affichage erreur login -->
                <?PHP if (isset($_SESSION['check-login']))
			          {echo "<div class='erreur'>".$_SESSION['check-login']."</div>";$_SESSION['check-login']=NULL;}?><br/></br>

                <label for="myEmail" > Entrez votre email :</label>
                <input id ="myEmail" name="email" type="text" placeholder="exemple@gmail.fr">
                 <! -- Affichage erreur email -->
                <?PHP if (isset($_SESSION['check-mail']))
			          {echo "<div class='erreur'>".$_SESSION['check-mail']."</div>";$_SESSION['check-mail']=NULL;}?><br/></br>

                <label for="myPassword1"> Choisissez un mot de passe :</label>
                <input id ="myPassword1" type="password" name="password1" placeholder="Choisissez un mot de passe">
                <! -- Affichage erreur mdp -->
                <?PHP if (isset($_SESSION['check-password1']))
			          {echo "<div class='erreur'>".$_SESSION['check-password1']."</div>";$_SESSION['check-password1']=NULL;}?><br/></br>

                <label for="myPassword2"> Confirmez votre mot de passe :</label>
                <input id ="myPassword2" type="password" name="password2" placeholder="Confirmez mot de passe">
                <! -- Affichage erreur mdp different -->
                <?PHP if (isset($_SESSION['check-password2']))
		          	{echo "<div class='erreur'>".$_SESSION['check-password2']."</div>";$_SESSION['check-password2']=NULL;}?><br/>

                <input type="submit" class="submit_button" value="Envoyer !">
                <a href="" class="small-text"> renvoyer le lien d'activation </a>

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

