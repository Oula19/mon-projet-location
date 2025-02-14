<?php
include "connect.php";
$query = "SELECT * FROM marque";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$marques = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Marques</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <style>
     body {
    background-image: url('2.png');
    background-position: center;
    background-repeat: no-repeat; 
    background-size: cover;
    
}

    .image-container {
      background-color: rgba(169, 169, 169, 0.5); 
      padding: 10px; 
      border-radius: 30px; 
      display: flex;
      justify-content: center; 
      align-items: center; 
      height: 200px;
      overflow: hidden; 
    }

    .image-container img {
      max-width: 100%; 
      max-height: 100%; 
      object-fit: contain;
    }

    .container {
      padding: 20px 0;
    }
  </style>
</head>

<body>
  <?php include "menu.php"; ?>
  <div class="container">
    <div class="row">
      <?php foreach ($marques as $marque) : ?>
        <div class="col-6 col-md-3 mb-4"> 
          <div class="image-container">
            <a href="voiture.php?marque_id=<?= $marque['id'] ?>">
              <img src="<?= $marque['logo'] ?>" >
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>
