
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
            
            <section class="social-links">
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
                        <a href="">
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

<!-- Scripts JS spécifiques aux pages -->
<?php if (isset($page_js)): ?>
    <script src="assets/js/<?php echo $page_js; ?>"></script>
<?php endif; ?>

<!-- Scripts JS communs -->
<script src="assets/js/script.js"></script>
</body>
</html>