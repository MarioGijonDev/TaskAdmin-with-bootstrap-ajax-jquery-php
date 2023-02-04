<?php

session_start();

require_once 'database/DBConnection.php';

$cn = new DBConnection;

$id = $_POST['id'] ?? '';

$res = $cn->getConnection()->query("SELECT * FROM task WHERE id = $id");

if(!$res)
    die('Query Failed.');

$_SESSION['id'] = $id;

$json = [];

while($row = $res->fetch(PDO::FETCH_ASSOC)){
    $json[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'description' => $row['description']
    ];
}

echo json_encode($json[0]);
