<?php
// Définition des métadonnées et assets spécifiques à cette page
$page_title = "Blockchain - Modern Solution";
$page_css = "contact.css";
$page_js = "contact.js";

// Inclusion du header
require 'header.php';
?>
 <main>
        <div class="container">
            <header>
                <div class="logo">
                    <h1>Contacter Blockchain Job's</h1>
                </div>
            </header>
            
            <div class="contact-content">
                <div class="contact-form">
                    <h2 class="section-title">Envoyer un message</h2>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" id="name" placeholder="Votre nom complet" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="Votre adresse email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" placeholder="Votre message" required></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">Envoyer</button>
                    </form>
                </div>
                
                <div class="contact-info">
                    <div class="info-section">
                        <h2>Ensemble</h2>
                        <div class="info-item">
                            <h3>Nos Coordonnées</h3>
                            <p><strong>Adresse :</strong> Cotonou, Bénin</p>
                            <p><strong>Téléphone :</strong> +229 01 54 00 62 06</p>
                            <p><strong>Email :</strong>blockchainjo'bs.org</p>
                        </div>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <div class="info-section">
                        <h2>Suivez-nous</h2>
                        <div class="social-links-contact">
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                            <a href=""><i class="fab fa-telegram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <section class="newsletter-section">
                <h2>Inscrivez-vous à notre newsletter</h2>
                <p>Pour rester informé des nouveautés et des mises à jour.</p>
                
                <div class="email-input">
                    <input type="email" placeholder="Entrez votre email">
                    <button class="subscribe-btn">S'abonner</button>
                </div>
                
                <p class="privacy-note">En vous abonnant, vous acceptez notre politique de confidentialité et recevez des mises à jour.</p>
            </section>
            
            <section class="menu-links">
                <h3>Menu</h3>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Poste</a></li>
                    <li><a href="#">Recruteur</a></li>
                    <li><a href="#">Contact</a></li>
                   
                </ul>
            </section>
            
            <section class="footer-social-links">
                <h3>Suivez-nous</h3>
                <ul>
                    <li>
                        <a href="">
                            <span class="social-icon"><i class="fab fa-facebook-f"></i></span>
                            <span>Facebook</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="social-icon"><i class="fab fa-twitter"></i></span>
                            <span>Twitter</span>
                        </a>
                    </li>
                    <li>
                        <a href="h">
                            <span class="social-icon"><i class="fab fa-linkedin-in"></i></span>
                            <span>LinkedIn</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="social-icon"><i class="fab fa-telegram-plane"></i></span>
                            <span>Telegram</span>
                        </a>
                    </li>
                </ul>
            </section>
        </div>
        
        <div class="bottom-footer">
            <div class="copyright">© 2024 Blockchain Job's. Tous droits réservés.</div>
            <div class="legal-links">
                <a href="#">Politique de confidentialité</a>
                <a href="#">Conditions d'utilisation</a>
                <a href="#">Paramètres des cookies</a>
            </div>
        </div>
    </footer>

    <script>
        // Script pour gérer la soumission du formulaire
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Merci pour votre message! Nous vous répondrons bientôt.');
            this.reset();
        });
    </script>

<?php

?>