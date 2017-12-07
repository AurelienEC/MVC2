<?php
session_start();


// Il n'est pas nécessaire que le formulaire pointe vers un dossier inscription_post.php ?

// Connexion à la BDD

include('bdd.php');


 // Si le bouton "Inscription" est cliqué ...

 if(isset($_POST['submit']))
{

// Vérification de la validité des informations

	if(!empty($_POST))
	{
		$errors = array(); 

// Si la condition n'est pas validée, il y aura l'erreur

		if(empty($_POST['login']))
		{
			$errors['login'] = "Renseignez votre pseudo";
		}

// Validation de la présence du mot de pass

		if(empty($_POST['pass']))	
		{
			$errors['pass'] = "Veuillez entrez votre mot de passe";
		}

		if(empty($errors))
		{

// Hachage du mot de pass pour le comparer à celui de la BDD
		$pass_hache = sha1('gz' . $_POST['pass']);


// Vérification des identifiants

		$req = $bdd->prepare('SELECT id, login FROM membre WHERE login = :login AND pass = :pass');
		$req->execute(array(
			'login' => $_POST['login'],
			'pass' => $pass_hache,
		));

// On stocke le résultat de la recherche dans $resultat

		$resultat = $req->fetch();


		$req->closecursor();

		}

		if ($resultat['id'] != "")
		{
			$_SESSION['login']= $resultat['login'];
			$_SESSION['id_user']= $resultat['id'];

			header('Location: admin.php');
		}

// S'il n'y a aucun résultat

		if(!$resultat)	
		{
			echo 'Mauvais identifiant ou mot de passe';
		}		
	
	}			
}
?>
<!DOCTYPE html>
<html>
	<head>
	  	<meta charset="utf-8" />
	  	<title>CONNEXION</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	
	<body id="vintage">

		<div class="container-fluid">

			
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
					<a class="nav-link" href="admin.php" style="color: #D8CDCB;">Vous êtes déjà inscrit</a>
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
			
			
		</div>	

		<div class="container">
			
			<div class="row">
			
				<div class="formulaire">

					<form class="alert" method="post" action="">
					    <div class="form-group">
					       
	<!-- Pseudo -->
					      	<input class="form-control text-center" type="text" id="login" placeholder="Entrez votre pseudo" name="login" value="<?php if(isset($login)) echo $login; ?>" style="width: 90%; margin-left: auto; margin-right: auto;"/><br />
					      	<?php
					      		if(isset($errors['login']))
					      		{
					      			echo '<p class="alert alert-danger">Votre pseudo n\'est pas valide</p>';
					      		}
							?>

	<!-- Pass -->
					      	<input class="form-control text-center" type="password" id="pass" placeholder="Entrez votre mot de passe" name="pass" value="<?php if(isset($pass)) echo $pass; ?>" style="width: 90%; margin-left: auto; margin-right: auto;"/><br />
					      	<?php
					      		if(isset($errors['pass']))
					      		{
					      			echo '<p class="alert alert-danger">Veuillez entrez votre mot de passe</p>';

					      		}
							?>

				      	</div>	      

						<button type="submit" name="submit" class="btn btn-dark">Me connecter</button>
				    </form>

				</div>

			</div>	
				       
		</div>	
		

<?php include('footer.php'); ?>