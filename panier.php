<?php

session_start();


include 'connect.php';


if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
    $panier = $_SESSION['panier'];
    $total_panier = 0;
    
    foreach ($panier as $item) {
        
        if (is_array($item)) {
            $total_panier += $item['prix'] * $item['quantite'];
        }
    }
} else {
    $panier = [];
    $total_panier = 0;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
    <link rel="stylesheet" href="bootstrap.min.css">

    <style>
 body {
    background-image: url('2.png');
    margin: 0; 
    padding: 0;
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat; 
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    
   
    

}

    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container-panier">
    <h1 class="text-white" >Votre Panier</h1>

    <?php if (count($panier) > 0): ?>
    <table class="table-panier table table-bordered  text-info" style="background-color: rgba(169, 169, 169, 0.5);" >
        <thead>
            <tr  >
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody >
            <?php foreach ($panier as $item): ?>
            <?php if (is_array($item)): ?>
            <tr>
                <td class="item">
                    <img src="<?= $item['image']; ?>" alt="<?= $item['nom']; ?>">
                    <?= $item['nom']; ?>
                </td>
                <td class="price"><?= $item['prix']; ?> DH</td>
                <td class="quantity"><?= $item['quantite']; ?></td>
                <td class="total text-white"><?= $item['prix'] * $item['quantite']; ?> DH</td>
                <td>
                    <a href="retirer_du_panier.php?id=<?= $item['id']; ?>" class="btn-danger btn">Retirer</a>
                </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total-section "style="color:#f87619">
        <p>Total :</p>
        <p class="total-price"><?= $total_panier; ?> DH</p>
    </div>

    
    <form action="paiement.php" method="POST">
        <input type="hidden" name="total_panier" value="<?= $total_panier; ?>">
        <button type="submit" class="btn checkout-btn btn-outline-light">Passer à la caisse</button>
    </form>

    <?php else: ?>
        <p style="color:red">Votre panier est vide. Ajoutez des produits pour continuer.</p>
    <?php endif; ?>
</div>

</body>
</html>
