<?php
include './php/config.php';
// Inclusion des bibliothèques
require('../lib/http.php');
require('../lib/session.php');

// Connexion à la base de données
require('mysqli-connect.php');

$validation = true;
$messages = array();
$prenom = '';
$nom = '';
$email = '';

if ($_POST) {
    if (isset($_POST['prenom']) && !empty($_POST['prenom'])) {
        $prenom = $_POST['prenom'];
    } else {
        $validation = false;
        $messages[] = "Vous n'avez pas renseigné de prénom.";
    }

    if (isset($_POST['nom']) && !empty($_POST['nom'])) {
        $nom = $_POST['nom'];
    } else {
        $validation = false;
        $messages[] = "Vous n'avez pas renseigné de nom.";
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $validation = false;
        $messages[] = "Vous n'avez pas renseigné d'email.";
    }
}

// On ne traite le formulaire que si l'utilisateur a envoyé des données et qu'elles sont valides
if ($_POST && $validation) {
    // Vérification si cet email n'est pas déjà enregistré
    // Création de la requête SQL
    $sql = sprintf(
        "UPDATE user
        SET prenom = '%s', nom = '%s', email = '%s'
        WHERE id = %d",
        mysqli_real_escape_string($link, $prenom),
        mysqli_real_escape_string($link, $nom),
        mysqli_real_escape_string($link, $email),
        mysqli_real_escape_string($link, $_SESSION['user']['id'])
    );

    // Exécution de la requête SQL
    $result = mysqli_query($link, $sql);

    // Vérification du résultat de la requête
    if ($result) {
        // Stockage de l'identité de l'utilisateur dans la variable de session
        $_SESSION['user']['prenom'] = $prenom;
        $_SESSION['user']['nom'] = $nom;
        $_SESSION['user']['email'] = $email;

        $messages[] = "Votre profil a été mis à jour.";
    } else {
        // En cas d'erreur, vous pouvez effectuer une autre action ici si nécessaire
        $messages[] = "Erreur lors de la mise à jour du profil.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>

<h1>Profil</h1>

<?php if (!empty($messages)): ?>
<p>
<?php
foreach ($messages as $message) {
    echo htmlentities($message) . '<br />';
}
?>
</p>
<?php endif; ?>

<form action="" method="post">
    <label for="id">ID</label><br />
    <input disabled="disabled" name="id" type="text" value="<?php echo htmlentities($_SESSION['user']['id']); ?>" /><br />

    <label for="nom">Nom</label><br />
    <input name="nom" type="text" value="<?php echo htmlentities($_SESSION['user']['nom']); ?>" /><br />

    <label for="prenom">Prénom</label><br />
    <input name="prenom" type="text" value="<?php echo htmlentities($_SESSION['user']['prenom']); ?>" /><br />

    <label for="email">Email</label><br />
    <input name="email" type="text" value="<?php echo htmlentities($_SESSION['user']['email']); ?>" /><br />

    <input type="submit" value="Mettre à jour" /><br />
</form>

<p>
    <a href="home.php">Home</a><br />
    <a href="deconnexion.php">Déconnexion</a><br />
</p>

</body>
</html>