<?php
// Définition des métadonnées et assets spécifiques à cette page
$page_title = "Postuler";
$page_css = "poste.css";
$page_js = "poste.js";

// Démarre la session pour les messages
session_start();

// Récupérer les offres d'emploi depuis la base de données
try {
    $db = new PDO("mysql:host=localhost;dbname=blockchain_jobs;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $db->query("SELECT * FROM jobs WHERE statut = 'active' ORDER BY created_at DESC");
    $jobsFromDB = $req->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $jobsFromDB = [];
}

// Inclusion du header
require 'header.php';
?>

<main class="container">
    <!-- Hero Section -->
    <section class="hero">
        <h1>Trouvez votre emploi dans la blockchain</h1>
        <p>Découvrez les meilleures opportunités de carrière dans l'écosystème blockchain et crypto.</p>
        <div class="search-bar">
            <input type="text" placeholder="Rechercher un poste, une compétence ou une entreprise...">
            <button><i class="fas fa-search"></i> Rechercher</button>
        </div>
    </section>


    <!-- Jobs Grid -->
    <section class="jobs-grid" id="jobs-container">
        <!-- Job cards will be dynamically generated here -->
    </section>
</main>

<!-- Application Modal -->
<div class="modal" id="application-modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h2 class="modal-title">Postuler à <span id="modal-job-title">Développeur Blockchain</span></h2>
        <form id="application-form" action="traitement_candidature.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="job_id" name="job_id" value="">
            
            <div class="form-group">
                <label for="fullname">Nom complet *</label>
                <input type="text" id="fullname" name="fullname" required 
                       value="<?php echo isset($_SESSION['form_data']['fullname']) ? htmlspecialchars($_SESSION['form_data']['fullname']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required 
                       value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input type="tel" id="phone" name="phone" 
                       value="<?php echo isset($_SESSION['form_data']['phone']) ? htmlspecialchars($_SESSION['form_data']['phone']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="cv">CV (PDF uniquement, max 5MB) *</label>
                <input type="file" id="cv" name="cv" accept=".pdf" required>
            </div>
            
            <div class="form-group">
                <label for="message">Lettre de motivation *</label>
                <textarea id="message" name="message" required><?php echo isset($_SESSION['form_data']['message']) ? htmlspecialchars($_SESSION['form_data']['message']) : ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Postuler</button>
        </form>
    </div>
</div>

<script>
// Convertir les données PHP en JavaScript
const jobsFromDB = <?php echo json_encode($jobsFromDB); ?>;

// Jobs par défaut si la base est vide
const defaultJobs = [
    {
        id: 1,
        title: "Développeur Blockchain Solidity",
        company: "CryptoCorp",
        location: "Paris, France",
        remote: "Hybride",
        type: "CDI",
        experience: "Intermédiaire",
        salary: "70k-90k €",
        description: "Nous recherchons un développeur Solidity expérimenté pour rejoindre notre équipe de développement DeFi.",
        tags: ["Solidity", "Ethereum", "DeFi", "Smart Contracts"]
    },
    {
        id: 2,
        title: "Ingénieur Rust Blockchain",
        company: "Web3Solutions",
        location: "Lyon, France",
        remote: "100% remote",
        type: "CDI",
        experience: "Senior",
        salary: "80k-100k €",
        description: "Rejoignez notre équipe pour développer la prochaine génération de protocoles blockchain en Rust.",
        tags: ["Rust", "Substrate", "Polkadot", "Web3"]
    },
    {
        id: 3,
        title: "Architecte Blockchain",
        company: "ChainTech",
        location: "Toulouse, France",
        remote: "Sur site",
        type: "CDI",
        experience: "Senior",
        salary: "90k-110k €",
        description: "Concevez et implémentez des solutions blockchain enterprise pour nos clients.",
        tags: ["Hyperledger", "Architecture", "Enterprise", "Solutions"]
    },
    {
        id: 4,
        title: "Développeur Web3 Frontend",
        company: "DAppFactory",
        location: "Bordeaux, France",
        remote: "Hybride",
        type: "CDI",
        experience: "Intermédiaire",
        salary: "50k-70k €",
        description: "Créez des interfaces utilisateur intuitives pour des applications décentralisées.",
        tags: ["React", "Web3.js", "Ethers.js", "DApps"]
    },
    {
        id: 5,
        title: "Expert Smart Contracts",
        company: "SecureBlock",
        location: "Nantes, France",
        remote: "100% remote",
        type: "Freelance",
        experience: "Senior",
        salary: "€€€",
        description: "Audit et développement de smart contracts sécurisés pour divers projets blockchain.",
        tags: ["Audit", "Sécurité", "Solidity", "Smart Contracts"]
    },
    {
        id: 6,
        title: "Stagiaire Développement Blockchain",
        company: "BlockStart",
        location: "Lille, France",
        remote: "Sur site",
        type: "Stage",
        experience: "Junior",
        salary: "Indemnités",
        description: "Opportunité de stage pour apprendre le développement blockchain avec notre équipe.",
        tags: ["Apprentissage", "Solidity", "JavaScript", "Stage"]
    }
];

// Utiliser les jobs de la base ou les jobs par défaut
const jobs = jobsFromDB.length > 0 ? jobsFromDB.map(job => ({
    id: job.id,
    title: job.title,
    company: job.company,
    location: job.location,
    remote: job.remote,
    type: job.type,
    experience: job.experience,
    salary: job.salary,
    description: job.description,
    tags: job.tags ? job.tags.split(',').map(tag => tag.trim()) : []
})) : defaultJobs;

// Le reste du code JavaScript reste identique
</script>

<script>
// DOM elements
const jobsContainer = document.getElementById('jobs-container');
const applicationModal = document.getElementById('application-modal');
const modalJobTitle = document.getElementById('modal-job-title');
const jobIdInput = document.getElementById('job_id');
const closeModalBtn = document.querySelector('.close-modal');
const applicationForm = document.getElementById('application-form');
const searchInput = document.querySelector('.search-bar input');
const searchButton = document.querySelector('.search-bar button');

// Display jobs
function displayJobs(jobsToDisplay) {
    jobsContainer.innerHTML = '';
    
    if (jobsToDisplay.length === 0) {
        jobsContainer.innerHTML = '<p class="no-results">Aucun emploi ne correspond à vos critères.</p>';
        return;
    }
    
    jobsToDisplay.forEach(job => {
        const jobCard = document.createElement('div');
        jobCard.classList.add('job-card');
        
        jobCard.innerHTML = `
            <div class="job-header">
                <h3 class="job-title">${job.title}</h3>
                <p class="job-company">${job.company} • ${job.location}</p>
                <div class="job-tags">
                    <span class="tag">${job.type}</span>
                    <span class="tag">${job.experience}</span>
                    <span class="tag tag-remote">${job.remote}</span>
                </div>
            </div>
            <div class="job-body">
                <p class="job-description">${job.description}</p>
                <div class="job-details">
                    <div class="job-detail">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Salaire: ${job.salary}</span>
                    </div>
                </div>
                <div class="job-footer">
                    <div class="job-tags">
                        ${job.tags.map(tag => `<span class="tag">${tag}</span>`).join('')}
                    </div>
                    <button class="btn btn-primary apply-btn" data-id="${job.id}">Postuler</button>
                </div>
            </div>
        `;
        
        jobsContainer.appendChild(jobCard);
    });
    
    // Add event listeners to apply buttons
    document.querySelectorAll('.apply-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const jobId = e.target.getAttribute('data-id');
            openApplicationModal(jobId);
        });
    });
}

