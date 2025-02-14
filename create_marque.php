<?php
if (isset($_POST['submit'])) { 
    include 'connect.php';
    extract($_POST);
    $source =$_FILES['logo']['tmp_name'];
    $logo = "logos/".$_FILES['logo']['name'];
    move_uploaded_file($source,$logo);
    $query = "INSERT INTO marque VALUES(null,'$marque','$logo')";
     mysqli_query($con,$query) or die (mysqli_error($con));
     header("location:marque.php");
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
          <h1 class="text-center text-white">
           Ajouter Une Marque
          </h1>
        </div>
      </div>
      <div class="card-body text-center" style="background-color: rgba(255, 255, 255, 0.3); border-radius: 0 0 15px 15px;">
        <form method="post" enctype="multipart/form-data">
            <input type="text" class="form-control my-3" name="marque" placeholder=" Appuyer ici pour saisir la marque....">
            <input type="file" class="form-control my-3" name="logo">
            <button class="btn btn-outline-warning" name="submit">Save</button>
       
                 </form>
</body>
</html>

