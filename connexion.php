<?php 
include('connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    $query = "SELECT id, nom, mot_de_passe, is_confirmed FROM utilisateurs WHERE email = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
            if ($row['is_confirmed']) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['nom'];
                header("Location: home.php");
                exit();
            } else {
                $error = "Veuillez confirmer votre email avant de vous connecter.";
            }
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Email non trouvé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Location de Voitures</title>
    <style>body {
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
    <?php include "menu.php"; ?>
    
    <div class="form-container">
        <h2>Connexion</h2>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <div class="container mt-5" style="width: 50%;"> 
    <div class="card" style="background-color: rgba(255, 255, 255, 0.5); border: none; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2); border-radius: 15px; padding: 20px; margin-top: 40px; margin-bottom: 40px;">
      <div class="card-header" style="background-color: rgba(122, 118, 115, 0.7); border-radius: 15px 15px 0 0;">
        <div class="card-title">
          <h1 class="text-center">
           Connexion
          </h1>
        </div>
      </div>
      <div class="card-body text-center"style="background-color: rgba(255, 255, 255, 0.3); border-radius: 0 0 15px 15px;">
     
        <form action="connexion.php" method="POST">
            <div class="input-group">
                <!-- <label for="email">Email:</label> -->
                <input type="email" class="form-control my-3" name="email" placeholder="Entrez l'Email" required>
            </div>
            <div class="input-group">
                <!-- <label for="mot_de_passe">Mot de passe:</label> -->
                <input type="password" class="form-control my-3" name="mot_de_passe" placeholder="Entrez le mot de passe" id="mot_de_passe"  id="mot_de_passe" required>
            </div>
            <button type="submit" class="btn btn-outline-success">Se connecter</button>
        </form>
        <p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a></p>
        <p><a href="deconnexion.php" style="color:red">Déconnexion</a></p>
    </div>
</body>
</html>
