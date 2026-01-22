<?php
$serveur = "localhost";
$user = "root";
$pass = "";
$dbname = "bdd_projet_forum";

try {
    $bdd_root = new PDO("mysql:host=$serveur", $user, $pass);
    $bdd_root->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd_root->exec("CREATE DATABASE IF NOT EXISTS $dbname DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
    
    $bdd = new PDO("mysql:host=$serveur;dbname=$dbname;charset=utf8", $user, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $bdd->exec("CREATE TABLE IF NOT EXISTS membres(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(100),
        prenom VARCHAR(100),
        identifiant VARCHAR(100) UNIQUE,
        mot_de_passe VARCHAR(255),
        departement VARCHAR(100),
        date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $bdd->exec("CREATE TABLE IF NOT EXISTS billets(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        pseudo VARCHAR(100),
        titre VARCHAR(255),
        contenu TEXT,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $bdd->exec("CREATE TABLE IF NOT EXISTS commentaires(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_billet INT UNSIGNED,
        auteur VARCHAR(100),
        commentaire TEXT,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_billet) REFERENCES billets(id) ON DELETE CASCADE
    )");

} catch(PDOException $e) {
    die('Erreur critique : ' . $e->getMessage());
}
?>