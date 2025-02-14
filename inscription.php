<?php
include('connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $mot_de_passe =  $_POST['mot_de_passe'];
    $token = bin2hex(random_bytes(50)); 
    $query_check = "SELECT id FROM utilisateurs WHERE email = ?";
    $stmt_check = mysqli_prepare($con, $query_check);
    mysqli_stmt_bind_param($stmt_check, 's', $email);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        $error = "Email déjà utilisé.";
    } else {
        
        $query_insert = "INSERT INTO utilisateurs (nom, email, mot_de_passe, token) VALUES (?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($con, $query_insert);
        mysqli_stmt_bind_param($stmt_insert, 'ssss', $nom, $email, $mot_de_passe, $token);
        mysqli_stmt_execute($stmt_insert);



        $success = "Un email de confirmation a été envoyé.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Location de Voitures</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        
body {
    background-image: url('2.png');
    width: 100%;
    background-position: center;
    background-repeat: no-repeat; 
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

    </style>
</head>
<body>


<?php include('menu.php'); ?>

<div class="form-container">
<h2>Inscription</h2>
<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<?php if (isset($success)) echo "<p style='color:green'>$success</p>"; ?>

<div class="container mt-5" style="width: 50%;"> 
    <div class="card" style="background-color: rgba(255, 255, 255, 0.5); border: none; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2); border-radius: 15px; padding: 20px; margin-top: 40px; margin-bottom: 40px;">
      <div class="card-header" style="background-color: rgba(122, 118, 115, 0.7); border-radius: 15px 15px 0 0;">
        <div class="card-title">
          <h1 class="text-center">
           Inscription
          </h1>
        </div>
      </div>
      <div class="card-body text-center"style="background-color: rgba(255, 255, 255, 0.3); border-radius: 0 0 15px 15px;">
     
<form action="inscription.php" method="POST">
    <div class="input-group">
        <!-- <label for="nom">Nom:</label> -->
        <input type="text" class="form-control my-3" name="nom" id="nom" placeholder="Entrez le Nom" required><br>
    </div>

    <div class="input-group">
        <!-- <label for="email">Email:</label> -->
        <input type="email" class="form-control my-3" name="email" placeholder="Entrez l'Email" id="email" required><br>
    </div>

    <div class="input-group">
        <!-- <label for="mot_de_passe">Mot de passe:</label> -->
        <input type="password" class="form-control my-3" name="mot_de_passe" placeholder="Entrez le mot de passe" id="mot_de_passe" required><br>
    </div>

    <button type="submit" class="btn btn-outline-success">S'inscrire</button>
</form>
<p>Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous ici</a></p>
</div>

</body>
</html>
