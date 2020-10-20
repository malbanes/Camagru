<?php

function get_nb_photo()
{
    try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru");
        $requete = $bdd->prepare("SELECT COUNT(*) FROM `photos`");
        $requete->execute();
        $data = (int) $requete->fetchColumn();
        return ($data);
    }
    catch (PDOException $e) {
        print "Erreur : ".$e->getMessage()."<br/>";
        die();
    }
}

function get_photo_info($id_photo)
{
    $safe_id_photo = intval($id_photo);
    try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru");
        $requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo`= :id_photo");
        $requete->bindParam(':id_photo', $safe_id_photo);
        $requete->execute();
        $data = $requete->fetchAll(PDO::FETCH_ASSOC);
        return ($data);
    }
    catch (PDOException $e) {
        print "Erreur : ".$e->getMessage()."<br/>";
        die();
    }
}

function get_commentaires($id_photo)
{
    $safe_id_photo = intval($id_photo);
    try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru");
        $requete = $bdd->prepare("SELECT * FROM `comments` where `id_photo`= :id_photo");
        $requete->bindParam(':id_photo', $safe_id_photo);
        $requete->execute();
        $data = $requete->fetchAll(PDO::FETCH_ASSOC);
        return ($data);
    }
    catch (PDOException $e) {
        print "Erreur : ".$e->getMessage()."<br/>";
        die();
    }
}

function get_photos_date($offset)
{
    $safe_offset = intval($offset);

    try{
            include '../../config/database.php';
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->query("USE camagru");
            $requete = $bdd->prepare("SELECT * FROM `photos` order by `date_upload` desc LIMIT 10 OFFSET ".$safe_offset);
            $requete->execute();
            $data = $requete->fetchAll(PDO::FETCH_ASSOC);
            return ($data);
        }
        catch (PDOException $e) {
            print "Erreur : ".$e->getMessage()."<br/>";
            die();
        }
}

function get_nb_like($id_photo)
{
    $safe_id_photo = intval($id_photo);
    try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru");
        $requete = $bdd->prepare("SELECT COUNT(*) FROM `likes` where `id_photo`= :id_photo");
        $requete->bindParam(':id_photo', $safe_id_photo);
        $requete->execute();
        $data = (int) $requete->fetchColumn();
        return ($data);
    }
    catch (PDOException $e) {
        print "Erreur : ".$e->getMessage()."<br/>";
        die();
    }
}

function get_nb_commentaire($id_photo)
{
    $safe_id_photo = intval($id_photo);
    try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru");
        $requete = $bdd->prepare("SELECT COUNT(*) FROM `comments` where `id_photo`= :id_photo");
        $requete->bindParam(':id_photo', $safe_id_photo);
        $requete->execute();
        $data = (int) $requete->fetchColumn();
        return ($data);
    }
    catch (PDOException $e) {
        print "Erreur : ".$e->getMessage()."<br/>";
        die();
    }
}

function did_i_like_it($id_photo, $id_user)
{
    $safe_id_photo = intval($id_photo);
    $safe_id_user = intval($id_user);
    try{
        include '../../config/database.php';
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->query("USE camagru");
        $requete = $bdd->prepare("SELECT 1 FROM `likes` where `id_photo`= :id_photo AND `id_user`= :id_user LIMIT 1");
        $requete->bindParam(':id_photo', $safe_id_photo);
        $requete->bindParam(':id_user', $safe_id_user);
        $requete->execute();
        $data = (int) $requete->fetchColumn();
        return ($data);
    }
    catch (PDOException $e) {
        print "Erreur : ".$e->getMessage()."<br/>";
        die();
    }
}


function get_username($id_user)
{
    $safe_id_user = intval($id_user);

    try{
            include '../../config/database.php';
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->query("USE camagru");
            $requete = $bdd->prepare("SELECT `login` FROM `user` where `id` = :id_user LIMIT 1");
            $requete->bindParam(':id_user', $safe_id_user);
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
?>