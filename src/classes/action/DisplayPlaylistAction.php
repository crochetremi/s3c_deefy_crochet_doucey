<?php

namespace iutnc\deefy\action;

use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\render\Renderer;
use iutnc\deefy\repository\DeefyRepository;

class DisplayPlaylistAction extends Action
{
    public function execute(): string
    {
        if (!isset($_SESSION['user'])) {
            return '<b>Vous devez être connecté pour voir cette playlist.</b><br/><br/><button class="button" onclick="window.location.href=\'?action=signin\'">Se connecter</button>';
        }

        if (isset($_GET['id'])) {
            $playlistId = $_GET['id'];
            $playlist = DeefyRepository::getInstance()->getPlaylist($playlistId, $_SESSION['user']['id']);

            if (!$playlist) {
                return "<b>Cette playlist n'existe pas ou n'est pas accessible 🤷‍♂️</b>";
            }

            $_SESSION['playlist'] = $playlist;
        }

        if (!isset($_SESSION['playlist'])) {
            return "<b>Aucune playlist n'est en cours d'écoute...</b>";
        }

        $playlist = $_SESSION['playlist'];
        $renderer = new AudioListRenderer($playlist);
        return $renderer->render(Renderer::COMPLET);
    }
}