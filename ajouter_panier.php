<?php
session_start();
include 'connect.php';

if (isset($_GET['id'])) {
    $id_voiture = $_GET['id'];
    $query = "SELECT * FROM voiture WHERE id = $id_voiture";
    $result = mysqli_query($con, $query);
    $voiture = mysqli_fetch_assoc($result);

    if ($voiture) {
       
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        
        $found = false;
        foreach ($_SESSION['panier'] as &$item) {
            if ($item['id'] == $voiture['id']) {
                $item['quantite'] += 1; 
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['panier'][] = [
                'id' => $voiture['id'],
                'nom' => $voiture['serie'],
                'prix' => $voiture['prix'],
                'quantite' => 1,
                'image' => $voiture['image']
            ];
        }
    }

    header('Location: panier.php');
    exit();
}
?>
