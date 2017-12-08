<?php
session_start();


// Connexion à la BDD

include('bdd.php');


// Insertion du message à l'aide d'une requête préparée

$req = $bdd->prepare('INSERT INTO commentaires (commentaire, auteur, id_billet) VALUES(?, ?, ?)');
$req->execute(array($_POST['commentaire'], $_POST['auteur'], $_POST['id_billet']));

// Redirection
header('Location: commentaires.php?billet='. $_POST['id_billet']);
?>