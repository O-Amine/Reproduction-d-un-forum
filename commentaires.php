<?php 
include('haut.php'); 
include('ouverture_bdd.php');

if(!isset($_GET['billet'])) {
    echo '<div class="container"><p>Erreur : Aucun billet sélectionné.</p></div>';
    include('bas.php');
    exit();
}

$req = $bdd->prepare('SELECT id, pseudo, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%i") AS date_fr FROM billets WHERE id = ?');
$req->execute(array($_GET['billet']));
$billet = $req->fetch();
?>

<div class="container">
    <?php if($billet): ?>
        <p><a href="index.php">⬅ Retour à l'accueil</a></p>
        
        <div class="ticket-card" style="border: 2px solid #3498db;">
            <div class="ticket-header" style="background: #3498db;">
                <h1><?php echo htmlspecialchars($billet['titre']); ?></h1>
                <span>Par <?php echo htmlspecialchars($billet['pseudo']); ?> le <?php echo $billet['date_fr']; ?></span>
            </div>
            <div class="ticket-body" style="background: #fff; font-size: 1.1em;">
                <?php echo nl2br(htmlspecialchars($billet['contenu'])); ?>
            </div>
        </div>

        <hr style="margin: 30px 0;">

        <h3>Commentaires</h3>
        <?php
        $req->closeCursor();
        $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%i") AS date_fr FROM commentaires WHERE id_billet = ? ORDER BY date_creation');
        $req->execute(array($_GET['billet']));

        while($com = $req->fetch()) {
        ?>
            <div style="background: #f1f1f1; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
                <strong><?php echo htmlspecialchars($com['auteur']); ?></strong> 
                <small>(<?php echo $com['date_fr']; ?>)</small>
                <p style="margin-top: 5px;"><?php echo nl2br(htmlspecialchars($com['commentaire'])); ?></p>
            </div>
        <?php } $req->closeCursor(); ?>

        <hr>
        <h3>Répondre</h3>
        <form action="ajout_commentaire.php" method="POST">
            <input type="hidden" name="id_billet" value="<?php echo $billet['id']; ?>">
            
            <?php if(isset($_SESSION['identifiant'])): ?>
                <input type="hidden" name="auteur" value="<?php echo htmlspecialchars($_SESSION['identifiant']); ?>">
                <p>Répondre en tant que : <strong><?php echo htmlspecialchars($_SESSION['identifiant']); ?></strong></p>
            <?php else: ?>
                <label>Pseudo :</label>
                <input type="text" name="auteur" required>
            <?php endif; ?>

            <label>Message :</label>
            <textarea name="commentaire" rows="4" required></textarea>
            <input type="submit" value="Envoyer">
        </form>

    <?php else: ?>
        <p>Ce billet n'existe pas.</p>
    <?php endif; ?>
</div>

<?php include('bas.php'); ?>