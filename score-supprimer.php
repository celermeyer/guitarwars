<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Supprimer un score | Guitar Wars</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php
		//Connexion à la BD
		$cnx = bd_connexion();
		
		//Préparation de la requête, échappement des chaines
		$id = $_GET['id'];
        $requete = "SELECT * FROM `score` WHERE id = $id LIMIT 1";
					
        //Exécution de la requête
        $result = bd_requete($cnx, $requete);
		
		$row = mysqli_fetch_array($result);
		?>
		<h1>Supprimer un score | Guitar Wars</h1>
		<p>Etes-vous certain de vouloir supprimer ce score ?</p>
		<p><b>Nom : </b><?php echo($row['nom']) ?></p>
		<p><b>Date : </b><?php echo($row['date']) ?></p>
		<p><b>Score : </b><?php echo($row['score']) ?></p>
		<p><img src="images/<?php echo($row['screenshot']) ?>" /></p>
	</body>
</html>