<?php
session_start();

// Connexion à la BDD

include('bdd.php');

// Récupération du dernier billet

$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
$req->execute(array($_GET['billet']));
$donnees = $req->fetch();

?>


<!DOCTYPE html>
<html>
	<head>
	  	<meta charset="utf-8" />
	  	<title>Billets et commentaires associés</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body id="taxi-cab">
			
		<?php include('header.php'); ?>

		<div class="container admin">

			<div class="news">
			    <h3>
			        <?php echo htmlspecialchars($donnees['titre']); ?>
			        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
			    </h3>
			    
			    <p>
			    <?php
			    echo nl2br(htmlspecialchars($donnees['contenu']));
			    ?>
			    </p>
			</div>


<!-- Récupération du login dans un input masqué -->	

	    	<input type="hidden" name="login" value="<?php echo $_SESSION['login']; ?>">

	    	<h3 class="text-center">Les commentaires associés à ce billet</h3>


			<div class="row">
				<div class="container admin">
					<div class="card-columns">
		

						<?php

// Récupération des 10 derniers messages
						$reponse = $bdd->query('SELECT commentaire, auteur FROM commentaires ORDER BY ID DESC LIMIT 0, 10');
//						$reponse = $bdd->query('SELECT commentaire, auteur FROM commentaires ORDER BY ID DESC LIMIT 0, 10 WHERE id_billet = $_GET['id_billet]);



// Affichage de chaque message

						while ($comment = $reponse->fetch())
						{
							echo '<div class="card p-3">
										<blockquote class="card-block card-blockquote">
											<p>' . htmlspecialchars($comment['commentaire']) . ' : ' . htmlspecialchars($comment['auteur']) . '
											</p>
											<footer>
												<small class="text-muted">Commentaire de <cite title="Source Title">' . htmlspecialchars($comment['auteur']) . '</cite></small>
										        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>
										        </p>
										    </footer>
										</blockquote>
									</div>';	
						}


// Fin de la boucle des messages, on libère le curseur

						$reponse->closeCursor();

						?>				
					</div>
				</div>
			</div>
		</div>



		<div class="container admin">
	    	<h2>REDIGER UN COMMENTAIRE</h2>



	    	<form class="alert" action="commentaires_post.php" method="post">
	    		<input type="hidden" name="id_billet" value="<?= $donnees['id'];?>" />
		      	<div class="form-group">  
		       	 	<label for="commentaire">Commentaire</label><br />
		        	<textarea class="form-control" type="text" name="commentaire" id="commentaire" rows="1" /></textarea>
		        	
				</div>
				<div class="form-group">  
		       	 	<label for="contenu">Auteur</label><br />
		        	<textarea class="form-control" type="text" name="auteur" id="auteur" rows="3" /></textarea>
				</div>

				 <div class="flex">
					<ul class="pagination">
				    	<li class="page-item">
				      		<a class="page-link" href="index1.php" aria-label="Previous">
					        	<span aria-hidden="true">&laquo;</span>
					        	<span class="sr-only">Previous</span>
				      		</a>
				    	</li>
				  	</ul>
		       
			      	<button type="submit" class="btn btn-dark">Commenter</button>
			    </div>  	
		    </form>

		</div>    

	
		
<!-- Catégorie > 1 id pour chaque catégorie. Ici 3 cat
Category_id 1, 2 ou 3-->
	</body>
</html>		

