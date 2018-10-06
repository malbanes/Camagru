<?php
	//Appel: $pseudo = Escape::bdd($_POST['pseudo'])

	class Escape
	{
		// Données entrantes
		public static function bdd($string)
		{
			// On regarde si le type de string est un nombre entier (int)
			if(ctype_digit($string))
			{
				$string = intval($string);
			}
			// Pour tous les autres types
			else
			{
				$string = addcslashes($string, '%_');
			}
				
			return $string;

		}
		// Données sortantes
		public static function html($string)
		{
			return htmlentities($string);
		}

	}
?>
