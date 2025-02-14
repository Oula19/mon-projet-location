
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location de Voitures</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        body {
            background-image: url('1.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            position: absolute;
            top: 20%;
            right: 10%;
            background: rgba(255, 255, 255, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-container input[type="date"] {
            width: 100%;
            margin-bottom: 15px;
        }

        .form-container button {
            width: 100%;
        }
    </style>
</head>
<body>
    <?php  include "menu.php"?>
    <div class="form-container">
        <h2>Réservez votre voiture maintenant !</h2>
        <form action="listevoiture.php" method="GET">
    <div class="form-group">
        <label for="date_depart">Date de départ :</label>
        <input type="date" id="date_depart" name="date_depart" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="date_retour">Date de retour :</label>
        <input type="date" id="date_retour" name="date_retour" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Chercher</button>
</form>

</form>

    </div>
</body>
</html>
