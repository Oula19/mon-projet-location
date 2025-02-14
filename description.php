<?php
include 'connect.php';
session_start();


if (!isset($_GET['id'])) {
    header('Location: listevoiture.php');
    exit();
}


$id = $_GET['id'];
$query = "SELECT * FROM voiture WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$voiture = mysqli_fetch_assoc($result);

if (!$voiture) {
    echo "Voiture non trouvée.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la voiture</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        body {
    background-image: url('2.png');
    width: 100%;
    background-position: center;
    background-repeat: no-repeat; 
}
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container mt-5" style=" background-color: rgba(255, 255, 255, 0.5);
      border: none;
      box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2); 
      border-radius: 15px; 
      padding: 20px; 
      margin-top: 40px; 
      margin-bottom: 40px;">
    <h1 style="color: #FFA500;font-weight: bold;font-size: 28px;">Détails de la voiture: <?= $voiture['serie'] ?></h1>

    <div class="row" >
        <div class="col-md-6">
            <img src="<?= $voiture['image'] ?>" class="img-fluid" alt="<?= $voiture['model'] ?>">
        </div>
        <div class="col-md-6 text-light" >
        <div  style="color: #5F6A6A;font-size: 16px;line-height: 1.5;">

            <h3><?= $voiture['serie'] ?> (<?= $voiture['model'] ?>)</h3>
            <p><strong>Prix par jour : </strong><?= $voiture['prix'] ?> DH</p>
            <p><strong>Caractéristiques :</strong></p>
            <ul>
                <li><strong>Année : </strong><?= $voiture['model'] ?></li>
                <li><strong>Couleur : </strong><?= $voiture['couleur'] ?></li>
                <li><strong>Type : </strong><?= $voiture['serie'] ?></li>
            </ul>
            </div>
            <a href="ajouter_panier.php?id=<?= $voiture['id'] ?>" class="btn btn-danger">Réserver cette voiture</a>
        </div>
    </div>
</div>

</body>
</html>
