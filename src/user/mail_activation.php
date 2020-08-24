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
 
 <?php
// Récupération des variables nécessaires à l'activation
$login = $_GET['log'];
$cle = $_GET['cle'];
 
try{
    include '../../config/database.php';
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->query("USE camagru");
    
// Récupération de la clé correspondant au $login dans la base de données
$requete = $bdd->prepare("SELECT token,actif FROM user WHERE login like :login ");
if($requete->execute(array(':login' => $login)) && $row = $requete->fetch())
  {
    $clebdd = $row['token'];    // Récupération de la clé
    $actif = $row['actif']; // $actif contiendra alors 0 ou 1
  }
 
 
// On teste la valeur de la variable $actif récupéré dans la BDD
if($actif == '1') // Si le compte est déjà actif on prévient
  {
     echo "Votre compte est déjà actif !";
  }
else // Si ce n'est pas le cas on passe aux comparaisons
  {
     if($cle == $clebdd) // On compare nos deux clés
       {
          // Si elles correspondent on active le compte !
          echo "Votre compte a bien été activé !";
 
          // La requête qui va passer notre champ actif de 0 à 1
          $requete = $bdd->prepare("UPDATE user SET actif = 1 WHERE login like :login ");
          $requete->bindParam(':login', $login);
          $requete->execute();
       }
     else // Si les deux clés sont différentes on provoque une erreur...
       {
          echo "Erreur ! Votre compte ne peut être activé...";
       }
  }
 
}
    catch (PDOException $e) {
        print "Erreur : ".$e->getMessage()."<br/>";
        die();
    }
?>

        </div>

        <div id="footer">
            <?php include("../../ressources/view/footer.php"); ?>
        </div>

    </div>
</body>

</html>
