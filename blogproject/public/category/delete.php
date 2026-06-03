<?php

require_once("../../db/connection.php");

$query = "delete from category where id=?";
$res = $pdo->prepare($query);
$res->execute([$_GET['id']]);

header("Location:create.php");