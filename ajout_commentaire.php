<?php
session_start();
include('ouverture_bdd.php');

if (isset($_POST['id_billet'], $_POST['commentaire'])) {
    $auteur = $_POST['auteur'] ?? ($_SESSION['identifiant'] ?? 'Anonyme');
    
    $req = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire) VALUES(:id_billet, :auteur, :commentaire)');
    $req->execute(array(
        'id_billet' => $_POST['id_billet'],
        'auteur' => $auteur,
        'commentaire' => $_POST['commentaire']
    ));
    header('Location: commentaires.php?billet=' . $_POST['id_billet']);
} else {
    header('Location: index.php');
}
?>