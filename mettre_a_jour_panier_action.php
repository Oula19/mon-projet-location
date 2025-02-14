<?php
session_start();
include('db_connection.php');



if (isset($_POST['panier_id']) && isset($_POST['quantite'])) {
    $panier_id = $_POST['panier_id'];
    $quantite = $_POST['quantite'];
    $utilisateur_id = $_SESSION['user_id'];

    
    $query = "UPDATE panier SET quantite = ? WHERE id = ? AND utilisateurs_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "iii", $quantite, $panier_id, $utilisateur_id);
    mysqli_stmt_execute($stmt);

    
    header("Location: panier.php");
    exit();
}
?>
