<?php
include './php/config.php';


try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$confirmation_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticketName = $_POST["ticket_name"];
    $ticketDescription = $_POST["ticket_description"];

    $insertQuery = "INSERT INTO tickets (name, description) VALUES (?, ?)";
    $insertStatement = $db->prepare($insertQuery);
    $insertStatement->execute([$ticketName, $ticketDescription]);

    $confirmation_message = "Votre ticket a été soumis avec succès.";
}

// Récupérer la liste des tickets depuis la base de données
$selectQuery = "SELECT id, name, description FROM tickets";
$statement = $db->query($selectQuery);
$tickets = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./scss/home_page/main.css">
    <title>Acceuile</title>
</head>

<body>
    <nav>
        <h1> Ticketing </h1>
        <a href="./profile.html"><i class="fa-regular fa-user"></i></a>
        <i class="fa-solid fa-plus"></i>
    </nav>
    <div class="box">
        <div>
            <span class="fa-regular fa-flag clickable-icon "></span>
            <span class="fa-regular fa-flag clickable-icon "></span>
            <span class="fa-regular fa-flag clickable-icon "></span>
            <span class="fa-regular fa-flag clickable-icon "></span>
            <span class="fa-regular fa-flag clickable-icon "></span>

        </div>
        <div>
            <span class="fa-regular fa-bookmark  clickable-icon "></span>
            <span class="fa-regular fa-bookmark  clickable-icon "></span>
            <span class="fa-regular fa-bookmark  clickable-icon "></span>
            <span class="fa-regular fa-bookmark  clickable-icon "></span>
            <span class="fa-regular fa-bookmark  clickable-icon "></span>
        </div>
        <div>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
        </div>
    </div>
    <div class="box">
        <div>
            <span class="fa-regular fa-flag  clickable-icon "></span>
            <span class="fa-regular fa-flag  clickable-icon "></span>
            <span class="fa-regular fa-flag  clickable-icon "></span>
            <span class="fa-regular fa-flag  clickable-icon "></span>
            <span class="fa-regular fa-flag  clickable-icon "></span>
        </div>
        <div>
            <span class="fa-regular fa-bookmark clickable-icon "></span>
            <span class="fa-regular fa-bookmark clickable-icon "></span>
            <span class="fa-regular fa-bookmark clickable-icon "></span>
            <span class="fa-regular fa-bookmark clickable-icon "></span>
            <span class="fa-regular fa-bookmark clickable-icon "></span>
        </div>
        <div>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
        </div>
    </div>
    <div class="box">
        <div>
            <span class="fa-regular fa-flag clickable-icon "></span>
            <span class="fa-regular fa-flag clickable-icon "></span>
            <span class="fa-regular fa-flag clickable-icon "></span>
            <span class="fa-regular fa-flag clickable-icon "></span>
            <span class="fa-regular fa-flag clickable-icon "></span>
        </div>
        <div>
            <span class="fa-regular fa-bookmark clickable-icon "></span>
            <span class="fa-regular fa-bookmark clickable-icon "></span>
            <span class="fa-regular fa-bookmark clickable-icon "></span>
            <span class="fa-regular fa-bookmark clickable-icon "></span>
            <span class="fa-regular fa-bookmark clickable-icon "></span>
        </div>
        <div>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
            <span class="fa-regular fa-thumbs-up clickable-icon "></span>
        </div>
    </div>
    <footer>
        <p class="Copy">Jayson-Decubber-2023</p>
    </footer>
</body>
<script src="./js/clik_icons.js"></script>

</html>