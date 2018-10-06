<?php

    $liste_insulte = array(
    'crapule',
    'chenapan',
    'goujat',
    'manant'
    );

    // Récupération depuis une BDD
    $message = $resultat['message'];    

    // Le message est considéré comme valide
    $autorisation = true;

    // On parcourt toutes les insultes de la liste noire

    foreach($liste_insulte as $insulte)
    {
        // Si une insulte est comprise dans le message

        if(stripos($message, $insulte) !== false)
        {
            $autorisation = false;
            break;
        }
    }
?>
