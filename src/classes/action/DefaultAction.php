<?php

namespace iutnc\deefy\action;

class DefaultAction extends Action
{
    public function execute(): string
    {

        $message = "<h2 class='subtitle'>Bienvenue ! 🕺</h2>";

        // Récupère le nom de l'utilisateur connecté
        $user = $_SESSION['user'] ?? null;
        $username = $user ? htmlspecialchars($user['nom']) : 'inconnu';

        // Si l'utilisateur est connecté, affiche un message de bienvenue
        if ($user) {
            $message = "<h2 class='subtitle'>Bienvenue, $username ! 🕺</h2>";
        } else {
            $message .= "<p>Accédez à toutes les fonctionnalités de Deefy en vous connectant ou en vous inscrivant.</p>";
        }

        return $message;
    }
}