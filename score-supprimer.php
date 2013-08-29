<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');

// Si la page est appelée par le formulaire
if (isset($_POST['submit']))
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
}
?><!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Supprimer un score | Guitar Wars</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<h2>Guitar Wars - Supprimer un score</h2>
			<p>Etes-vous certain de vouloir supprimer ce(s) score(s) ?</p>
            <p>
                <strong>Nom: </strong><?php echo $score['nom']; ?><br/>
                <strong>Date: </strong><?php echo $score['date']; ?><br/>
                <strong>Score: </strong><?php echo $score['score']; ?>
            </p>
        <?php    
            //Si un screenshot existe --> on l'affiche
            if(!empty($score['screenshot']))
                echo '<p><img src="'.SITE_IMAGES.$score['screenshot'].'" alt="screenshot"/></p>';
        ?>    
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="radio" name="confirmer" value="oui" /> Oui 
                <input type="radio" name="confirmer" value="non" checked="checked" /> Non <br />
                <input type="submit" value="Supprimer" name="submit" />                
                <!-- champs cachés -->
                <input type="hidden" name="id" value="<?php echo $score['id']; ?>" />
                <input type="hidden" name="nom" value="<?php echo $score['nom']; ?>" />
                <input type="hidden" name="score" value="<?php echo $score['score']; ?>" />
                <input type="hidden" name="screenshot" value="<?php echo $score['screenshot']; ?>" />
            </form>
	   <p><a href="<?php echo SITE_HTTP; ?>admin.php">&lt;&lt; Retourner à la page d'administration</a></p>
	</body>
</html>