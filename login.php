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

// Vérifie si le formulaire a bien été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Vérifie que les champs ne sont pas vides
    if (!empty($email) && !empty($password)) {

        // Prépare une requête SQL sécurisée pour chercher l'entreprise
        $req = $db->prepare("SELECT * FROM entreprises WHERE email = :email");
        $req->execute(['email' => $email]);
        $entreprise = $req->fetch();

        // Vérifie que l'entreprise existe ET que le mot de passe est correct
        if ($entreprise && password_verify($password, $entreprise['password'])) {
            
            // ✅ Connexion réussie
            // Stocke les infos de l'entreprise dans la session
            $_SESSION['entreprise'] = $entreprise;

            // Redirige vers la page principale
            header("Location: recruteur.php");
            exit();
        } else {
            // Mauvais mot de passe ou email inconnu
            $_SESSION['error'] = "Email ou mot de passe incorrect.";
        }
    } else {
        // L'utilisateur n'a pas rempli tous les champs
        $_SESSION['error'] = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Entreprise - Blockchain Job's</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container">
        <form id="login-form" method="POST" action="">
            <h2>Heureux de vous revoir</h2>
            <p class="subtitle">Connectez-vous pour gérer vos offres d'emploi blockchain</p>

            <div class="form-group">
                <label for="email">Email de l'entreprise</label>
                <input type="email" id="email" name="email" required 
                       placeholder="Entrez l'email de votre entreprise"
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required 
                           placeholder="Entrez votre mot de passe">
                    <span class="toggle-password" onclick="togglePassword('password', this)">👁️</span>
                </div>
            </div>

            <button type="submit" class="btn" name="ok">Se connecter</button>
            
            <div style="margin: 20px 0; text-align: center; color: #999; position: relative;">
                <span style="background: #fff; padding: 0 10px; position: relative; z-index: 1;">ou</span>
                <div style="height: 1px; background: #eee; position: absolute; top: 50%; left: 0; right: 0; z-index: 0;"></div>
            </div>
            
            <button type="button" class="google-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25C22.56 11.47 22.49 10.72 22.36 10H12V14.26H17.92C17.66 15.63 16.88 16.79 15.71 17.57V20.34H19.28C21.36 18.42 22.56 15.6 22.56 12.25Z" fill="#4285F4"/>
                    <path d="M12 23C14.97 23 17.46 22.02 19.28 20.34L15.71 17.57C14.73 18.23 13.48 18.63 12 18.63C9.14 18.63 6.72 16.7 5.84 14.1H2.18V16.94C4 20.53 7.7 23 12 23Z" fill="#34A853"/>
                    <path d="M5.84 14.1C5.62 13.43 5.5 12.72 5.5 12C5.5 11.28 5.62 10.57 5.84 9.9V7.06H2.18C1.43 8.55 1 10.22 1 12C1 13.78 1.43 15.45 2.18 16.94L5.84 14.1Z" fill="#FBBC05"/>
                    <path d="M12 5.38C13.62 5.38 15.06 5.94 16.21 7.02L19.36 3.87C17.45 2.09 14.97 1 12 1C7.7 1 4 3.47 2.18 7.06L5.84 9.9C6.72 7.3 9.14 5.38 12 5.38Z" fill="#EA4335"/>
                </svg>
                Continuer avec Google
            </button>
            
            <p class="footer-text">Pas encore inscrit ? <a href="singup.php" class="link">Créer un compte entreprise</a></p>
        </form>
    </div>

    <script>
        function togglePassword(inputId, element) {
            const passwordInput = document.getElementById(inputId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                element.textContent = '👁️';
            } else {
                passwordInput.type = 'password';
                element.textContent = '👁️';
            }
        }
    </script>
</body>
</html>