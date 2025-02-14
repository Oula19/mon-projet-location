
<?php
include "connect.php";
$query = "SELECT * FROM marque ";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$marques = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>marque</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <style>
        body {
    background-image: url('2.png');
    width: 100%;
    background-position: center;
    background-repeat: no-repeat; 
}

  </style>
</head>

<body>
<?php include "menu.php"?>
  <div class="container w-50" >
    <div class="row"style="background-color: rgba(169, 169, 169, 0.5);">
  <?php foreach ($marques as $marque) : ?>
    <div id="card" class="my-3">
        <div class="col-md-6 text-center">
        <a href="voiture.php?marque_id=<?= $marque['id'] ?>">
        <img class="img-fluid" src="<?= $marque['logo'] ?>"></a>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>

</body>

</html>
