<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');

?><!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Meilleurs scores</title>
	</head>
	<body>
		<h1>Guitar Wars - Meilleurs scores !</h1>
		<p>Hé Guitar Warrior, es-tu le maître absolu de Guitar Wars ?</p>
		<p>Pour le savoir <a href="score-formulaire.php">ajoute ton score</a>.</p>
		<?php
		//Message de confirmation ou d'erreur 
		if(isset($_GET['message']))
			echo '<h2>'.$_GET['message'].'</h2>';
		?>
		<h2>Classement mondial Guitar Wars</h2>
		<table>
			<th>
				<td colspan="2">Score</td>
				<td>Nom</td>
				<td>Date</td>
			</th>
		<?php
		//Connexion à la BD
		$cnx = bd_connexion();
		
		//Préparation de la requête, échappement des chaines
        $requete = "SELECT * FROM `score` WHERE valider = 1 ORDER BY score DESC";
					
        //Exécution de la requête
        $result = bd_requete($cnx, $requete);
		
		$row = mysqli_fetch_array($result);
		echo '<tr><td colspan="4">Top score ' . $row['score'] . ' pts</td></tr>';
			
		do{
			$image = "images/" . $row['screenshot'];
			echo ('<tr><td><img src="' . $image . '"/></td><td>' . $row['score'] . '</td><td>' . $row['nom'] . '</td><td>' . $row['date'] . '</td>');
		}while($row = mysqli_fetch_array($result));
		
		//Fermeture de la connexion
		mysqli_close($cnx);
		
		
		?>
			
			
		
		
		</table>
		
	</body>
</html>