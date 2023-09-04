<?php
<<<<<<< HEAD
    define('HOST', 'localhost');
    define('DB_Name', 'ticketing');
    define('USER', 'root');
    define('PASS', '157326');
=======
    define('HOST', '');
    define('DB_Name', '');
    define('USER', '');
    define('PASS', '');
>>>>>>> e55fcdbd74d9c5a34687a5ff4ce512199acd3905

    try{
        $db = new PDO("mysql:host". HOST . ";dbname" . DB_Name,  USER, PASS );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo $e;
    }
 
?>