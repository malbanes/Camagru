<?PHP session_start();
	if (isset($_SESSION['login']))
	{
		header('Location: ../user/my-account.php');
		exit();
	}

	include '../../ressources/entities/escape.php';
	include './fonctions/inscription.php';
// Vérification des données saisies par l'utilisateur
$error=0;
//Existance et regex
if (check_form("login", $_POST['identifiant'])==0) {$error++;}
if (check_form("mail", $_POST['email'])==0) {$error++;}
if (check_form("password1", $_POST['password1'])==0) {$error++;}
if (check_form("password", $_POST['password2'])==0) {$error++;}


if ($error==0){
//Si ok on valide nos variables
$mail=Escape::bdd($_POST['email']);
$password1=Escape::bdd($_POST['password1']);
$password=Escape::bdd($_POST['password2']);
$login= Escape::bdd($_POST['identifiant']);

	//Verification du LOGIN
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `user` WHERE `login`= :login");
		$requete->bindParam(':login', $login);
		$requete->execute();
		$result = $requete->rowCount();
		if ($result  > 0){
			$_SESSION['check-login'] = "Login déjà pris";
		$error++;
		}
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}


	//Verification de l'EMAIL
	if (filter_var($mail, FILTER_VALIDATE_EMAIL) == FALSE)
	{
		$_SESSION['check-mail'] = "format invalide";
		$error++;
		}

		//isunique?
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `user` WHERE `mail`= :mail");
		$requete->bindParam(':mail', $mail);
		$requete->execute();
		$result = $requete->rowCount();
		if ($result  > 0){
			$_SESSION['check-mail'] = "Cet email existe déjà";
		$error++;
		}
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}

	//Verification du PASSWORD
	if ($password1 != $password)
	{
		$_SESSION['check-password'] = "mots de passes différents";
		$error++;
		}
}


// Enregistrement des données dans la base
if ($error == 0)
{
  // Génération aléatoire d'une clé
  $cle = md5(microtime(TRUE)*100000);
  $default=0;
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$password = hash('sha512', $password1);
		$requete = $bdd->prepare("INSERT INTO `user` (`login`, `mail`, `groupe`, `mdp`, `actif`, `token`)
		VALUES(:identifiant, :mail, :user, :password, :actif, :token)");
		$requete->bindParam(':identifiant', $login);
		$requete->bindParam(':mail', $mail);
		$requete->bindValue(':user', 'user');
		$requete->bindParam(':password', $password);
		$requete->bindParam(':actif', $default);
		$requete->bindParam(':token', $cle);
		$requete->execute();

// Préparation du mail contenant le lien d'activation
$destinataire = $mail;
$sujet = "Activer votre compte" ;
$entete = "From: inscription@camagru.com" ;
 
// Le lien d'activation est composé du login(log) et de la clé(cle)
$message = 'Bienvenue sur Camagru,
 
Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
 
http://localhost:8080/src/user/activation.php?log='.urlencode($login).'&cle='.urlencode($cle).'
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
if (mail($destinataire, $sujet, $message, $entete) == FALSE) // Envoi du mail
 {
	die();
 }

// Fermeture de la connexion	
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
	$_SESSION['success'] = "Inscription effectué. Validez votre compte en cliquant sur le lien qui vous à etait envoyé.";
	echo "<meta http-equiv='refresh' content='0,url=../home/home.php'>";
}
else {
$_SESSION['error']= "Echec de l'inscriptions, un ou plusieurs champ(s) sont invalide(s).";
	echo "<meta http-equiv='refresh' content='0,url=register.php'>";
	exit();
}
