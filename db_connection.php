<?php
$con = mysqli_connect("localhost", "root", "", "location");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
