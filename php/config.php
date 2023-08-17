<?php
    define('HOST', 'localhost');
    define('DB_Name', '');
    define('USER', '');
    define('PASS', '');

    try{
        $db = new PDO("mysql:host". HOST . ";dbname" . DB_Name,  USER, PASS );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "connecté > ok";
    }catch(PDOException $e){
        echo $e;
    }

?>