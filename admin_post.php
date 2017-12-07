<?php
session_start();


// Connexion à la BDD

include('bdd.php');


// Insertion du message à l'aide d'une requête préparée

$req = $bdd->prepare('INSERT INTO posts (title, content) VALUES(?, ?)');
$req->execute(array($_POST['title'], $_POST['content']));

// Redirection
header('Location: admin.php');
?>