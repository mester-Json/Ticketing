<?php
define('HOST', 'localhost');
define('DB_Name', 'ticketing');
define('USER', 'root');
define('PASS', '157326');

try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_Name, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>





