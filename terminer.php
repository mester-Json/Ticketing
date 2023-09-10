<?php
session_start(); // Assurez-vous que la session est démarrée

include './php/config.php';

// Exemple : récupérer les tickets dans la catégorie "Attente" depuis la base de données
$sql = "SELECT * FROM ticket WHERE categorie = 'Terminer'"; // Personnalisez la requête selon votre structure de base de données
$stmt = $db->prepare($sql);
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./scss/attente/main.css">
    <link rel="stylesheet" href="./scss/attente/base.css">
    <link rel="stylesheet" href="./scss/attente/layout/attente_style.css">
    <link rel="stylesheet" href="./scss/home_page/layout/nav_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Terminer</title>
</head>

<body>
    <nav>
        <h1> Ticketing </h1>
        <a href="./home_page.php" class="home">
            <p>Acceuille</p>
        </a>
        <a href="./attente.php" class="attente">
            <p>Attente</p>
        </a>
        <a href="./archive.php" class="archive">
            <p>Archive</p>
        </a>
        <a href="./terminer.php" class="archive">
            <p>Terminer</p>
        </a>
        <a href="./profile.php"><i class="fa-regular fa-user"></i></a>
        <i class="fa-solid fa-plus" onclick="openModal()"></i>
        <div id="ticketModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Envoyer un ticket</h2>
                <form action="home_page.php" method="post">
                    <input type="text" name="titre" placeholder="Titre du ticket" required>
                    <textarea name="description" placeholder="Description du ticket" required></textarea>
                    <input type="submit" value="Envoyer">
                </form>
            </div>
        </div>
    </nav>
    <div class="box">
        <div>
            <?php
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="ticket">';
                    echo '<h3>' . $row['ticket_name'] . '</h3>';
                    echo '<p>' . $row['ticket_description'] . '</p>';
                    echo '<input type="hidden" name="ticket_id" value="' . $row['id'] . '">';
                    echo '<div class="icons">';
                    echo '<i class="fas fa-flag" onclick="moveTicketTo(\'attente\', ' . $row['id'] . ')"></i>'; // Icône de drapeau
                    echo '<i class="fas fa-bookmark" onclick="moveTicketTo(\'archive\', ' . $row['id'] . ')"></i>'; // Icône de signet
                    echo '<i class="fas fa-heart" onclick="moveTicketTo(\'termine\', ' . $row['id'] . ')"></i>'; // Icône de cœur
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
    <footer>
        <p class="Copy">Jayson-Decubber-2023</p>
    </footer>
</body>
<script src="./js/clik_icons.js"></script>
<script src="./js/modal.js"></script>
<script src="./js/deplacement.js"></script>

</html>