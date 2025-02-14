<?php
include('connect.php');
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$query = "SELECT SUM(v.prix * p.quantite) AS total
          FROM paniers p
          JOIN Voiture v ON p.voiture_id = v.id
          WHERE p.user_id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$total = $row['total'];


$query_insert = "INSERT INTO commandes (user_id, total) VALUES (?, ?)";
$stmt_insert = mysqli_prepare($con, $query_insert);
mysqli_stmt_bind_param($stmt_insert, 'id', $user_id, $total);
mysqli_stmt_execute($stmt_insert);

$commande_id = mysqli_insert_id($con);


$query_details = "SELECT voiture_id, quantite, v.prix FROM paniers p
                  JOIN Voiture v ON p.voiture_id = v.id
                  WHERE p.user_id = ?";
$stmt_details = mysqli_prepare($con, $query_details);
mysqli_stmt_bind_param($stmt_details, 'i', $user_id);
mysqli_stmt_execute($stmt_details);
$result_details = mysqli_stmt_get_result($stmt_details);

while ($row_details = mysqli_fetch_assoc($result_details)) {
    $query_details_insert = "INSERT INTO details_commandes (commande_id, voiture_id, quantite, prix) 
                             VALUES (?, ?, ?, ?)";
    $stmt_details_insert = mysqli_prepare($con, $query_details_insert);
    mysqli_stmt_bind_param($stmt_details_insert, 'iiid', $commande_id, $row_details['voiture_id'], $row_details['quantite'], $row_details['prix']);
    mysqli_stmt_execute($stmt_details_insert);
}


$query_delete = "DELETE FROM paniers WHERE user_id = ?";
$stmt_delete = mysqli_prepare($con, $query_delete);
mysqli_stmt_bind_param($stmt_delete, 'i', $user_id);
mysqli_stmt_execute($stmt_delete);

echo "<h2>Votre commande a été validée !</h2>";
echo "<p>Total à payer : " . $total . " €</p>";
?>
