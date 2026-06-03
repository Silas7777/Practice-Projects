<?php
require_once("../../db/connection.php");

// print_r($_GET);

$product_id = $_GET['id'];

// $query = "select image from product where id=?"; // if we add the image name as a parameter in the a href it is the same as this process.
// $res = $pdo->prepare($query);
// $res->execute([$product_id]);

// $imageName = $res->fetch(PDO::FETCH_ASSOC); //take the image name from the table
// $imageName = $imageName['image']; //insert the image name from table store 
$imageName = $_GET['oldImageName']; // need to add this if writing as a parameter, if this line is not include the photo will not be deleted in project file.
$deleteQuery = "delete from product where id=?";
$deleteRes = $pdo->prepare($deleteQuery);
$deleteRes->execute([$product_id]);//delete record from table

unlink("../../images/$imageName"); // delete old image from the project folder

header("Location:list.php");