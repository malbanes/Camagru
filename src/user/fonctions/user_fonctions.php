<?php

function get_photos_user_date($id_user)
{
    $safe_id_user = intval($id_user);
    try{
            include '../../config/database.php';
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->query("USE camagru");
            $requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_user`= '".$safe_id_user."' order by `date_upload`");
            $requete->execute();
            $data = $requete->fetchAll(PDO::FETCH_ASSOC);
            return ($data);
        }
        catch (PDOException $e) {
            print "Erreur : ".$e->getMessage()."<br/>";
            die();
        }
}


function get_user_id($username)
{

    try{
            include '../../config/database.php';
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->query("USE camagru");
            $requete = $bdd->prepare("SELECT `id` FROM `user` where `login` = :username LIMIT 1");
            $requete->bindParam(':username', $username);
            $requete->execute();
            $data = $requete->fetchAll(PDO::FETCH_ASSOC);
            return ($data);
        }
        catch (PDOException $e) {
            print "Erreur : ".$e->getMessage()."<br/>";
            die();
        }
}