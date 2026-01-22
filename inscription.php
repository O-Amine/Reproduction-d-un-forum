<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include("haut.php"); ?>

<div class="container">
    <div class="center-content">
        <h1>Bienvenue sur la page d'inscription</h1>
    </div>

    <form action="ajout_membre.php" method="POST">
        
        <?php
        if(isset($_SESSION['erreur'])) {
            echo '<div style="color:red; background:#ffe6e6; padding:10px; border-radius:5px; margin-bottom:15px; text-align:center;">';
            
            if($_SESSION['erreur'] == 'mots_de_passe_differents') {
                echo "Les deux mots de passe sont différents.";
            }
            elseif($_SESSION['erreur'] == 'identifiant_deja_existant') {
                echo "Cet identifiant existe déjà.";
            } 
            else {
                echo htmlspecialchars($_SESSION['erreur']);
            }
            
            echo '</div>';
            unset($_SESSION['erreur']);
        }
        ?>

        <label for="nom">Votre nom :</label>
        <input type="text" name="nom" id="nom" required>

        <label for="prenom">Votre prénom :</label>
        <input type="text" name="prenom" id="prenom" required>

        <label for="identifiant">Votre identifiant :</label>
        <input type="text" name="identifiant" id="identifiant" required>

        <label for="mot_de_passe">Votre mot de passe :</label>
        <div class="password-wrapper">
            <input type="password" name="mot_de_passe" id="mot_de_passe" required>
            <img src="assets/img/eye-close.png" class="password-toggle-icon" onclick="togglePassword('mot_de_passe', this)" alt="Afficher mot de passe">
        </div>

        <label for="mot_de_passe_confirm">Confirmez votre mot de passe :</label>
        <div class="password-wrapper">
            <input type="password" name="mot_de_passe_confirm" id="mot_de_passe_confirm" required>
            <img src="assets/img/eye-close.png" class="password-toggle-icon" onclick="togglePassword('mot_de_passe_confirm', this)" alt="Afficher mot de passe">
        </div>

        <label for="departement">Dans quel département habitez-vous ?</label>
        <select name="departement" id="departement" required>
            <option value="91">Essonne</option>
            <option value="92">Hauts-de-Seine</option>
            <option value="75">Paris</option>
            <option value="93">Saint-Denis</option>
            <option value="77">Seine-et-Marne</option>
            <option value="94" selected>Val-de-Marne</option>
            <option value="95">Val-d'Oise</option>
            <option value="78">Yvelines</option>          
        </select>

        <input type="submit" name="valider" value="S'inscrire">
    </form>
</div>

<script>
function togglePassword(inputId, icon) {
    var input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
        icon.src = "assets/img/eye-open.png";
    } else {
        input.type = "password";
        icon.src = "assets/img/eye-close.png";
    }
}
</script>

<?php include("bas.php"); ?>
</body>
</html>