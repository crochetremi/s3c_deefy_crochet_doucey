// Validation du mot de passe
const indicationsValiditeMDP = {
    longueur: {
        regex: /.{8,}/,
        message: 'Au moins 8 caractères'
    },
    majuscule: {
        regex: /[A-Z]/,
        message: 'Au moins une majuscule'
    },
    minuscule: {
        regex: /[a-z]/,
        message: 'Au moins une minuscule'
    },
    chiffre: {
        regex: /[0-9]/,
        message: 'Au moins un chiffre'
    },
    special: {
        regex: /[!@#$%^&*(),.?":{}|<>]/,
        message: 'Au moins un caractère spécial'
    }
};

// Affiche les indications de validité du mot de passe
function afficherIndicationsMDP(password) {
    const indications = document.getElementById('indicationsMDP');
    if (!indications) return;

    indications.innerHTML = '';

    Object.values(indicationsValiditeMDP).forEach(indication => {
        const item = document.createElement('li');
        item.textContent = indication.message;
        const isValid = indication.regex.test(password);
        item.style.color = isValid ? '#00ff88' : '#ff4444';
        item.style.transition = 'color 0.3s ease';
        indications.appendChild(item);
    });
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    const motDePasse = document.getElementById('password');
    const indic = document.getElementById('indicationsMDP');

    if (motDePasse && indic) {
        afficherIndicationsMDP(motDePasse.value);

        motDePasse.addEventListener('input', function() {
            afficherIndicationsMDP(motDePasse.value);
        });

        motDePasse.addEventListener('focus', function() {
            indic.classList.add('show');
        });

        motDePasse.addEventListener('blur', function() {
            indic.classList.remove('show');
        });
    }
});
