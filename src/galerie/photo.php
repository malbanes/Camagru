<?php
    session_start();

    include 'fonctions/galerie_fonctions.php';

    if(!isset($_GET['photo']) || empty($_GET['photo'])){
        header('Location: http://localhost:8080/src/home/error.php');
        exit();
    }
    if (isset($_SESSION['login'])){
        $data_user = get_user_id($_SESSION['login']);
        $current_user_id = $data_user[0]['id'];
    }
    $safe_id_photo = intval($_GET['photo']);
    $data = get_photo_info($safe_id_photo);
    if (!isset($data) || empty($data))
    {
        header('Location: http://localhost:8080/src/home/error.php');
        exit();
    }
    $data_photo= $data[0];
    $author = get_username($data_photo['id_user']);
    //print_r ($data_photo);
    
    //Get likes
    $likes = get_nb_like($data_photo['id_photo']);

    
    //get comments
    $nb_com = get_nb_commentaire($data_photo['id_photo']);
    $tab_comments = get_commentaires($data_photo['id_photo']);


    ?>


<!DOCTYPE html>
<html>

<head>
    <?php include("../../ressources/view/head.html"); ?>
    <title>Camagru-Home</title>
    <script>
 function add_like($this){

    var formData = new FormData();
    var id_photo = $this.id;

    formData.append('id_photo', id_photo);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_likes.php', true);
    xhr.send(formData);
    var prev_nb_like = parseInt(document.getElementById("nb_like"+id_photo).innerHTML);

    if ($this.src == "http://localhost:8080/ressources/img/icones/coeur_noir.png")
    {
        $this.src = "http://localhost:8080/ressources/img/icones/coeur_rouge.png";
        new_nb_like = prev_nb_like + 1;
    }
    else
    {
        $this.src = "http://localhost:8080/ressources/img/icones/coeur_noir.png";
        new_nb_like = prev_nb_like - 1;
    }
    document.getElementById('nb_like'+id_photo).innerHTML=new_nb_like;

 }

</script>
</head>

<body>
    <div id="page">
        <div id="header">
            <?php include("../../ressources/view/header.php"); ?>
        </div>

        <div id="content">
        </br></br>
            <div class = "center">
            <H2> Post de <?php echo($author[0]['login']); ?> </H2>
            <div class = "show_montage">
<img src= <?php echo("../../".$data_photo['link']); ?> alt='montage' ></img>


<div class='footer_photo_show' >

                <div class='f_p_login'>
                 <?php echo date("d-M-20y h:m:s", $data_photo['date_upload']); ?>
                </div>

                <div class='f_p_like'> <?php echo '<div class="f_p_nb_like" id="nb_like'.$data_photo['id_photo'].'" >'; ?> <?php echo $likes; ?></div>
                <?php
                if (isset($_SESSION['login']))
                {
                    if (did_i_like_it($data_photo['id_photo'], $current_user_id) == 0)
                    {
                        echo ('<img src="../../ressources/img/icones/coeur_noir.png" class="photo_icones clickable" id="'.$data_photo['id_photo'].'" onclick="add_like(this);"/>');
                    }
                    else
                    {
                        echo ('<img src="../../ressources/img/icones/coeur_rouge.png" class="photo_icones clickable" id="'.$data_photo['id_photo'].'" onclick="add_like(this);"/>');
                    }

                }
                else {
                    echo ('<img src="../../ressources/img/icones/coeur_noir.png" class="photo_icones"/>');
                }
                echo "</div>";
                ?>

                <div class='f_p_com'> 
                    <?php echo $nb_com; ?> <img src="../../ressources/img/icones/commentaire.png" class="photo_icones"/>
                </div>
    </div>
</div>

</br></br></br>

<!-- Liste des commentaires -->

            <div class="list_com">

                <div class="block_com">
                    <div class="prefix">
                    login 
                    </div>
                    <div class="text_com">
                    mon super com ivneoarignaegr ajv ajfnv jadfnbi jadfjn jdnfv ajfnd ajfnb ajdn bajdnfb ajdnfb jadnfbjnadfibjnad ifaba jdfb jadfnbij adfij nbfadjn bajdn fbdajnf ijnb ajn dfbi jan
                    </div>
                </div>

<!-- Fin liste commentaire --> </div>
            

<!-- Formulaire envoi commentaire -->
</br></br>
<h4> Laissez un commentaire ! </h4>

<div class="container">
    <div class="block_com">
        <div class="prefix">
        Current Login
        </div>
        <div class="text_com">
        entree de com
        </div>
    </div>
</div>


</div>
        </br></br>
        </div>

        <div id="footer">
            <?php include("../../ressources/view/footer.php"); ?>
        </div>

    </div>
</body>

</html>

