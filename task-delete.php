<?php

require_once 'database/DBConnection.php';

$cn = new DBConnection;

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $res = $cn->getConnection()->query("DELETE FROM task WHERE id = $id");

    if(!$res)
        die('Query Failed.');
    else
        echo 'Task Deleted Successfully';

}
    