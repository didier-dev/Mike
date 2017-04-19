<?php

	// CONNEXION BDD
	$pdo = new PDO('mysql:host=localhost;dbname=Mike', 'root', '', array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
	));

	// Requete SQL
	$resultat = $pdo->prepare("SHOW DATABASES");
	$resultat->execute();

	// Trie de la requete
	$dataBase = $resultat->fetchall(PDO::FETCH_ASSOC);

?>

<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body>
		<div id="mike">
			<form>
				<fieldset>
					<legend>Requete</legend>

					<label>Bdd :</label>			
					<select id="databaseSelect">
						<?php
						foreach($dataBase as $value)
							echo "<option value='" . $value['Database'] . "'>".$value['Database'] . "</option>";
						?>
					</select><br/><br/>

					<textarea name="sql" id="sql" rows="4" cols="50">SELECT * FROM utilisateurs</textarea>
					<br/>
					<input type="submit" value="Envoyez" />
				</fieldset>
			</form>
		</div>
		<script>
			$(function() {
				$( "input" ).click(function(e) {

					// Annulation de l'actualisation de la page'
					e.preventDefault();


					// Console du meillieur Prenom au monde. PS: Mike > Vincent
					console.log("Mike")
					
					// Récuperation de la valeur de notre textarea.
					var myRequest = $("#sql").val(); 

					var dataBase = $("#databaseSelect").val();

					// Requete Ajax - Envoi des information du formulaire vers un autre page de traitement.
					var request = $.ajax({
						url: "read2.php", // Page de la requete
						method: "POST", // Methode de la requete
						data: {requet : myRequest, Mike: dataBase} // Data envoyer à la page
					});
					
					request.done(function( msg ) {
						$( "#mike" ).html( msg );
						$( "#requet" ).html( myRequest );					
					});
					
					request.fail(function( jqXHR, textStatus ) {
						alert( "Request failed: " + textStatus );
					});
				});
			});
		</script>
	<body>
<html>