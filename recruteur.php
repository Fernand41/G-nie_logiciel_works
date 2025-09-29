<?php
// Définition des métadonnées
$page_title = "Espace Recruteur";
$page_css = "recruteur.css";
$page_js = "recruteur.js";

// Démarre la session pour les messages
session_start();

// Inclusion du header
require 'header.php';
?>

<main class="container">
    <!-- Hero Section -->
    <section class="hero">
        <h1>Espace Recruteur</h1>
        <p>Publiez vos offres d'emploi blockchain et trouvez les meilleurs talents</p>
    </section>


    <!-- Formulaire de publication d'offre -->
    <section class="form-section">
        <div class="form-container">
            <h2>Publier une nouvelle offre d'emploi</h2>
            <form method="POST" action="traitement_offre.php">
                
                <!-- Ligne 1 : Titre + Entreprise -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Titre du poste *</label>
                        <input type="text" id="title" name="title" required 
                               placeholder="Ex: Développeur Blockchain Solidity"
                               value="<?php echo isset($_SESSION['form_data']['title']) ? htmlspecialchars($_SESSION['form_data']['title']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="company">Entreprise *</label>
                        <input type="text" id="company" name="company" required 
                               placeholder="Nom de votre entreprise"
                               value="<?php echo isset($_SESSION['form_data']['company']) ? htmlspecialchars($_SESSION['form_data']['company']) : ''; ?>">
                    </div>
                </div>

                <!-- Ligne 2 : Localisation + Type de travail -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="location">Localisation</label>
                        <input type="text" id="location" name="location" 
                               placeholder="Ex: Paris, France"
                               value="<?php echo isset($_SESSION['form_data']['location']) ? htmlspecialchars($_SESSION['form_data']['location']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="remote">Type de travail</label>
                        <select id="remote" name="remote" required>
                            <option value="Sur site" <?php echo (isset($_SESSION['form_data']['remote']) && $_SESSION['form_data']['remote'] == 'Sur site') ? 'selected' : ''; ?>>Sur site</option>
                            <option value="Hybride" <?php echo (isset($_SESSION['form_data']['remote']) && $_SESSION['form_data']['remote'] == 'Hybride') ? 'selected' : ''; ?>>Hybride</option>
                            <option value="100% remote" <?php echo (isset($_SESSION['form_data']['remote']) && $_SESSION['form_data']['remote'] == '100% remote') ? 'selected' : ''; ?>>100% remote</option>
                        </select>
                    </div>
                </div>

                <!-- Ligne 3 : Type de contrat + Expérience -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="type">Type de contrat</label>
                        <select id="type" name="type" required>
                            <option value="CDI" <?php echo (isset($_SESSION['form_data']['type']) && $_SESSION['form_data']['type'] == 'CDI') ? 'selected' : ''; ?>>CDI</option>
                            <option value="CDD" <?php echo (isset($_SESSION['form_data']['type']) && $_SESSION['form_data']['type'] == 'CDD') ? 'selected' : ''; ?>>CDD</option>
                            <option value="Freelance" <?php echo (isset($_SESSION['form_data']['type']) && $_SESSION['form_data']['type'] == 'Freelance') ? 'selected' : ''; ?>>Freelance</option>
                            <option value="Stage" <?php echo (isset($_SESSION['form_data']['type']) && $_SESSION['form_data']['type'] == 'Stage') ? 'selected' : ''; ?>>Stage</option>
                            <option value="Alternance" <?php echo (isset($_SESSION['form_data']['type']) && $_SESSION['form_data']['type'] == 'Alternance') ? 'selected' : ''; ?>>Alternance</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="experience">Niveau d'expérience</label>
                        <select id="experience" name="experience" required>
                            <option value="Junior" <?php echo (isset($_SESSION['form_data']['experience']) && $_SESSION['form_data']['experience'] == 'Junior') ? 'selected' : ''; ?>>Junior</option>
                            <option value="Intermédiaire" <?php echo (isset($_SESSION['form_data']['experience']) && $_SESSION['form_data']['experience'] == 'Intermédiaire') ? 'selected' : ''; ?>>Intermédiaire</option>
                            <option value="Senior" <?php echo (isset($_SESSION['form_data']['experience']) && $_SESSION['form_data']['experience'] == 'Senior') ? 'selected' : ''; ?>>Senior</option>
                            <option value="Expert" <?php echo (isset($_SESSION['form_data']['experience']) && $_SESSION['form_data']['experience'] == 'Expert') ? 'selected' : ''; ?>>Expert</option>
                        </select>
                    </div>
                </div>

                <!-- Salaire -->
                <div class="form-group">
                    <label for="salary">Salaire</label>
                    <input type="text" id="salary" name="salary" 
                           placeholder="Ex: 50k-70k € ou À négocier"
                           value="<?php echo isset($_SESSION['form_data']['salary']) ? htmlspecialchars($_SESSION['form_data']['salary']) : ''; ?>">
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description du poste *</label>
                    <textarea id="description" name="description" required 
                              placeholder="Décrivez les missions, responsabilités et compétences requises..."
                              rows="5"><?php echo isset($_SESSION['form_data']['description']) ? htmlspecialchars($_SESSION['form_data']['description']) : ''; ?></textarea>
                </div>

                <!-- Tags -->
                <div class="form-group">
                    <label for="tags">Compétences recherchées</label>
                    <input type="text" id="tags" name="tags" 
                           placeholder="Ex: Solidity, Ethereum, Smart Contracts, Web3 (séparées par des virgules)"
                           value="<?php echo isset($_SESSION['form_data']['tags']) ? htmlspecialchars($_SESSION['form_data']['tags']) : ''; ?>">
                    <small>Séparez les compétences par des virgules</small>
                </div>

                <!-- Bouton -->
                <button type="submit" name="publier_offre" class="btn btn-primary btn-large">Publier l'offre</button>
            </form>
        </div>
    </section>


</main>

<?php
// Nettoyer les données de formulaire stockées
unset($_SESSION['form_data']);

// Inclusion du footer 
require 'footer.php';
?>
