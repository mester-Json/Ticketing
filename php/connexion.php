<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Remplace ces valeurs par les informations de ta base de données
    define('HOST', '');
    define('DB_Name', '');
    define('USER', '');
    define('PASS', '');

    try {
        $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_Name, USER, PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $user = $_POST["User"];
        $mail = $_POST["Mail"]; 
        $password = $_POST["Password"];
        
        $requete = $db->prepare("SELECT id FROM user WHERE user = ? AND mail = ? AND password = ?");
        $requete->bindParam(1, $user);
        $requete->bindParam(2, $mail);
        $requete->bindParam(3, $password); 

        $requete->execute();

        if ($requete->fetch()) {
            header("Location: ../home_page.html");
            exit;
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (PDOException $e){
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
?>