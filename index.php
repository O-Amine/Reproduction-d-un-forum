<?php include('haut.php'); ?>

<div class="container">
    <div class="center-content">
        <h1>Bienvenue sur le Forum</h1>
        <p><a href="tuto.php" class="btn">Voir le tutoriel</a></p>
    </div>

    <h2>Nouveau Ticket</h2>
    <form action="ajout_billet.php" method="POST">
        <?php if(isset($_SESSION['identifiant'])): ?>
            <input type="hidden" name="pseudo" value="<?php echo htmlspecialchars($_SESSION['identifiant']); ?>">
            <p>Auteur : <strong><?php echo htmlspecialchars($_SESSION['identifiant']); ?></strong></p>
        <?php else: ?>
            <label for="pseudo">Votre pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" required>
        <?php endif; ?>

        <label for="titre">Titre du sujet :</label>
        <input type="text" name="titre" id="titre" required>

        <label for="contenu">Message :</label>
        <textarea name="contenu" id="contenu" rows="5" required></textarea>

        <input type="submit" value="Publier le ticket">
    </form>
    
    <form action="supprimer_billets.php" method="POST" onsubmit="return confirm('Vraiment tout supprimer ?');">
        <input type="submit" name="supprimer" value="Réinitialiser tous les billets" class="btn-danger">
    </form>
</div>

<div class="container">
    <h2>Derniers Billets</h2>
    <?php
    include('ouverture_bdd.php');
    $reponse = $bdd->query('SELECT id, pseudo, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%i") AS date_fr FROM billets ORDER BY id DESC LIMIT 0, 5');
    
    while ($donnees = $reponse->fetch()) {
    ?>
        <div class="ticket-card">
            <div class="ticket-header">
                <span><strong><?php echo htmlspecialchars($donnees['titre']); ?></strong></span>
                <small>Par <?php echo htmlspecialchars($donnees['pseudo']); ?> le <?php echo $donnees['date_fr']; ?></small>
            </div>
            <div class="ticket-body">
                <?php echo nl2br(htmlspecialchars($donnees['contenu'])); ?>
            </div>
            <div class="ticket-footer">
                <a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Voir les commentaires ➜</a>
            </div>
        </div>
    <?php
    }
    $reponse->closeCursor();
    ?>
    <div style="text-align: center; margin-top: 10px;">
        <a href="archives.php">Voir toutes les archives</a>
    </div>
</div>

<?php include('bas.php'); ?>