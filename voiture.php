<?php
    $marque_id = $_GET['marque_id'] ?? null;
    include 'connect.php';
    extract($_POST);
    $query = "SELECT * from voiture where marque_id='$marque_id' ";
    $result = mysqli_query($con,$query) or die (mysqli_error($con));
    $voitures=mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

<?php   include 'menu.php'   ?>
<div class="container">

    <div class="row text-center">
        <?php   foreach($voitures as $voiture):    ?>
            <div class="col-4">
                 <a href="voiture.php?marque_id=<?= $marque['id'] ?>"><img src="<?= $voiture['image']  ?>" style="width:22rem" alt="">
                <h1><?= $voiture['serie']  ?></h1>
                
            </div>
        <?php   endforeach    ?>
    </div>

</div>


</body>
</html>