<?php
include('connect.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    
    $query = "UPDATE utilisateurs SET is_confirmed = 1 WHERE token = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $token);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<p>Votre compte a été confirmé avec succès. <a href='connexion.php'>Connectez-vous</a></p>";
    } else {
        echo "<p>Token invalide ou déjà utilisé.</p>";
    }
} else {
    echo "<p>Token manquant.</p>";
}
?>
