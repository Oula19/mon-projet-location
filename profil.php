<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  
    header("Location: connexion.php");
    exit();
}


include('connect.php');


$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM utilisateurs WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    
    session_destroy();
    header("Location: connexion.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    $update_query = "UPDATE utilisateurs SET nom = ?, email = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, 'ssi', $nom, $email, $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $success_message = "Profil mis à jour avec succès.";
    } else {
        $error_message = "Une erreur s'est produite. Essayez à nouveau.";
    }

 
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'utilisateur</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            color: #333;
        }

        h2 {
            text-align: center;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 30px auto;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-btn {
            background-color: #5e72e4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #4e61c7;
        }

        p {
            text-align: center;
        }
    </style>
</head>
<body>


<h2>Profil de l'utilisateur</h2>

<div class="form-container">
   
    <?php if (isset($success_message)) { echo "<p style='color: green;'>$success_message</p>"; } ?>
    <?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>

   
    <form action="profil.php" method="POST">
        <div class="input-group">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
        </div>

        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <button type="submit" class="submit-btn">Mettre à jour</button>
    </form>
</div>

</body>
</html>
