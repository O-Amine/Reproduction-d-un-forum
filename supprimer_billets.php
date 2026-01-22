<?php
session_start();
if (isset($_POST['supprimer'])) {
    include('ouverture_bdd.php');
    
    $bdd->exec("DELETE FROM billets"); 
    
    $bdd->exec("ALTER TABLE billets AUTO_INCREMENT = 1");
}
header('Location: index.php');
?>