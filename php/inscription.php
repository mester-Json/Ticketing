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
        $mail = $_POST["Mail"];
        $password = $_POST["Password"];

        // Vérifier si les champs obligatoires sont remplis
        if (empty($user) || empty($mail) || empty($password)) {
            echo "Tous les champs doivent être remplis.";
        } else {
            // Éviter les injections SQL en utilisant des requêtes préparées
            $requete = $db->prepare("INSERT INTO user (user, mail, password) VALUES (?, ?, ?)");
            $requete->bindParam(1, $user);
            $requete->bindParam(2, $mail);
            $requete->bindParam(3, $password);

            // Exécuter la requête
            if ($requete->execute()) {
                echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
                // Tu peux rediriger l'utilisateur vers une page de connexion ici
            } else {
                echo "Une erreur est survenue lors de l'inscription.";
            }
        }
    } catch (PDOException $e){
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}