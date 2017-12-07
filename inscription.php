<?php
 session_start();
// Vérifier si le membre n'est pas déjà présent dans la bdd

// Création de cookies
setcookie('login', $_POST['login'], time() + 365*24*3600, null, null, false, true);
setcookie('auteur', $_POST['login'], time() + 365*24*3600, null, null, false, true);
setcookie('editeur', $_POST['login'], time() + 365*24*3600, null, null, false, true);

// Voir modèle Tests_novembre/BLOG_8_11_2017/ 

// Connexion à la BDD

 include('bdd.php');


  // Si le bouton "Inscription" est cliqué ...

 if(isset($_POST['submit']))
{

// Vérification de la validité des informations

	if(!empty($_POST))
	{
		$errors = array(); 

// Si une des 2 conditions n'est pas validée, il y aura l'erreur

		if(empty($_POST['login']) || !preg_match('#^[a-zA-Z0-9_]+$#', $_POST['login']))
		{
			$errors['login'] = "Pseudo invalide";
		}	

// Validation de l'email

		if(empty($_POST['email']) || !preg_match('#^[a-z0-9-_.]+@[a-z0-9-_.]{2,}\.[a-z]{2,4}$#', $_POST['email']))
		{
			$errors['email'] = "Email invalide";
		}

// Validation du mot de pass et comparaison des 2 mots de passe

		if(empty($_POST['pass']) || $_POST['pass'] != $_POST['pass_confirm'])	
		{
			$errors['pass'] = "Votre mot de passe est invalide";
		}

// Si tout est OK ...

		if(empty($errors))
		{

// Hachage du mot de passe

			$pass_hache = sha1('gz' . $_POST['pass']);

// Vérification de la validité des informations
			if (isset($_POST['login']) AND isset($_POST['pass']) AND isset($_POST['email']))
				{
					$login = $_POST['login'];
					$pass = $_POST['pass'];
					$mail = $_POST['email'];		
				}

// Insertion du message à l'aide d'une requête préparée

				$req = $bdd->prepare('INSERT INTO membre (login, pass, email) VALUES(?, ?, ?)');
				$req->execute(array(
					$_POST['login'],
					$_POST['pass'] = $pass_hache,
					$_POST['email']
				));

// Redirection du visiteur vers la page de connexion
				header('Location: connexion.php');


		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>INSCRIPTION</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body id="agriculture">

	<nav class="navbar navbar-expand-lg navbar-light">
		  	
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  	</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav">

	    		<?php if (isset($_SESSION['login'])) : ?>
				
				<li class="nav-item">
					<a class="navbar-brand" href="#">Salut <?php echo $_SESSION['login']?></a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="admin.php" style="color: #D8CDCB;">Tu es déjà inscrit</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="destroy.php" style="color: #D8CDCB;">Déconnexion</a>
				</li>


				<?php else : ?>

				<li class="nav-item">
					<a class="nav-link" href="inscription.php" style="color: #D8CDCB;">Inscription</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="connexion.php" style="color: #D8CDCB;">Connexion</a>
				</li>

				<?php endif; ?>
				
			</ul>
	  	</div>
	</nav>



	<div class="container">

		
		<div class="row">
		
			<div class="formulaire">

				<!-- En laissant vide l'action, les données s'enregistrent dans la base -->
				<form class="alert" method="post" action=""> 
					<!-- <form class="alert" method="post" action="inscription_post.php"> -->
				    <div class="form-group">
				       
<!-- Pseudo -->
				      	<input class="form-control text-center" type="login" id="login" placeholder="Entrez votre pseudo" name="login" value="<?php if(isset($login)) echo $login; ?>"/><br />
				      	<?php
				      		if(isset($errors['login']))
				      		{
				      			echo '<p class="alert alert-danger">Votre pseudo n\'est pas valide</p>';
				      		}
						?>

<!-- Pass -->
				      	<input class="form-control text-center" type="password" id="pass" placeholder="Entrez votre mot de passe" name="pass" value="<?php if(isset($pass)) echo $pass; ?>" "/><br />
				      	<?php
				      		if(isset($errors['pass']))
				      		{
				      			echo '<p class="alert alert-danger">Veuillez entrez votre mot de passe</p>';

				      		}
						?>

<!-- Pass_confirm -->
				      	<input class="form-control text-center" type="password" id="pass_confirm" placeholder="Veuillez confirmez votre mot de passe" name="pass_confirm" value="<?php if(isset($pass_confirm)) echo $pass_confirm; ?>" /><br />
				      	<?php
				      		if(isset($errors['pass_confirm']))
				      		{
								echo '<p class="alert alert-danger">Vos mots de passe ne sont pas identique</p>';
				      		}
				      	?>	

<!-- Email -->
				      	<input id="email" class="form-control text-center" name="email" type="text" placeholder="Veuillez entrer votre email" value="<?php if(isset($email)) echo $email; ?>" ></br>
						<?php
				      		if(isset($errors['email']))
					      		{
									echo '<p class="alert alert-danger">Votre email n\'est pas valide</p>';
					      		}
				     	?>

				    </div>

				    <div class="flex">
				    	
					  	<ul class="pagination">
					    	<li class="page-item">
					      		<a class="page-link" href="bienvenue.php" aria-label="Previous">
						        	<span aria-hidden="true">&laquo;</span>
						        	<span class="sr-only">Previous</span>
					      		</a>
					    	</li>
					   
					  	</ul>
						
									       
				    	<a href="connexion.php" role="button">
				    		<button type="submit" name="submit" class="btn btn-dark">S'inscrire</button>
				    	</a>
				 
				    
	
					</div>

				</form>

			</div>	
		</div>
	
	</div>

	

<?php include('footer.php'); ?>