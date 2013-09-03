<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');

// Si la page est appelée par le formulaire
if($_POST['submit'] == "Supprimer")
{

	//Supression du score   
	$scores = $_POST['score']; 	
	$reussi = true;
	foreach ($scores as $score) {
		if(score_supprimer($score) < 1){
			$reussi = false;
		}
		if($reussi){
			$message = urlencode("Score(s) supprimé(s) !");
		}else{
			$message = urlencode("Suppression impossible pour l'instant !");
		}
	}
	
	// Redirection vers index.php avec message
	header("Location: ".SITE_HTTP."admin.php?message=$message");
	exit;	
}else{
	//Supression du score   
	$scores = $_POST['score']; 	
	$reussi = true;
	foreach ($scores as $score) {
		if(score_valider($score) < 1){
			$reussi = false;
		}
		if($reussi){
			$message = urlencode("Score(s) validé(s) !");
		}else{
			$message = urlencode("Validation impossible pour l'instant !");
		}
	}
	
	// Redirection vers index.php avec message
	header("Location: ".SITE_HTTP."admin.php?message=$message");
	exit;	
}
?>