// Open application modal
function openApplicationModal(jobId) {
    const job = jobs.find(j => j.id == jobId);
    if (job) {
        modalJobTitle.textContent = job.title;
        jobIdInput.value = jobId;
        applicationModal.style.display = 'flex';
    }
}

// Close modal
function closeModal() {
    applicationModal.style.display = 'none';
    applicationForm.reset();
}

// Filter jobs based on search input
function filterJobs() {
    const searchText = searchInput.value.toLowerCase();
    
    const filteredJobs = jobs.filter(job => {
        return job.title.toLowerCase().includes(searchText) ||
               job.company.toLowerCase().includes(searchText) ||
               job.description.toLowerCase().includes(searchText) ||
               job.tags.some(tag => tag.toLowerCase().includes(searchText));
    });
    
    displayJobs(filteredJobs);
}

// Event listeners
searchInput.addEventListener('input', filterJobs);
searchButton.addEventListener('click', filterJobs);

closeModalBtn.addEventListener('click', closeModal);

window.addEventListener('click', (e) => {
    if (e.target === applicationModal) {
        closeModal();
    }
});

// Validation du formulaire côté client
applicationForm.addEventListener('submit', function(e) {
    const cvInput = document.getElementById('cv');
    const file = cvInput.files[0];
    
    if (file) {
        // Vérification du type de fichier
        if (file.type !== 'application/pdf') {
            e.preventDefault();
            alert('Veuillez sélectionner un fichier PDF.');
            return;
        }
        
        // Vérification de la taille (5MB)
        if (file.size > 5 * 1024 * 1024) {
            e.preventDefault();
            alert('Le fichier ne doit pas dépasser 5MB.');
            return;
        }
    }
});

// Initialize
displayJobs(jobs);
</script>

<?php
// Nettoyer les données de formulaire stockées
unset($_SESSION['form_data']);

// Inclusion du footer 
require 'footer.php';
?>