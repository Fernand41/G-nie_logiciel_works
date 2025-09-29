// Prévisualisation en temps réel
document.addEventListener('DOMContentLoaded', function() {
    // Éléments du formulaire
    const titleInput = document.getElementById('title');
    const companyInput = document.getElementById('company');
    const locationInput = document.getElementById('location');
    const remoteSelect = document.getElementById('remote');
    const typeSelect = document.getElementById('type');
    const experienceSelect = document.getElementById('experience');
    const salaryInput = document.getElementById('salary');
    const descriptionInput = document.getElementById('description');
    const tagsInput = document.getElementById('tags');

    // Éléments de prévisualisation
    const previewTitle = document.getElementById('preview-title');
    const previewCompany = document.getElementById('preview-company');
    const previewType = document.getElementById('preview-type');
    const previewExperience = document.getElementById('preview-experience');
    const previewRemote = document.getElementById('preview-remote');
    const previewSalary = document.getElementById('preview-salary');
    const previewDescription = document.getElementById('preview-description');
    const previewTags = document.getElementById('preview-tags');

    // Mise à jour de la prévisualisation
    function updatePreview() {
        // Titre et entreprise
        previewTitle.textContent = titleInput.value || 'Titre du poste';
        previewCompany.textContent = `${companyInput.value || 'Entreprise'} • ${locationInput.value || 'Localisation'}`;
        
        // Tags de base
        previewType.textContent = typeSelect.value;
        previewExperience.textContent = experienceSelect.value;
        previewRemote.textContent = remoteSelect.value;
        
        // Salaire
        previewSalary.textContent = salaryInput.value || 'Non spécifié';
        
        // Description
        previewDescription.textContent = descriptionInput.value || 'Description apparaîtra ici...';
        
        // Tags de compétences
        if (tagsInput.value) {
            const tagsArray = tagsInput.value.split(',').map(tag => tag.trim()).filter(tag => tag);
            previewTags.innerHTML = tagsArray.map(tag => `<span class="tag">${tag}</span>`).join('');
        } else {
            previewTags.innerHTML = '<span class="tag">Compétences</span>';
        }
    }

    // Écouteurs d'événements
    [titleInput, companyInput, locationInput, salaryInput, descriptionInput, tagsInput].forEach(input => {
        input.addEventListener('input', updatePreview);
    });

    [remoteSelect, typeSelect, experienceSelect].forEach(select => {
        select.addEventListener('change', updatePreview);
    });

    // Initialisation
    updatePreview();
});