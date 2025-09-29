<?php
// Démarre la session PHP
session_start();

// Paramètres de connexion à la base de données
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
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et nettoyage des données
    $job_id = $_POST['job_id'] ?? '';
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validation des données
    $errors = [];

    if (empty($job_id)) {
        $errors[] = "ID du poste manquant.";
    }

    if (empty($fullname)) {
        $errors[] = "Le nom complet est obligatoire.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    }

    if (empty($message)) {
        $errors[] = "La lettre de motivation est obligatoire.";
    }

    // Gestion du fichier CV
    $cv_filename = '';
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['application/pdf'];
        $max_size = 5 * 1024 * 1024; // 5MB
        $file_type = $_FILES['cv']['type'];
        $file_size = $_FILES['cv']['size'];

        // Vérification du type de fichier
        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Le CV doit être au format PDF.";
        }

        // Vérification de la taille
        if ($file_size > $max_size) {
            $errors[] = "Le CV ne doit pas dépasser 5MB.";
        }

        // Génération d'un nom de fichier unique
        if (empty($errors)) {
            $file_extension = pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION);
            $cv_filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $fullname) . '.' . $file_extension;
            $upload_dir = 'uploads/cv/';
            
            // Création du dossier s'il n'existe pas
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $upload_path = $upload_dir . $cv_filename;
            
            // Déplacement du fichier
            if (!move_uploaded_file($_FILES['cv']['tmp_name'], $upload_path)) {
                $errors[] = "Erreur lors du téléchargement du CV.";
            }
        }
    } else {
        $errors[] = "Le CV est obligatoire.";
    }

    // Si pas d'erreurs, insertion en base de données
    if (empty($errors)) {
        try {
            // Requête d'insertion sécurisée
            $requete = $db->prepare("
                INSERT INTO candidatures (job_id, fullname, email, phone, cv_filename, message) 
                VALUES (:job_id, :fullname, :email, :phone, :cv_filename, :message)
            ");

            // Exécution avec les valeurs
            $requete->execute([
                "job_id" => $job_id,
                "fullname" => $fullname,
                "email" => $email,
                "phone" => $phone,
                "cv_filename" => $cv_filename,
                "message" => $message
            ]);

            // Succès
            $_SESSION['success'] = "Votre candidature a été envoyée avec succès !";
            header("Location: poste.php");
            exit();

        } catch(PDOException $e) {
            $_SESSION['error'] = "Une erreur est survenue lors de l'envoi de votre candidature: " . $e->getMessage();
            header("Location: poste.php");
            exit();
        }
    } else {
        // Stockage des erreurs et redirection
        $_SESSION['error'] = implode("<br>", $errors);
        $_SESSION['form_data'] = [
            'job_id' => $job_id,
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'message' => $message
        ];
        header("Location: poste.php");
        exit();
    }
} else {
    // Si accès direct au fichier
    header("Location: poste.php");
    exit();
}
?>