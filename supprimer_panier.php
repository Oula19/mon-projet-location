<?php
session_start();
include('db_connection.php'); 



if (isset($_GET['id'])) {
    $panier_id = $_GET['id'];
    $utilisateur_id = $_SESSION['user_id'];

    $query = "DELETE FROM panier WHERE id = ? AND utilisateurs_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ii", $panier_id, $utilisateur_id);
    mysqli_stmt_execute($stmt);

    header("Location: panier.php");
    exit();
}
?>
