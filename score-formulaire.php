<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');

?><!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Ajouter un score</title>
	</head>
	<body>
		<h1>Guitar Wars - Ajoute ton meilleur score !</h1>
		<p><a href="index.php"><< Retourner aux meilleurs scores</a></p>
		<form enctype="multipart/form-data" name="ajout_score" method="post" action="score-ajouter.php">
			<label for="nom">Nom : </label>
			<input type="text" name="nom" id="nom" />
			<br/>
			<label for="score">Meilleur score : </label>
			<input type="text" name="score" id="score" />
			<br/>
			<label for="screenshot">Nom : </label>
			<input type="file" name="screenshot" id="screenshot" />
			<input type="submit" name="envoyer"/>
		</form>		
	</body>
</html>