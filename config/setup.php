<?php
//on ajoute les donne de la BDD
include 'database.php';
//on ajoute les fonctions d'action de la bdd
include 'functions_database_creation.php';
session_start();
session_destroy();

//verifier que la bdd existe
try {
	$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete = $bdd->prepare("SELECT * FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :db_name");
		$requete->bindParam(':db_name', $DB_NAME);
		$requete->execute();
		$code = $requete->fetchAll(PDO::FETCH_ASSOC);
    }
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
//Si la BDD n'existe pas, on la cree
if ($code == NULL)
{
	try
	{
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("CREATE DATABASE IF NOT EXISTS $DB_NAME");
		$bdd->query("use $DB_NAME");
		create_user_table($bdd);
		//add_users($bdd);
		create_pictures_table($bdd);
		//add_pictures($bdd);
		create_likes_table($bdd);
		//add_likes($bdd);
		create_comments_table($bdd);
		//add_comments($bdd);
		create_filters_table($bdd);
		add_filters($bdd);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
	//on renvois a la page d'acceuil
	header('Location: ../index.php');
}
//si la BDD existe, on renvoi vers la page d'acceuil
else {
	header('Location: ../index.php');
}

?>
