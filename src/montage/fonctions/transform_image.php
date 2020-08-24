
<?php
    session_start();

if (isset($_POST['hidden_data']) && $_POST['hidden_data'] != NULL && isset($_POST['hidden_data2']) && $_POST['hidden_data2'] != NULL)
    {
        $upload_dir = "../../../public/galerie/";
        $img = $_POST['hidden_data'];
        $img2 =$_POST['hidden_data2'];
        
        $img = str_replace('data:image/png;base64,', '', $img);

        $img = str_replace('', '+', $img);
        
        $img = base64_decode($img);
        

        $_SESSION['image1'] = $img;
        $_SESSION['image2'] = $img2;

        $filename = mktime() . $_SESSION['id'] . ".png";
        
        $img = imagecreatefromstring($img);
        //$img2 = imagecreatefromstring($img2); //does not save canal alpha
        $img2 = imagecreatefrompng($img2);

        imagecopymerge($img, $img2, 0, 0, 0, 0, 370, 300, 100);
        imagepng($img, $upload_dir . $filename);
        
        $file = $upload_dir . $filename;
        $path = $file;
        $path_for_bdd = "public/galerie/" . $filename;
        $id = $_SESSION['id'];
        
        try{
            $date_upload = time();
            include '../../../config/database.php';
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->query("USE camagru");
            $requete = $bdd->prepare("INSERT INTO `photos` (`link`, `id_user`, `date_upload`) VALUES(:link, :id_user, :date_upload)");
            $requete->bindParam(':link', $path_for_bdd);
            $requete->bindParam(':id_user', $id);
            $requete->bindParam(':date_upload', $date_upload);
            $requete->execute();
        }
        catch (PDOException $e) {
            print "Erreur : ".$e->getMessage()."<br/>";
            die();
        }
    }
else {
    echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
    
}

?>

