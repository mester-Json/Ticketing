<?php
session_start(); // Assurez-vous que la session est démarrée

include './php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id']; // Récupérez l'ID de l'utilisateur connecté depuis la session
    $ticket_name = $_POST['titre'];
    $ticket_description = $_POST['description'];

    // Insérez les données dans la table 'ticket' avec l'ID de l'utilisateur
    $sql = "INSERT INTO ticket (ticket_name, ticket_description) VALUES (:titre, :description)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':titre', $ticket_name);
    $stmt->bindParam(':description', $ticket_description);

    if ($stmt->execute()) {
        // Redirigez l'utilisateur vers la même page pour afficher les tickets mis à jour
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Une erreur s'est produite lors de l'ajout du ticket.";
    }
}

// Requête SQL pour récupérer tous les tickets (y compris le nouveau si ajouté)
$sql = "SELECT * FROM ticket ORDER BY id DESC"; // Remplacez 'ticket_id' par le nom de votre colonne d'ID de ticket
$stmt = $db->prepare($sql);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./scss/home_page/main.css">
    <link rel="stylesheet" href="./scss/home_page/base.css">
    <link rel="stylesheet" href="./scss/home_page/layout/box.css">
    <link rel="stylesheet" href="./scss/home_page/layout/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Accueil</title>
</head>

<body>
    <nav>
        <h1> Ticketing </h1>
        <a href="./profile.html"><i class="fa-regular fa-user"></i></a>
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
                    echo '<h2>' . $row['ticket_name'] . '</h2>';
                    echo '<p>' . $row['ticket_description'] . '</p>';
                    // ... Affichez d'autres détails du ticket selon votre structure de base de données
                    echo '</div>';
                }
            } else {
                echo 'Aucun ticket trouvé.';
            }
            ?>
        </div>
    </div>
    <footer>
        <p class="Copy">Jayson-Decubber-2023</p>
    </footer>
</body>
<script src="./js/click_icons.js"></script>
<script src="./js/modal.js"></script>

</html>