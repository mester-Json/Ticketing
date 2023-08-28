<?php
define('HOST', '');
define('DB_Name', '');
define('USER', '');
define('PASS', '');

// Établir la connexion
$conn = mysqli_connect(HOST, USER, PASS, DB_Name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Supposons que $user contienne le nom d'utilisateur
$user = "john";

$sql = "SELECT * FROM user WHERE user = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userName = $row["user"];
    $userEmail = $row["mail"];
    $usageTime = $row["usage_time"];
}