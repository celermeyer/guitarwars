<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');

?><!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Tous les scores</title>
	</head>
	<body>
		<table>
			<th>
				<td>Joueur</td>
				<td>Date</td>
				<td>Score</td>
				<td>Screenshot</td>
				<td colspan="2">Actions</td>
			</th>
		<?php
		//Connexion à la BD
		$cnx = bd_connexion();
		
		//Préparation de la requête, échappement des chaines
        $requete = "SELECT * FROM `score` ORDER BY date DESC";
					
        //Exécution de la requête
        $result = bd_requete($cnx, $requete);
		
		while($row = mysqli_fetch_array($result)){
			$image = "images/" . $row['screenshot'];
			if($row['valider'] == 1){
				echo ('<tr><td>' . $row['nom'] . '</td><td>' . $row['date'] . '</td><td>' . $row['score'] . '</td><td><img src="images/' . $row['screenshot'] . '"/></td><td><a href="score-supprimer.php?id=' . $row['id'] . '">Supprimer</a></td><td>OK</td>');
			}else{
				echo ('<tr><td>' . $row['nom'] . '</td><td>' . $row['date'] . '</td><td>' . $row['score'] . '</td><td><img src="images/' . $row['screenshot'] . '"/></td><td><a href="score-supprimer.php?id=' . $row['id'] . '">Supprimer</a></td><td><a href="score-valider.php?id=' . $row['id'] . '">Valider</a></td>');
			}
			
			
		}
		
		//Fermeture de la connexion
		mysqli_close($cnx);
		
		
		?>
			
			
		
		
		</table>
		
	</body>
</html>