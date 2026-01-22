<?php
session_start();
include('ouverture_bdd.php');

if (isset($_POST['titre'], $_POST['contenu'])) {
    $pseudo = $_POST['pseudo'] ?? ($_SESSION['identifiant'] ?? 'Anonyme');

    $req = $bdd->prepare('INSERT INTO billets(pseudo, titre, contenu) VALUES(:pseudo, :titre, :contenu)');
    $req->execute(array(
        'pseudo' => $pseudo,
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu']
    ));
}
header('Location: index.php');
?>