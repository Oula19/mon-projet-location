<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if (isset($_GET['id_voiture'])) {
    $id_voiture = $_GET['id_voiture'];

    
    if (isset($_SESSION['panier'][$id_voiture])) {
        
        $_SESSION['panier'][$id_voiture]++;
    } else {
    
        $_SESSION['panier'][$id_voiture] = 1;
    }
}


header('Location: panier.php');
exit;
?>
