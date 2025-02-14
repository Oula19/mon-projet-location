<?php
session_start();


if (!isset($_SESSION['panier']) || count($_SESSION['panier']) == 0) {
    header("Location: panier.php");
    exit();
}


$total = 0;
foreach ($_SESSION['panier'] as $item) {
    $total += $item['prix'] * $item['quantite'];
}


$total = number_format($total, 2, '.', '');

$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
$paypal_email = 'your_paypal_email@example.com'; 


$data = array(
    'cmd' => '_xclick',
    'business' => $paypal_email,
    'item_name' => 'Location de voitures',
    'amount' => $total,
    'currency_code' => 'USD', 
    'return' => 'http://votre_site.com/confirmation.php',
    'cancel_return' => 'http://votre_site.com/panier.php', 
    'notify_url' => 'http://votre_site.com/ipn.php' 
);


$query_string = http_build_query($data);

header("Location: $paypal_url?$query_string");
exit();
?>
