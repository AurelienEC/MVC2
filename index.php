<?php
session_start();


// Connexion à la BDD

include('bdd.php');


// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT id, titre, contenu, date_creation FROM billets ORDER BY ID DESC LIMIT 0, 10');


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>BILLETS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body id="new-york">
	<div class="container-fluid">

		<?php include('header.php'); ?>
		
	</div>

	<div class="container-fluid blog"> <!-- Ouverture du contairer -->
		<div class="row">
			<div class="col-md-3">
				<div id="logo"></div>
				<p>Articles</p>
				<p>Catégorie 1</p>
				<p>Catégorie 2</p>
				<p>Catégorie 3</p>
			</div>

			<div class="col-md-9">

				<?php

	// Affichage de chacun des billets

				while ($donnees = $reponse->fetch())
				{
				?>
				<div class="news">
					
					<h3><?php echo 'Le : ' . htmlspecialchars($donnees['date_creation']) . ' ' . htmlspecialchars($donnees['titre']) ?></h3>
				</div>

				<?php
				?> 

				<div class="news">		
				
					<p>
						<?php
						echo nl2br(htmlspecialchars($donnees['contenu']))
						?>
						 <br /><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></p>

				</div>

			<?php
			  }

	//Termine le traitement des requêtes
			  $req->closeCursor();

			?>
			
			</div>

		</div>		
	</div>

<?php include('footer.php'); ?>
  