<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Remplace ces valeurs par les informations de ta base de données
    define('HOST', 'localhost');
    define('DB_Name', '');
    define('USER', '');
    define('PASS', '');

    try {
        $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_Name, USER, PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les données du formulaire
        $user = $_POST["User"];
        $mail = $_POST["Mail"]; // Correction : "Mail" au lieu de "mail"
        $password = $_POST["Password"];

        // Éviter les injections SQL en utilisant des requêtes préparées
        $requete = $db->prepare("SELECT id FROM user WHERE user = ? AND mail = ? AND password = ?"); // Correction : "AND" pour chaque condition
        $requete->bindParam(1, $user);
        $requete->bindParam(2, $mail);
        $requete->bindParam(3, $password); // Correction : 3 au lieu de 2

        // Exécuter la requête
        $requete->execute();

        // Vérifier si l'utilisateur existe
        if ($requete->fetch()) {
            echo "Connexion réussie. Bienvenue, utilisateur $user!";
            // Tu peux rediriger l'utilisateur vers une page de succès ici
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (PDOException $e){
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
?>