<?php
  include 'connect.php';
  $query = "SELECT * from marque";
  $result = mysqli_query($con,$query) or die (mysqli_error($con));
  $marques=mysqli_fetch_all($result, MYSQLI_ASSOC);
  
if (isset($_POST['submit'])) { 
    extract($_POST);
    $source =$_FILES['image']['tmp_name'];
    $voiture = "images/".$_FILES['image']['name'];
    move_uploaded_file($source,$voiture);
    $query = "INSERT INTO voiture VALUES(null,'$matricule','$serie','$model', '$couleur','$carburant',
    '$puissance','$prix','$voiture','$marque_id')";
     mysqli_query($con,$query) or die (mysqli_error($con));
     header("location:listevoiture.php");
}
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
    background-position: center;
    background-repeat: no-repeat; 
}

    </style>
</head>
<body>
<?php   
    include 'menu.php'
        ?>
<div class="container mt-5" style="width: 50%;"> 
    <div class="card" style="background-color: rgba(255, 255, 255, 0.5); border: none; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2); border-radius: 15px; padding: 20px; margin-top: 40px; margin-bottom: 40px;">
      <div class="card-header" style="background-color: rgba(122, 118, 115, 0.7); border-radius: 15px 15px 0 0;">
        <div class="card-title">
          <h1 class="text-center">
           Ajouter Une Marque
          </h1>
        </div>
      </div>
      <div class="card-body text-center">
     
        <form  method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-6">
          <input type="text" class="form-control mt-3" placeholder="add matricule..."  name="matricule">
         </div>
          <div class="col-6">
        <input type="file" class="form-control my-3" name="image">
          </div>
        </div>
        <div class="row">
           <div class="col-6">
           <select name="marque_id" class="form-control" onchange="submit()">
            <option value="">select un marque</option>
            <?php foreach ($marques as $marque) : ?>
              <option <?php echo (isset($_POST['marque_id']) && $_POST['marque_id'] == $marque['id']) ? 'selected' : '' ?> value="<?= $marque['id'] ?>"> <?= $marque['marque'] ?></option>
            <?php endforeach ?>
            </div>
            <div class="col-6">
            <input type="text" class="form-control mt-3" placeholder="add name ..."  name="serie">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
            <input type="text" class="form-control mt-3" placeholder="add model..."  name="model">
            </div>
            <div class="col-6">
            <input type="text" class="form-control mt-3" placeholder="add carburant..."  name="carburant">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
            <input type="text" class="form-control mt-3" placeholder="add puissance..."  name="puissance">
            </div>
            <div class="col-6">
            <input type="text" class="form-control mt-3" placeholder="choose color..."  name="couleur">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
            <input type="text" class="form-control mt-3" placeholder="add price..."  name="prix">
            </div>
           
        </div>
            <button class="btn btn-outline-warning" name="submit"> Save</button>

        </form>
</body>
</html>


