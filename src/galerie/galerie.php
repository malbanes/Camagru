<?php
    session_start();

    include 'fonctions/galerie_fonctions.php';

    if (isset($_SESSION['login'])){
        $data = get_user_id($_SESSION['login']);
        $current_user_id = $data[0]['id'];
    }

  //Calculer le nombre de page a afficher
  $row = get_nb_photo();
  $nb_pages= (int)($row/10);
  $rest = $row%10;
  if ($rest != 0)
  {
    $nb_pages = $nb_pages + 1;
  }
// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
    if ($currentPage <= 0 || $currentPage > $nb_pages)
    {
        header('Location: http://localhost:8080/src/home/error.php');
        exit();
    }
}else{
    $currentPage = 1;
}
  $datas = get_photos_date($currentPage - 1);
  $fix_path = "../../";

  /*foreach ($datas as $data)
  {
      $likes = get_nb_like($data['id_photo']);
      $data['nb_likes'] = $likes;
  }*/

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("../../ressources/view/head.html"); ?>
    <title>Camagru-Galerie</title>

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

            <H2> Galerie </H2>
            <div class='galerie'>
            <?php

            foreach ($datas as $data)
            {
                echo '<div class="galerie_photo">';

                echo ("<a href='./photo.php?photo=".$data['id_photo']."' ><img src='".$fix_path.$data['link']."' alt='photo' id=".$data['id_photo']."></img></a>");

                echo ('<div class="footer_photo">');
                $login = get_username($data['id_user']);
                echo ("<div class='f_p_login'><strong>".$login[0]['login']."</strong></div>");

                $likes = get_nb_like($data['id_photo']);
                echo ("<div class='f_p_like'> <div class='f_p_nb_like' id='nb_like".$data['id_photo']."'>".$likes."</div>");
                //echo ("<div class='f_p_like'> <div class='f_p_nb_like' id='nb_like".$data['id_photo']."'> 10000 </div>");

                if (isset($_SESSION['login']))
                {
                    if (did_i_like_it($data['id_photo'], $current_user_id) == 0)
                    {
                        echo ('<img src="../../ressources/img/icones/coeur_noir.png" class="photo_icones clickable" id="'.$data['id_photo'].'" onclick="add_like(this);"/>');
                    }
                    else
                    {
                        echo ('<img src="../../ressources/img/icones/coeur_rouge.png" class="photo_icones clickable" id="'.$data['id_photo'].'" onclick="add_like(this);"/>');
                    }

                }
                else {
                    echo ('<img src="../../ressources/img/icones/coeur_noir.png" class="photo_icones"/>');
                }
                echo "</div>";

                $nb_com = get_nb_commentaire($data['id_photo']);
                echo ("<div class='f_p_com'>".$nb_com);
                //echo ("<div class='f_p_com'> 10000");

                echo ('<img src="../../ressources/img/icones/commentaire.png" class="photo_icones"/>');
                echo "</div>";

                echo '</div>';

                echo '</div>';
            }
            ?>
                  </br></br>
                <nav class='pagination_nav'>
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?= ($currentPage == 1) ? "invisible" : "" ?>">
            <a href="./galerie.php?page=<?= $currentPage - 1 ?>" class="page-link"> <img class='icone-pagination' src=../../ressources/img/icones/left.png /></a>
        </li>
        <?php for($page = 1; $page <= $nb_pages; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                <a href="./galerie.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPage == $nb_pages) ? "invisible" : "" ?>">
            <a href="./galerie.php?page=<?= $currentPage + 1 ?>" class="page-link"><img class='icone-pagination' src=../../ressources/img/icones/right.png /></a>
        </li>
    </ul>
             </nav>
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
