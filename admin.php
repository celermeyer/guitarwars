<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');

?><!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Administration | Guitar Wars</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<h2>Guitar Wars - Administration</h2>
		<p><a href="<?php echo SITE_HTTP; ?>index.php">&lt;&lt; Retourner à la page d'accueil</a></p>
		<?php
		//Message de confirmation ou d'erreur 
		if(isset($_GET['message']))
			echo '<p>'.$_GET['message'].'</p>';
		
		//Connexion
		$cnx = bd_connexion();

		//Sélection des scores
		$req = "SELECT * FROM score ORDER BY score DESC, date ASC";
		$res = bd_requete($cnx, $req);
		
		//Si aucun résultat
		if(mysqli_num_rows($res) < 1)
			exit("<p>Acun résultats</p></body></html>");

		//Affiche le tableau des scores
		?>
		<table>
			<caption>Tableau d'administration des scores</caption>
			<tr>
				<th>Joueur</th>
				<th>Date</th>
				<th>Score</th>
				<th>Screenshot</th>
				<th colspan="2">Actions</th>
			</tr>
		<?php
		
		//Liste des scores
		while ($ligne = mysqli_fetch_array($res)) {
		?>	
			<tr>
				<td><?php echo $ligne['nom']; ?></td>
				<td><?php echo $ligne['date']; ?></td>
				<td><?php echo $ligne['score']; ?></td>
				<?php
				//Test si un screenshot existe pour ce résultat
				if (!empty($ligne['screenshot']) and is_file(UPLOAD_PHOTOS.$ligne['screenshot']))
					$url_screenshot = SITE_IMAGES.$ligne['screenshot'];
				else //Sinon s'il n'existe pas on met une image par défaut
					$url_screenshot = SITE_IMAGES.'unverified.gif';
				
				echo'<td><img src="'.$url_screenshot.'" alt="screenshot" class="screenshot"/></td>';			
				
				?>
				<td><a href="score-supprimer.php?id=<?php echo $ligne['id']; ?>">Supprimer</a></td>
				
				<?php //Si le score a déjà été validé
				if($ligne['valider']>0)
					echo "<td>OK</td>";
				else
				{ ?>
					<td><a href="score-valider.php?id=<?php echo $ligne['id']; ?>">Valider</a></td>
            	<?php } ?>
			</tr>	
		<?php	
		} //Fin boucle while 
		
		bd_ferme($cnx);
	?>
		</table>
	</body>
</html>
