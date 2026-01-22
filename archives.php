<?php include("haut.php"); include("ouverture_bdd.php"); ?>

<div class="container">
    <h1>Archives des tickets</h1>

    <?php
    $elements_par_page = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    
    $debut = ($page - 1) * $elements_par_page;

    $req = $bdd->prepare('SELECT id, pseudo, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%i") AS date_fr FROM billets ORDER BY id DESC LIMIT :debut, :limit');
    $req->bindParam(':debut', $debut, PDO::PARAM_INT);
    $req->bindParam(':limit', $elements_par_page, PDO::PARAM_INT);
    $req->execute();

    while ($donnees = $req->fetch()) {
    ?>
        <div class="ticket-card">
            <div class="ticket-header">
                <strong><?php echo htmlspecialchars($donnees['titre']); ?></strong>
                <span><?php echo $donnees['date_fr']; ?> | <?php echo htmlspecialchars($donnees['pseudo']); ?></span>
            </div>
            <div class="ticket-body">
                <?php 
                $contenu = htmlspecialchars($donnees['contenu']);
                if (strlen($contenu) > 200) {
                    echo nl2br(substr($contenu, 0, 200)) . '...';
                } else {
                    echo nl2br($contenu);
                }
                ?>
            </div>
            <div class="ticket-footer">
                <a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Lire la suite & Commenter</a>
            </div>
        </div>
    <?php
    }
    $req->closeCursor();

    $total_billets = $bdd->query('SELECT COUNT(*) FROM billets')->fetchColumn();
    $total_pages = ceil($total_billets / $elements_par_page);
    ?>

    <div class="pagination">
        <?php for($i=1; $i<=$total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>
</div>

<?php include("bas.php"); ?>