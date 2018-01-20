<DIV class=header>
		<DIV class=content><DIV class=titre> <H1> CAMAGRU </H1> </DIV> 

		<?php 
		 if (!empty($_SESSION["login"]))
		 {
		 	$display_user = "<DIV class=user> hi ".$_SESSION['login']."<button>deconnexion</button> </DIV>";
			echo $display_user; 
		} 
		else 
		{
			$display_signin = "<DIV class=user> <a href='./sign_in.php'><button> Connexion </button></a> <a href='./sign_up.php'><button> S'enregistrer </button></a> </DIV>";
			echo $display_signin;
		}?>


	</DIV></DIV>
	<DIV class="header_menu">
		<DIV class="menu_grand_forma">
		 <a class="element_menu" href="./home.php"><button class="menu">Accueil </button></a></li>	
		 <a class="element_menu" href="./galerie.php"><button class="menu">Galerie</button></a> </li>
		 <a class="element_menu" href="./montage.php"><button class="menu">Montage</button></a> </li>
		 <a class="element_menu" href="./utilisateur.php"><button class="menu">Mon compte </button></a></li>
		 <?php if ($_SESSION['login'] == "admin") {
		 		echo "<a class='element_menu' href='./admin.php'><button class='menu'>Admin </button></a></li>";
		 }
		 ?></DIV>
		
                  <DIV class="menu_petit_forma"><ul>
                     <li ><img src="./images/menu_deroulant.png" alt="Menu"></li>
                     <li><a class="element_menu" href="./index.php">Accueil </a></li>
                     <li><a class="element_menu" href="./galerie.php">Galerie</a></li>
                     <li><a class="element_menu" href="./montage.php">Montage</a></li>
                     <li><a class="element_menu" href="./utilisateur.php">Mon compte </a></li>
                     <li><a class="element_menu" href="./utilisateur.php">Aide</a></li></ul>
                  </DIV>
		</DIV>
	</div>
