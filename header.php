<?php
// Définition du titre de la page si non défini
if (!isset($page_title)) {
    $page_title = "Blockchain - Modern Solution";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
     <link rel="stylesheet" href="assets/css/footer.css">
    <?php if (isset($page_css)): ?>
        <link rel="stylesheet" href="assets/css/<?php echo $page_css; ?>">
    <?php endif; ?>
</head>
<body>

<!-- Barre de navigation -->
<header class="header">
    <nav class="navbar">
        <!-- Logo -->
     <!-- Logo -->
<div class="logo">
    <span class="logo-text">Blockchain Job's</span>
</div>
        <!-- Bouton Contact (visible sur mobile) -->
        <a href="contact.php" class="btn-contact mobile-contact">Contact</a>

        <!-- Liens de navigation -->
        <ul class="nav-links">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="poste.php">Poste</a></li>
            <li><a href="singup.php">Recruteur</a></li>
     
        </ul>

        <!-- Bouton Contact (visible sur desktop) -->
        <a href="contact.php" class="btn-contact desktop-contact">Contact</a>

        <!-- Menu Burger -->
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
</header>
<!-- Scripts JavaScript pour le header -->
<script src="assets/js/header.js"></script>