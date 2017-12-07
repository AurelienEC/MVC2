<div class="container-fluid">
	<nav class="navbar navbar-expand-lg navbar-light">

		<a class="navbar-brand" href="#">Salut : <?php echo $_COOKIE['login']?></a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav">
	    	
				<?php if (isset($_COOKIE['login'])) : ?>
				
				<li class="nav-item">
					<a class="nav-link" href="destroy.php">Déconnexion</a>
				</li>

				<?php else : ?>

				<li class="nav-item">
					<a class="nav-link" href="inscription.php">Inscription</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="connexion.php">Connexion</a>
				</li>

				<?php endif; ?>	
				
			</ul>
	  	</div>
	</nav>