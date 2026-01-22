<?php
session_start();
include('ouverture_bdd.php');

$mdp = $_POST['mot_de_passe'];
$mdp_confirm = $_POST['mot_de_passe_confirm'];
$identifiant = $_POST['identifiant'];

if($mdp != $mdp_confirm) {
    $_SESSION['erreur'] = 'Les mots de passe sont différents.';
    header('location: inscription.php');
    exit();
}

$check = $bdd->prepare("SELECT id FROM membres WHERE identifiant = ?");
$check->execute(array($identifiant));

if($check->rowCount() > 0) {
    $_SESSION['erreur'] = 'Cet identifiant est déjà pris.';
    header('location: inscription.php');
    exit();
}

$mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

$req = $bdd->prepare('INSERT INTO membres(nom, prenom, identifiant, mot_de_passe, departement) 
                      VALUES (:nom, :prenom, :identifiant, :mdp, :dept)');
$req->execute(array(
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'identifiant' => $identifiant,
    'mdp' => $mdp_hash,
    'dept' => $_POST['departement']
));

$_SESSION['identifiant'] = $identifiant;
$_SESSION['prenom'] = $_POST['prenom'];
header('Location: index.php');
?>