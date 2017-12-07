<?php
session_start();

// Connexion à la BDD

include('bdd.php');


setcookie('login', $_POST['login'], time() + 365*24*3600, null, null, false, true);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>BIENVENUE</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body id="desert">

	<?php if (isset($_SESSION['login'])) : ?>
	<nav class="navbar navbar-expand-lg navbar-light">
	  	
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  	</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav">
				
				<li class="nav-item">
					<a class="navbar-brand" href="#">Salut <?php echo $_SESSION['login']?></a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="admin.php" style="color: #D8CDCB;">Accès à mon dashboard</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="destroy.php" style="color: #D8CDCB;">Déconnexion</a>
				</li>
			
			</ul>
	  	</div>
	</nav>
	<?php else : ?>
	<?php endif; ?>
	
	<div class="container" id="container_middle">

		<div class="row">
			<h1 class="col-md-12 text-center bienvenue">BIENVENUE</h1>
		</div>

		<div class="row">
			<div class="col-md-12 text-center flex">	
		    	<a href="inscription.php" role="button"><button type="submit" name="submit" class="btn btn-dark">S'inscrire</button></a>
		   
		    	<a href="connexion.php" role="button"><button type="submit" name="submit" class="btn btn-dark">Se connecter</button></a>
			</div>		
		</div>
	</div>	


<?php include('footer.php'); ?>
  