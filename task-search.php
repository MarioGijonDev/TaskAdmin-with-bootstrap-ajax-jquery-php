<?php

require_once 'database/DBConnection.php';

$cn = new DBConnection;

$searchValue = $_POST['searchValue'] ?? '';

if(!empty($searchValue)){
    
    $query = "SELECT * FROM task WHERE name LIKE '$searchValue%'";
    
    $res = $cn->getConnection()->query($query);
    
    if(!$res)
        die('Query Failed.');

    $json = [];
    
    while($row = $res->fetch(PDO::FETCH_ASSOC)){

        $json[] = [
            'name' => $row['name'],
            'description' => $row['description'],
            'id' => $row['id']
        ];
    }
    
    echo json_encode($json);
    
}