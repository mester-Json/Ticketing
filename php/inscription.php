<?php
// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Remplace ces valeurs par les informations de ta base de données
    $serveur = "localhost";
    $utilisateur = "root";
    $motDePasse = "157326";
    $baseDeDonnees = "ticketing";

    // Se connecter à la base de données
    $connexion = new mysqli($serveur, $utilisatuer, $motDePasse, $baseDeDonnees);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("La connexion a échoué : " . $connexion->connect_error);
    }

    // Récupérer les données du formulaire
    $User = $_POST["user"];
    $Mail = $_POST["mail"];
    $Password = $_POST["password"];

    // Éviter les injections SQL en utilisant des requêtes préparées
    $requete = $connexion->prepare("INSERT INTO user (user, mail, password ) VALUES (?, ?, ?)");
    $requete->bind_param("sss", $User, $Mail, $Password );

    // Exécuter la requête
    if ($requete->execute()) {
        echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
        // Tu peux rediriger l'utilisateur vers une page de connexion ici
    } else {
        echo "Une erreur est survenue lors de l'inscription.";
    }

    // Fermer la requête et la connexion
    $requete->close();
    $connexion->close();
}