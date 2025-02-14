<?php
session_start();

if (empty($_SESSION['panier'])) {
    header("Location: panier.php");
    exit();
}

unset($_SESSION['panier']); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container mt-5">
    <h1>Merci pour votre achat !</h1>
    <p>Votre paiement a été effectué avec succès.</p>
    <p>Nous vous avons envoyé un email de confirmation.</p>
    <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
</div>

</body>
</html>
