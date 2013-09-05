<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Ajouter un score | Guitar Wars</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<h1>Guitar Wars - Ajoute ton meilleur score !</h1>
        <p><a href="<?php echo SITE_HTTP; ?>index.php">&lt;&lt; Retourner aux meilleurs scores</a></p>
		
		<?php 
		//Afficher message d'erreur
		if(isset($erreurs) and count($erreurs)>0)
		{
			$liste_erreurs = "<ul>";
			
			foreach($erreurs as $erreur)
				$liste_erreurs .= "<li>$erreur</li>";
				
			echo $liste_erreurs."</ul>";
		}
        ?>
		
		<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo UPLOAD_MAX_SIZE; ?>" />
			
			<label for="nom">Votre nom :</label>
			<input type="text" id="nom" name="nom"	value="<?php if (isset($form_nom))echo $form_nom; ?>" />
			<br />
			
			<label for="score">Ton meilleur score:</label>
			<input type="text" id="score" name="score" value="<?php if (isset($form_score)) echo $form_score; ?>" />
			<br />
			
			<label for="pays">Pays:</label>
    		<select name="pays" id="pays">
    			<option value="0">Sélectionner un pays...</option>
    			<?php
    				//Connexion à la BD
					$cnx = bd_connexion();
					
					//Préparation de la requête
					$requete = "SELECT * FROM pays";
							
					//Exécution de la requête
					$res = bd_requete($cnx, $requete);
					
					//Fermeture de la connexion
					bd_ferme($cnx);
					
					//Si un résultat a été trouvé
					if(mysqli_num_rows($res)){
						while($pays = mysqli_fetch_assoc($res)){
    					$valeur = $pays['id'];
						$nom = $pays['nom'];
						if(isset($form_pays) and $form_pays == $valeur){
							echo '<option selected=selected value=' . $valeur . '>' . $nom . '</option>';	
						}else{
							echo '<option value=' . $valeur . '>' . $nom . '</option>';
						}
    					
						}	
					}
    			?>
    		</select><a href="pays-ajouter.php"> Ajouter un pays</a>
    		<br/>
			
			<label for="screenshot">Screen shot:</label>    		
    		<input type="file" id="screenshot" name="screenshot" />
    		<br/>
    		
    		
    		<p>Note : Le screenshot doit être au format jpeg, png ou gif et ne doit pas dépasser les 20 Mo !</p>
    		    	
			<input type="submit" value="Go Go Go !" name="submit" />
		</form>		
	</body>
</html>