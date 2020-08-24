<?php
    session_start();

    if (!isset($_SESSION['login']))
    {
        exit();
    }

if (isset($_POST['id_photo']) && $_POST['id_photo'] != NULL)
    {
        include 'fonctions/galerie_fonctions.php';

        $safe_id_photo = intval($_POST['id_photo']);
        $data = get_user_id($_SESSION['login']);
        $safe_id_user = intval($data[0]['id']);

        if (did_i_like_it($safe_id_photo, $safe_id_user) == 0)
        {
            //Ajouter un like
            try{
                include '../../config/database.php';
                $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $bdd->query("USE camagru");
                $requete = $bdd->prepare("INSERT INTO `likes` (`id_user`, `id_photo`) VALUES(:id_user, :id_photo)");
                $requete->bindParam(':id_photo', $safe_id_photo);
                $requete->bindParam(':id_user', $safe_id_user);
                $requete->execute();
            }
            catch (PDOException $e) {
                print "Erreur : ".$e->getMessage()."<br/>";
                die();
            }
        }
        else 
        {
            //supprimer un like
            try{
                include '../../config/database.php';
                $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $bdd->query("USE camagru");
                $requete = $bdd->prepare("DELETE FROM `likes` WHERE id_user = :id_user AND id_photo = :id_photo ");
                $requete->bindParam(':id_user', $safe_id_user, PDO::PARAM_INT);
                $requete->bindParam(':id_photo', $safe_id_photo, PDO::PARAM_INT);
                $requete->execute();
            }
            catch (PDOException $e) {
                print "Erreur : ".$e->getMessage()."<br/>";
                die();
            }
        }
    }
else {
    echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
    
}

?>
