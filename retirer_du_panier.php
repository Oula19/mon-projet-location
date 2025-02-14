<?php

session_start();


if (isset($_GET['id'])) {
    $id_voiture = $_GET['id'];

    
    if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
       
        foreach ($_SESSION['panier'] as $key => $item) {
            if ($item['id'] == $id_voiture) {
                unset($_SESSION['panier'][$key]);
                break;
            }
        }

        
        $_SESSION['panier'] = array_values($_SESSION['panier']);
    }
}


header('Location: panier.php');
exit();
?>
