<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Entraide</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="archives.php">Archives</a></li>
        
        <?php if (isset($_SESSION['identifiant'])): ?>
            <li><a href="menu.php">Profil <?php echo htmlspecialchars($_SESSION['identifiant']); ?></a></li>
            <li><a href="se_deconnecter.php" style="color: #e74c3c;">Se déconnecter</a></li>
        <?php else: ?>
            <li><a href="index_connexion.php">Se connecter</a></li>
            <li><a href="inscription.php">S'inscrire</a></li>
        <?php endif; ?>
    </ul>
</nav>