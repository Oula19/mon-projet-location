<?php   
$con=mysqli_connect('127.0.0.1','root','','locationvoiture') or die ("erreur de conection");
if (!$con) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

  ?>