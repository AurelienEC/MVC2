<?php
session_start();


// Connexion à la BDD

include('bdd.php');


// Insertion du message à l'aide d'une requête préparée

$req = $bdd->prepare('INSERT INTO billets (titre, contenu) VALUES(?, ?)');
$req->execute(array($_POST['titre'], $_POST['contenu']));

// Redirection
header('Location: admin.php');
?>