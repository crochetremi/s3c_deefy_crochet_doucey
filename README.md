# Projet Deefy
L'application Deefy est un service de streaming pour l'écoute de musique. Elle s'inspire de l'application Spotify. Les utilisateurs enregistrés peuvent créer des playlists composées de pistes qu'ils ont importées.
> <i>Réalisé par Rémi Crochet et Alix Doucey</i>

---

## Fonctionnalités
- [X] Affichage de la liste des playlists de l’utilisateur authentifié ; chaque élément de la liste est cliquable et permet d’afficher une playlist qui devient la playlist courante.
- [X] Création d'une playlist (vide) : un formulaire permettant de saisir le nom d’une nouvelle playlist est affiché. À la validation, la playlist est créée et stockée dans la base de données ; elle devient la playlist courante.
- [X] Affichage de la playlist courante (stockée en session).
- [X] Inscription : création d’un compte utilisateur.
- [X] Authentification : un utilisateur enregistré peut se connecter à l'application.
- [X] L'affichage d’une playlist propose toujours d’ajouter une nouvelle piste à la playlist. Le formulaire de saisie des données de description d’une piste est affiché. À la validation, la piste est créée, enregistrée dans la base, puis ajoutée à la playlist affichée.
- [X] L'affichage d’une playlist est réservé au propriétaire de la playlist.

### Fonctionnalités supplémentaires
- [X] Lorsqu'une action n'est pas possible (utilisateur non autorisé, playlist non stockée, liste vide), l'utilisateur est averti avant qu'il ne tente d'effectuer l'action. Une alternative lui est proposée (par exemple, créer une playlist avant d'ajouter des pistes).
- [X] Un utilisateur non authentifié ne voit que les actions qu'il peut effectuer sans générer d'erreur.
- [X] Chaque utilisateur dispose d'un pseudo/nom (colonne ajoutée en base de données) pour un meilleur rendu.
- [X] Un utilisateur peut se déconnecter, ce qui efface les données en session et permet à un autre utilisateur de s'authentifier.
- [X] Lors de la création d'un compte, les contraintes pour le mot de passe (longueur, composition) s'affichent dynamiquement pour éviter les mots de passe faibles.

---

## Éléments permettant le test de l'application

### Connexion à une base de données
La configuration est faites à travers les fichiers `docker-compose.yml` et `01-init.sql`
La base de données est crée par les deux scripts situés dans le dossier mysql-init.


### Lancement du conteneur Docker
- Lancement classique par la commande :
  ```bash
  docker-compose up -d

### Pour ce qui est du test :
- Trois utilistateurs de tests sont disponibles :
  - test.user@example.com | password
  - remi.crochet@example.com | password
  - alix.doucey@example.com | password
- Il ne sera pas possible de lire les fichiers audio pour ces utilisateurs de tests. Par contre, pour les tracks ajoutées après, ce sera possible.
- Lors de l'ajout de vos propres titres, il est possible de rencontrer l'erreur suivante :
  - `Erreur : le dossier d'upload n'est pas accesible en écriture`
  - si cela venait à arriver, il suffit de faire :
  ```bash
  chmod 777 ressources/audio