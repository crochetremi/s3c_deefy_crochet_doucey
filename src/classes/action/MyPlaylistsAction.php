<?php

namespace iutnc\deefy\action;

use iutnc\deefy\repository\DeefyRepository;

class MyPlaylistsAction extends Action
{
    public function execute(): string
    {
        if (!isset($_SESSION['user'])) {
            return '<b>Vous devez être connecté pour voir vos playlists.</b><br/><br/><button class="button" onclick="window.location.href=\'?action=signin\'">Se connecter</button>';
        }

        $userId = $_SESSION['user']['id'];
        $playlists = DeefyRepository::getInstance()->getUserPlaylists($userId);

        $html = '<h2 class="subtitle">Mes Playlists</h2>';
        if (empty($playlists)) {
            $html .= '<b>Vous n\'avez pas encore de playlists.</b><br/><br/><button class="button is-link" onclick="window.location.href=\'?action=add-playlist\'">Créer une playlist</button>';
        } else {
            $html .= '<div class="playlist-container">';
            foreach ($playlists as $playlist) {
                $html .= '<div class="playlist-card">';
                $html .= '<a href="?action=playlist&id=' . $playlist['id'] . '" class="playlist-link">' . htmlspecialchars($playlist['nom']) . '</a>';
                $html .= '</div>';
            }
            $html .= '</div>';
        }

        return $html;
    }
}