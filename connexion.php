<?php
session_start();
include('ouverture_bdd.php');

$identifiant = $_POST['identifiant'];
$mdp_saisi = $_POST['mot_de_passe'];

$req = $bdd->prepare('SELECT * FROM membres WHERE identifiant = :identifiant');
$req->execute(array('identifiant' => $identifiant));
$membre = $req->fetch();

if ($membre && password_verify($mdp_saisi, $membre['mot_de_passe'])) {
    $_SESSION['id'] = $membre['id'];
    $_SESSION['nom'] = $membre['nom'];
    $_SESSION['prenom'] = $membre['prenom'];
    $_SESSION['identifiant'] = $membre['identifiant'];
    
    header('location: index.php');
} else {
    $_SESSION['erreur'] = 'login_fail';
    header('location: index_connexion.php');
}
?>