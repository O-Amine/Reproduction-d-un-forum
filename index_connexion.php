<?php include("haut.php"); ?>

<div class="container">
    <div class="center-content">
        <h1>Connexion</h1>
    </div>

    <form action="connexion.php" method="POST">
        <?php
        if(isset($_SESSION['erreur']) && $_SESSION['erreur'] == 'login_fail') {
            echo '<div style="color:red; margin-bottom:10px;">Identifiant ou mot de passe incorrect.</div>';
            unset($_SESSION['erreur']);
        }
        ?>
        <label for="identifiant">Identifiant :</label>
        <input type="text" name="identifiant" required>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" required>

        <input type="submit" value="Se connecter">
    </form>
    
    <div class="center-content">
        <p>Pas encore de compte ? <a href="inscription.php">S'inscrire ici</a></p>
    </div>
</div>

<?php include("bas.php"); ?>