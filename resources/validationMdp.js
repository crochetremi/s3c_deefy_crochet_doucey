// Indications de validité de mot de passe
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
}


// Affiche les indications de validité du mot de passe
function afficherIndicationsMDP(password) {
    let indications = document.getElementById('indicationsMDP');
    indications.classList.add('help');
    indications.innerHTML = 'Votre mot de passe doit contenir :';
    Object.values(indicationsValiditeMDP).forEach(indication => {
        let item = document.createElement('li');
        item.textContent = indication.message;
        item.style.color = indication.regex.test(password) ? 'green' : 'red';
        item.style.marginLeft = '20px';
        indications.appendChild(item);
    });
}

// Vérifie la validité du mot de passe à chaque saisie
let motDePasse = document.getElementById('password');
let indic = document.getElementById('indicationsMDP');

if (motDePasse && indic) {
    motDePasse.addEventListener('input', function () {
        let password = motDePasse.value;
        afficherIndicationsMDP(password);
    });
    afficherIndicationsMDP(motDePasse.value);

    motDePasse.addEventListener('focus', function () {
        let indications = document.getElementById('indicationsMDP');
        indications.classList.add('show');
    });

    motDePasse.addEventListener('blur', function () {
        let indications = document.getElementById('indicationsMDP');
        indications.classList.remove('show');
    });
}