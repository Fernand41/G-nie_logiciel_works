<?php
// Définition des métadonnées et assets spécifiques à cette page
$page_title = "Blockchain - Modern Solution";
$page_css = "index.css";

// Inclusion du header
require 'header.php';
?>


<main>
  <section class="hero" id="hero">
    <!-- Vidéo en arrière-plan -->
<video autoplay muted loop playsinline preload="auto" class="hero-video" poster="assets/vidéo/poster.jpg">
    <source src="assets/vidéo/video.mp4" type="video/mp4">
    <source src="assets/vidéo/video.webm" type="video/webm">
    <!-- Fallback pour les navigateurs qui ne supportent pas la vidéo -->
    <img src="assets/image/poster.jpg" alt="Background alternative">
</video>

    <!-- Contenu par-dessus -->
    <div class="hero-content">
        <h1>Révolutionner les Job's en  <span class="highlight">Informatique</span> grâce à la <span class="highlight">blockchain</span></h1>
        <p>
            Blockchain Job's a pour mission d'aider les jeunes diplômés passionnés par le Web 3 à trouver leur voie professionnelle. Notre plateforme connecte les talents aux entreprises nationales et internationales pour construire ensemble l'avenir de la blockchain.
        </p>
    </div>
</section>
   
</main>

<?php
// Inclusion du footer
require 'footer.php';
?>