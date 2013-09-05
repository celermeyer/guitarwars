<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');

var_dump($_POST);

//Suppression multiple
if(isset($_POST['sup_multiple']))
{
    foreach ($_POST['idscores'] as $id_score)
        if(!score_supprimer($id_score))
             $message = urlencode("Erreur : Tous les scores n'ont pas été supprimés !");    
    
    if(empty($message))
        $message = urlencode("Scores supprimés !");    
    header("Location: ".SITE_HTTP."admin.php?message=$message");
    exit;
}

//Si validations multiple
if(isset($_POST['val_multiple']))
{
    foreach ($_POST['idscores'] as $id_score)
        if(!score_valider($id_score))
            $message = urlencode("Erreur : Tous les scores n'ont pas été validés ou certains score étaient déjà valides!");
    
    if(empty($message))
        $message = urlencode("Scores validés !");
    header("Location: ".SITE_HTTP."admin.php?message=$message");
    exit;
}

// Si la page est appelée par le formulaire de suppression
if(isset($_POST['supprimer']))
{
	//Si la suppession a été confirmée    
    if ($_POST['confirmer'] == 'oui')
	{
		//Supression du score    	
		if(score_supprimer($_POST['id']))
			$message = urlencode("Score supprimé !");
		else
			$message = urlencode("Suppression impossible pour l'instant !");
	}
	else
		$message = urlencode("Suppression annulée !");
	
	// Redirection vers index.php avec message
	header("Location: ".SITE_HTTP."admin.php?message=$message");
	exit;	
}

//Si un id est passée en paramètre d'URL
if(strlen($_GET['id'])) 
	//On charge les données du score
	if(!$score = score_charger($_GET['id'])) 
	{	//Si id de client invalide !
		$message = urlencode("Score introuvable !");
		header("Location: ".SITE_HTTP."admin.php?message=$message");
		exit;
	}
			

?><!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Supprimer un score | <?php echo SITE_NOM; ?></title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<h2>Guitar Wars - Supprimer un score</h2>
			<p>Etes-vous certain de vouloir supprimer ce score ?</p>
            <p>
                <strong>Nom: </strong><?php echo $score['nom']; ?><br/>
                <strong>Date: </strong><?php echo $score['date']; ?><br/>
                <strong>Score: </strong><?php echo $score['score']; ?>
            </p>
        <?php    
            //Si un screenshot existe --> on l'affiche
            if(!empty($score['screenshot']) and is_file(UPLOAD_PHOTOS.$score['screenshot']))
                echo '<p><img src="'.SITE_IMAGES.$score['screenshot'].'" alt="screenshot"/></p>';
        ?>    
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="radio" name="confirmer" value="oui" /> Oui 
                <input type="radio" name="confirmer" value="non" checked="checked" /> Non <br />
                <input type="submit" value="Supprimer" name="supprimer" />                
                <!-- champs cachés -->
                <input type="hidden" name="id" value="<?php echo $score['id']; ?>" />
                <input type="hidden" name="nom" value="<?php echo $score['nom']; ?>" />
                <input type="hidden" name="score" value="<?php echo $score['score']; ?>" />
                <input type="hidden" name="screenshot" value="<?php echo $score['screenshot']; ?>" />
            </form>
	   <p><a href="<?php echo SITE_HTTP; ?>admin.php">&lt;&lt; Retourner à la page d'administration</a></p>
	</body>
</html>