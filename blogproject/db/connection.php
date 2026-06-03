<?php

try{

    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=blogs_project","root","root");

}catch(PDOException $error){

    echo "Connection error>>>".$error;

}