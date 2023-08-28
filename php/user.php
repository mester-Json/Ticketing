<?

define('HOST', '');
define('DB_Name', '');
define('USER', '');
define('PASS', '');

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: ../profile.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $db = new PDO("mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASSWORD'));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $newuser = $_POST["newuser"];
        $newmail = $_POST["newmail"]; 
        $newpassword = password_hash($_POST["newpassword"], PASSWORD_BCRYPT); // Hachage du nouveau mot de passe
        
        // Mettre à jour les informations dans la base de données
        $userId = $_SESSION['user_id']; // Assure-toi que tu as la variable de session user_id définie
        $updateSql = "UPDATE user SET user=?, password=?, mail=? WHERE id=?";
        $stmt = $db->prepare($updateSql);
        $stmt->execute([$newuser, $newpassword, $newmail, $userId]);
    
        echo "Profil mis à jour avec succès.";
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }   
}
