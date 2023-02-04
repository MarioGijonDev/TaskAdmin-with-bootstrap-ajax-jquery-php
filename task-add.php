<?php

require_once 'database/DBConnection.php';

$cn = new DBConnection;

if(isset($_POST['name'])){

    $name = $_POST['name'];

    $description = $_POST['description'] ?? '';
    
    $res = $cn->getConnection()->query("INSERT INTO task(name, description) VALUES ('$name', '$description')");
    
    if(!$res)
        die('Query failed');
    
    echo 'Task Added Successfully';
    
}