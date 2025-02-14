<?php

include 'connect.php';
session_start();

$query = "SELECT * FROM voiture";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$voitures = mysqli_fetch_all($result, MYSQLI_ASSOC);



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des voitures disponibles</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        body {
    background-image: url('2.png');
    background-position: center;
    background-repeat: no-repeat; 
    background-size: cover;
    
}

  </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container mt-5">
    <h1 style="color:white" >Liste des voitures disponibles</h1>
    <div class="row">
        <?php foreach ($voitures as $voiture): ?>
            <div class="col-4 mb-4"  style="background-color: rgba(255, 255, 255, 0.5); border: none; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2); border-radius: 15px; padding: 20px; margin-top: 40px; margin-bottom: 40px;">
                <div class="card" style="background-color: rgba(122, 118, 115, 0.7); border-radius: 15px 15px 0 0;">
                    <img src="<?= $voiture['image'] ?>" class="card-img-top" alt="<?= $voiture['model'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $voiture['serie'] ?></h5>
                        <p class="card-text">Prix : <?= $voiture['prix'] ?> DH par jour</p>
                        <a href="ajouter_panier.php?id=<?= $voiture['id'] ?>" class="btn btn-danger">Ajouter à panier</a>
                        <a href="description.php?id=<?= $voiture['id'] ?>" class="btn btn-warning">Description</a>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
