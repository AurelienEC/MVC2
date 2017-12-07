<div class="container-fluid">
	<nav class="navbar navbar-expand-lg navbar-light">
		
	  	<a class="navbar-brand" href="#">BLOG</a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  	</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav">

	    		<?php if (isset($_SESSION['id'])) : ?>
				<li class="nav-item active">
					<a class="nav-link" href="compte.php" style="color: #D8CDCB;">Compte<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="deconnexion.php" style="color: #D8CDCB;">Déconnexion</a>
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