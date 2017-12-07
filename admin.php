<?php
session_start();

// Connexion à la BDD

include('bdd.php');


if( !isset($_SESSION['id_user']))
{
	header('Location:bienvenue.php');
} 
else
{




?>


<!DOCTYPE html>
<html>
	<head>
	  	<meta charset="utf-8" />
	  	<title>ADMIN : DASHBOARD</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body id="maldives">
			
		<nav class="navbar navbar-expand-lg navbar-light">
		
	  	
		  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  	</button>

		  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    	<ul class="navbar-nav">

		    		<?php if (isset($_SESSION['login'])) : ?>
					
					<li class="nav-item">
						<a class="navbar-brand" href="#">Salut : <?php echo $_COOKIE['login']?></a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="destroy.php" style="color: #D8CDCB;">Déconnexion</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="index1.php" style="color: #D8CDCB;">Accèder aux blogs</a>
					</li>

					<?php endif; ?>
					
				</ul>
		  	</div>
		</nav>


		<div class="container formulaire">	
			

<!-- Rédaction des articles -->

	    	<form class="alert" action="admin_post.php" method="post">


<!-- Récupération du login dans un input masqué -->	

		    	<input type="hidden" name="login" value="<?php echo $_SESSION['login']; ?>">

		    	<h2>REDIGER UN ARTICLE</h2>


		      	<div class="form-group">  
		       	 	<label for="title">Titre de l'article</label><br />
		        	<textarea class="form-control" type="text" name="title" id="title" rows="1" /></textarea>
		        	
				</div>
				<div class="form-group">  
		       	 	<label for="content">Contenu de l'article</label><br />
		        	<textarea class="form-control" type="text" name="content" id="content" rows="3" /></textarea>
				</div>

				<div class="form-group">  
		       	 	<label for="categorie">A quelle catégorie appartient votre article ?</label><br />
		 		
			 		 <div>
						<input type= "radio" name="categorie_id" value="1"> Catégorie 1
						<input type= "radio" name="categorie_id" value="2"> Catégorie 2
						<input type= "radio" name="categorie_id" value="3"> Catégorie 3
					</div>
				</div>	
	       
		      	<button type="submit" class="btn btn-dark">Publier</button>

		    </form>

			<h3 class="text-center">Vos derniers billets publiés</h3>
			</br>
			
			<?php

// Récupération des 10 derniers messages
			$reponse = $bdd->query('SELECT title, content FROM posts ORDER BY ID DESC LIMIT 0, 10');


// Affichage de chaque message

			while ($data = $reponse->fetch())
			{
				echo 'Le :' . htmlspecialchars($data['date_creation']) . '<h4>' . htmlspecialchars($data['title']) . ' </h4></br><p> ' . htmlspecialchars($data['content']) . '</p></br>';
			}
	
// Fin de la boucle des messages, on libère le curseur

			$reponse->closeCursor();

			?>

	

		</div>
<!-- Catégorie > 1 id pour chaque catégorie. Ici 3 cat
Category_id 1, 2 ou 3-->
	</body>
</html>		

<?php

}

?>
