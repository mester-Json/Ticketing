<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Remplace ces valeurs par les informations de ta base de données
    $serveur = "localhost";
    $utilisateur = "root";
    $motDePasse = "157326";
    $baseDeDonnees = "ticketing";

    // Se connecter à la base de données
    $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("La connexion a échoué : " . $connexion->connect_error);
    }

    // Récupérer les données du formulaire
    $user = $_POST["User"];
    $mail = $_POST["Mail"];
    $paswword = $_POST["Password"];

    // Éviter les injections SQL en utilisant des requêtes préparées
    $requete = $connexion->prepare("Insert INTO user(user, mail, password) VALUES (?, ?, ?)");
    $requete->bind_param("ss", $user, $mail, $password);

    // Exécuter la requête
    $requete->execute();
    // Vérifier si l'utilisateur existe
    if ($requete->fetch()) {
        echo "Connexion réussie. Bienvenue, utilisateur $userId!";
        // Tu peux rediriger l'utilisateur vers une page de succès ici
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    // Fermer la requête et la connexion
    $requete->close();
    $connexion->close();
}