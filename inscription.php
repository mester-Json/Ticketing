<?php 
    include'./php/config.php';


    try {
        $db = new PDO("mysql:host". HOST . ";dbname" . DB_Name,  USER, PASS );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

        $user = $_POST["User"];
        $mail = $_POST["Mail"];
        $password = $_POST["Password"];
        $repassword = $_POST["rePassword"];

        if (empty($user) || empty($mail) || empty($password) || empty($repassword)) {
            
        } else if ($password != $repassword) {
            echo "Les mots de passe ne correspondent pas.";
            echo "Tous les champs doivent être remplis.";
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
        echo $e;
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./scss/inscription/main.css">
    <title>inscription</title>
</head>

<body>
    <nav>
        <h1> Ticketing </h1>
    </nav>
    <form method="post"  id="contactForm" class="box">
        <div>
            <input class="box_user" name="User" id="User" type="text" placeholder="User">
            <label class="Error_User" for="User" id="UserError">
            </label>
        </div>
        <div>
            <input class="box_mail" name="Mail" id="Mail" type="mail" placeholder="Mail">
            <label class="Error_Mail" for="Mail" id="MailError">
            </label>
        </div>
        <div>
            <input class="box_password" name="Password" id="Password" type="password" placeholder="Password">
            <label class="Error_Password" for="Password" id="PasswordError">
            </label>
        </div>
        <div>
            <input class="box_repassword" name="rePassword" id="rePassword" type="password" placeholder="RePassword">
            <label class="Error_rePassword" for="rePassword" id="rePasswordError">
            </label>
        </div>
        <div>
            <input type="submit" name="" class="Bouton_inscription " value="Continuer">
        </div>
    </form>
</body>
<footer>
    <a class="Copy">
        <p>Jayson-Decubber-2023</p>
    </a>
</footer>

</html>