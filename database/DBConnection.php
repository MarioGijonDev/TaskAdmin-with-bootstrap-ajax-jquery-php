
<?php

class DBConnection{

    private $host;
    private $user;
    private $password;
    private $database;
    private $cn;

    function __construct(){

        // get data conecction of config.json file
        $dataDB = $this->dataConnection();

        $this->host = $dataDB['host'];
        $this->user = $dataDB['user'];
        $this->password = $dataDB['password'];
        $this->database = $dataDB['database'];

        try {

            // mysql info
            $dsn = "mysql:host=$this->host;dbname=$this->database";

            // get connection to mysql with pdo
            $this->cn = new PDO($dsn, $this->user, $this->password);

            // set connection attributtes
            $this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //echo "Connection succesful";

        } catch (PDOException $e){

            // If PDOException, show error message
            echo $e->getMessage();

        }

    }

    public function getConnection(){
        return $this->cn;
    }

    // Return config.json data in array
    private function dataConnection(){

        $jsonData = file_get_contents(dirname(__FILE__) . '/config.json');

        return json_decode($jsonData, true);

    }

    // Convert characters to UTF8 encoding
    /* private function convertUTF8($array){

        array_walk_recursive($array, function(&$item, $key){

            if(!mb_detect_encoding($item, 'utf-8', true))
                $item = utf8_encode($item);

        });

        return $array;

    } */
}