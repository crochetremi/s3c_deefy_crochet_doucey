<?php

namespace iutnc\deefy\action;

use iutnc\deefy\auth\AuthnProvider;
use iutnc\deefy\exception\AuthnException;

class SigninAction extends Action
{

    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Affichage du formulaire
            return $this->displayForm();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Gestion de la connection, méthode handle
            return $this->handleFormSubmission();
        }
        return '';
    }

    private function displayForm(): string {
    return <<<HTML
    <div class="container">
        <h1 class="subtitle">Connexion</h1>
        <form method="POST" action="">
            <div class="field">
                <label class="label" for="email">Email</label>
                <div class="control">
                    <input class="input" type="email" id="email" name="email" required
                           placeholder="votre.email@example.com">
                </div>
            </div>
            <div class="field">
                <label class="label" for="passwd">Mot de passe</label>
                <div class="control">
                    <input class="input" type="password" id="passwd" name="passwd" required>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button" type="submit">Se connecter</button>
                </div>
            </div>
        </form>
        <p>Pas encore de compte ? <a href="?action=register">Inscrivez-vous</a></p>
    </div>
    HTML;
}

    private function handleFormSubmission(): ?string
    {
        $email = $_POST['email'];
        $password = $_POST['passwd'];

        try {
            $user = AuthnProvider::signin($email, $password);
            $_SESSION['user'] = $user;

            // Retour à la page d'accueil
            header('Location: ?action=default');

        } catch (AuthnException $e) {
            return 'Erreur d\'authentification : ' . htmlspecialchars($e->getMessage());
        }
        return null;
    }

}
