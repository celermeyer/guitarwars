<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');

$erreurs = score_controle($_POST);
//Si validation confirmée  
if (isset($erreurs) and count($erreurs) > 0){
	$liste_erreurs = "<ul>";
			
	foreach($erreurs as $erreur)
		$liste_erreurs .= "<li>$erreur</li>";
				
	echo $liste_erreurs."</ul>";
}

