<?php
// Démarre la session PHP
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blockchain_jobs";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['publier_offre'])) {
    // Récupération des données
    $title = trim($_POST['title']);
    $company = trim($_POST['company']);
    $location = trim($_POST['location']);
    $remote = $_POST['remote'];
    $type = $_POST['type'];
    $experience = $_POST['experience'];
    $salary = trim($_POST['salary']);
    $description = trim($_POST['description']);
    $tags = trim($_POST['tags']);

    // Validation
    $errors = [];
    if (empty($title)) $errors[] = "Le titre du poste est obligatoire.";
    if (empty($company)) $errors[] = "Le nom de l'entreprise est obligatoire.";
    if (empty($description)) $errors[] = "La description est obligatoire.";

    // Stocker les données en session en cas d'erreur
    $_SESSION['form_data'] = [
        'title' => $title,
        'company' => $company,
        'location' => $location,
        'remote' => $remote,
        'type' => $type,
        'experience' => $experience,
        'salary' => $salary,
        'description' => $description,
        'tags' => $tags
    ];

    if (empty($errors)) {
        try {
            // Insertion dans la base de données
            $requete = $db->prepare("
                INSERT INTO jobs (title, company, location, remote, type, experience, salary, description, tags, created_at) 
                VALUES (:title, :company, :location, :remote, :type, :experience, :salary, :description, :tags, NOW())
            ");

            $requete->execute([
                "title" => $title,
                "company" => $company,
                "location" => $location,
                "remote" => $remote,
                "type" => $type,
                "experience" => $experience,
                "salary" => $salary,
                "description" => $description,
                "tags" => $tags
            ]);

            // Nettoyer les données de formulaire stockées
            unset($_SESSION['form_data']);
            
            $_SESSION['success'] = "Votre offre d'emploi a été publiée avec succès !";
            header("Location: recruteur.php");
            exit();

        } catch(PDOException $e) {
            $_SESSION['error'] = "Erreur lors de la publication : " . $e->getMessage();
            header("Location: recruteur.php");
            exit();
        }
    } else {
        $_SESSION['error'] = implode("<br>", $errors);
        header("Location: recruteur.php");
        exit();
    }
} else {
    // Si accès direct au fichier, rediriger vers le formulaire
    header("Location: recruteur.php");
    exit();
}
?>