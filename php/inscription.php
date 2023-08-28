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
        $repassword = $_POST["rePassword"];

        if (empty($user) || empty($mail) || empty($password) || empty($repassword)) {
            echo "Tous les champs doivent être remplis.";
        } else if ($password != $repassword) {
            echo "Les mots de passe ne correspondent pas.";
        } else {
            // Vérifier si l'email est déjà utilisé
            $emailQuery = $db->prepare("SELECT id FROM user WHERE mail = ?");
            $emailQuery->bindParam(1, $mail);
            $emailQuery->execute();

            if ($emailQuery->rowCount() > 0) {
                echo "Cet email est déjà utilisé. Veuillez en choisir un autre.";
            } else {
                // Éviter les injections SQL en utilisant des requêtes préparées
                $requete = $db->prepare("INSERT INTO user (user, mail, password) VALUES (?, ?, ?)");
                $requete->bindParam(1, $user);
                $requete->bindParam(2, $mail);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hasher le mot de passe
                $requete->bindParam(3, $hashedPassword);

                // Exécuter la requête
                if ($requete->execute()) {
                    echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
                    // Tu peux rediriger l'utilisateur vers une page de connexion ici
                } else {
                    echo "Une erreur est survenue lors de l'inscription.";
                }
            }
        }
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

?>