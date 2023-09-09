<?php 
    include './php/config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            header("Location: home_page.php");
            exit;
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (PDOException $e){
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./scss/index/main.css">
    <title>Connexion</title>
</head>

<body>
    <nav>
        <h1> Ticketing </h1>
    </nav>

    <form method="post" id="contactForm" class="box">
        <div>
            <input class="box_user"  name="User" id="User" type="text" placeholder="User">
            <label class="Error_User" for="User" id="UserError"> </label>
        </div>
        <div>
            <input class="box_mail"  name="Mail" id="Mail" type="mai" placeholder="Mail">
            <label class="Error_Mail" for="Mail" id="MailError">
            </label>
        </div>
        <div>
            <input class="box_password" name="Password" id="Password" type="password" placeholder="Password">
            <label class="Error_Password" value="Password" for="Password" id="PasswordError">
            </label>
        </div>
        <div>
            <input type="submit" name="" class="Bouton_connexion " value="submit">
        </div>
        <a class="new_compte" href="http://localhost/Ticketing/inscription.php">
            <p> Crée un compte </p>
        </a>
        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>
    </form>
</body>

<footer>
    <a class="Copy">
        <p>Jayson-Decubber-2023</p>
    </a>
</footer>

</html>