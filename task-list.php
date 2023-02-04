
<?php

require_once 'database/DBConnection.php';

$cn = new DBConnection;

$res = $cn->getConnection()->query('SELECT * FROM task');

if(!$res)
    die('Query Failed ' . $cn->errorInfo());

$json = [];

while($row = $res->fetch(PDO::FETCH_ASSOC)){

    $json[] = [
        'name' => $row['name'],
        'description' => $row['description'],
        'id' => $row['id']
    ];
}

echo json_encode($json);

