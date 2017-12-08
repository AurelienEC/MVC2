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
			        <?= htmlspecialchars($data['title']) ?>
			        <em>le <?= $post['created_at_fr'] ?></em>
			    </h3>
			    
			    <p>
			    <?= nl2br(htmlspecialchars($post['content']))
			    ?>
			    </p>
			</div>


<!-- Récupération du login dans un input masqué -->	

	    	<input type="hidden" name="login" value="<?= $_SESSION['login'] ?>">

	    	<h3 class="text-center">Les commentaires associés à ce billet</h3>


			<div class="row">
				<div class="container admin">
					<div class="card-columns">
		

						<?php

// Affichage de chaque message

						while ($comment = $comments->fetch())
						{
							echo '<div class="card p-3">
										<blockquote class="card-block card-blockquote">
											<p>' . htmlspecialchars($comment['author']) . ' : ' . htmlspecialchars($comment['comment_date_fr']) . '
											</p>
											<footer>
												<small class="text-muted">Commentaire de <cite title="Source Title">' . htmlspecialchars($comment['comment']) . '</cite></small>
										        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>
										        </p>
										    </footer>
										</blockquote>
									</div>';	
						}

						?>				
					</div>
				</div>
			</div>
		</div>



		<div class="container admin">
	    	<h2>REDIGER UN COMMENTAIRE</h2>



	    	<form class="alert" action="commentaires_post.php" method="post">
	    	<!-- <form class="alert" action="commentaires_post.php" method="post"> -->
	    		<input type="hidden" name="id" value="<?= $comment['id']; ?>" />
		      	<div class="form-group">  
		       	 	<label for="commentaire">Commentaire</label><br />
		        	<textarea class="form-control" type="text" name="comment" id="comment" rows="1" /></textarea>
		        	
				</div>
				<div class="form-group">  
		       	 	<label for="content">Auteur</label><br />
		        	<textarea class="form-control" type="text" name="author" id="author" rows="3" /></textarea>
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

