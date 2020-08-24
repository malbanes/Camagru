
        <DIV class=content><DIV class=titre> <H1> CAMAGRU </H1> </DIV>

        <?php
         if (isset($_SESSION['login']))
         {
             $display_user = "<DIV class=user> hi ".$_SESSION['login']."<a href='../user/logout.php'><button>deconnexion</button></a> </DIV>";
            echo $display_user;
        }
        else
        {
            $display_signin = "<DIV class=user><a href='../user/login.php'><button> Connexion </button></a><a href='../user/register.php'><button> S'enregistrer </button></a> </DIV>";
            echo $display_signin;
        }?>

    </DIV>
    <DIV class="header_menu">
    <DIV class="menu_grand_forma"><a class="element_menu" href="../home/home.php"><button class="menu">Accueil </button></a></li><a class="element_menu" href="../galerie/galerie.php"><button class="menu">Galerie</button></a></li><a class="element_menu" href="../montage/montage.php"><button class="menu">Montage</button></a></li><a class="element_menu" href="../user/utilisateur.php"><button class="menu">Mon compte </button></a></li>
        <?php if (isset($_SESSION['login']) && $_SESSION['login'] == "admin") {
                 echo "<a class='element_menu' href='../admin/admin.php'><button class='menu'>Admin </button></a></li>";
         }
         ?></DIV>
        </DIV>
<?php
if (isset($_SESSION['success'])){
    echo ("<div class='success'><strong>Success:</strong>".$_SESSION['success']."</div>");$_SESSION['success']=NULL;
}
if (isset($_SESSION['erreur'])){
    echo ("<div class='erreur'><strong>Erreur:</strong>".$_SESSION['erreur']."</div>");$_SESSION['erreur']=NULL;
}
?>

