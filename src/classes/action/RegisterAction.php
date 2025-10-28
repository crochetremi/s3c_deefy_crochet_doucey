<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository;

class RegisterAction extends Action
{

    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Display the register form
            return $this->displayForm();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle the register form submission
            return $this->handleFormSubmission();
        }
        return '';
    }

    private function displayForm(): string
    {
        return '<form method="post" action="?action=register">
    <div class="field">
        <label class="label" for="username">Nom</label>
        <div class="control">
            <input class="input" type="text" id="username" name="username" required>
        </div>
    </div>
    <div class="field">
        <label class="label" for="email">Email</label>
        <div class="control">
            <input class="input" type="email" id="email" name="email" required>
        </div>
    </div>
    <div class="field">
        <label class="label" for="password">Mot de passe</label>
        <div class="control">
            <input class="input" type="password" id="password" name="password" required>
        </div>
    </div>
    <ul id="indicationsMDP"></ul>
    <div class="field">
        <div class="control">
            <button class="button is-link" type="submit">S\'inscrire</button>
        </div>
    </div>
</form>
<script src="resources/validationMdp.js"></script>';
    }

    private function handleFormSubmission(): ?string
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return '<b>Email invalide</b><br/><br/><button class="button" onclick="window.location.href=\'?action=register\'">Réessayer</button>';
        }

        if (strlen($password) < 8) {
            return '<b>Mot de passe trop court</b><br/><br/><button class="button" onclick="window.location.href=\'?action=register\'">Réessayer</button>';
        }

        if (DeefyRepository::getInstance()->getUserByEmail($email)) {
            return '<b>Email déjà utilisé</b><br/><br/><button class="button" onclick="window.location.href=\'?action=register\'">Réessayer</button>';
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        DeefyRepository::getInstance()->saveUser($username, $email, $hashedPassword);

        return '<b>Inscription réussie !</b><br/><br/><button class="button" onclick="window.location.href=\'?action=signin\'">Se connecter</button>';
    }

}