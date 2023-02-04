<?php

require_once 'database/DBConnection.php';

session_start();

$cn = new DBConnection;

if(isset($_POST['name'])){

    $id = $_SESSION['id'];

    $name = $_POST['name'];

    $description = $_POST['description'] ?? '';

    $res = $cn->getConnection()->query("UPDATE task SET name = '$name', description = '$description' WHERE  id = $id");

    if(!$res)
        die('Query Failed.');

    echo "Update Task Successfully";


    
}