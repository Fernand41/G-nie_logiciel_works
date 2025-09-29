<?php 
// Démarre la session PHP
session_start();

// 🔧 Paramètres de connexion à la base de données
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "blockchain_jobs"; 

try {
    // 🔌 Connexion sécurisée avec PDO
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifie si le formulaire a été soumis
if (isset($_POST['ok'])) {
    // Récupération des données de l'entreprise
    $nom_entreprise = trim($_POST['nom_entreprise']);
    $email          = trim($_POST['email']);
    $password       = $_POST['password'];

    /* --- Vérifications avant insertion --- */

    // 1️ Vérifier si le nom d'entreprise existe déjà
    $checkNomEntreprise = $db->prepare("SELECT COUNT(*) FROM entreprises WHERE nom_entreprise = :nom_entreprise");
    $checkNomEntreprise->execute(["nom_entreprise" => $nom_entreprise]);
    $nomEntrepriseExists = $checkNomEntreprise->fetchColumn();

    if ($nomEntrepriseExists) {
        $_SESSION['error'] = "Ce nom d'entreprise est déjà utilisé. Veuillez en choisir un autre.";
        header("Location: singup-work.php");
        exit();
    }

    // 2️ Vérifier si l'email existe déjà
    $checkEmail = $db->prepare("SELECT COUNT(*) FROM entreprises WHERE email = :email");
    $checkEmail->execute(["email" => $email]);
    $emailExists = $checkEmail->fetchColumn();

    if ($emailExists) {
        $_SESSION['error'] = "Cet email est déjà associé à une entreprise.";
        header("Location: singup.php");
        exit();
    }

    /* --- Insertion de l'entreprise si tout est correct --- */

    // 3️⃣ Hashage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // 4️ Requête d'insertion sécurisée
        $requete = $db->prepare("
            INSERT INTO entreprises (nom_entreprise, email, password, date_creation) 
            VALUES (:nom_entreprise, :email, :password, NOW())
        ");

        // 5️ Exécution avec les valeurs
        $requete->execute([
            "nom_entreprise" => $nom_entreprise,
            "email"          => $email,
            "password"       => $hashedPassword
        ]);

        // Inscription réussie
        $_SESSION['success'] = "Inscription de l'entreprise réussie !";
        header("Location: login.php");
        exit();
    } catch(PDOException $e) {
        $_SESSION['error'] = "Une erreur est survenue lors de l'inscription: " . $e->getMessage();
        header("Location: singup.php");
        exit();
    }
}
?>