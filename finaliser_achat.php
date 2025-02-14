<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: connexion.php');
    exit;
}


echo "<h2>Résumé de votre commande</h2>";


if (!empty($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $id_voiture => $quantite) {
        $voiture = getVoitureById($id_voiture);
        echo "<p>" . $voiture['nom'] . " - Quantité: " . $quantite . "</p>";
    }
}
?>
