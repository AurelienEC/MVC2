<?php
/*

membre :
id
login
email
pass

*/

// Connexion à la base de données OC_blog_decembre_1.1
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=OC_blog_decembre_1.1;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

?>