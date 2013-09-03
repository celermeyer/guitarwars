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
		<form method="post" action="score-supprimer.php">
		<table>
			<caption>Tableau d'administration des scores</caption>
			<tr>
				<th>Joueur</th>
				<th>Date</th>
				<th>Score</th>
				<th>Screenshot</th>
				<th>Validé</th>
				<th>Actions</th>
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
				
				if($ligne['valider'] == 1){
					echo '<td>Oui</td>';
				}else{
					echo '<td>Non</td>';
				}
				?>
				<td><input type="checkbox" name="score[]" value=<?php echo ($ligne['id']); ?> /></td>
			</tr>	
		<?php	
		} //Fin boucle while 
		
		bd_ferme($cnx);
	?>
		</table>
		<input type="submit" name="submit" value="Supprimer" />
		<input type="submit" name="submit" value="Valider" />
		</form>
	</body>
</html>
