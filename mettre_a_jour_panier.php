<?php
session_start();
include('db_connection.php'); 



if (isset($_GET['id'])) {
    $panier_id = $_GET['id'];
    $utilisateur_id = $_SESSION['user_id'];

   
    $query = "SELECT * FROM panier WHERE id = ? AND utilisateurs_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ii", $panier_id, $utilisateur_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
       
        echo "<form action='mettre_a_jour_panier_action.php' method='POST'>
                <input type='hidden' name='panier_id' value='{$row['id']}'>
                <input type='number' name='quantite' value='{$row['quantite']}' min='1'>
                <button type='submit'>Mettre à jour</button>
              </form>";
    }
}
?>
