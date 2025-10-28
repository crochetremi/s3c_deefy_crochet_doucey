<?php

declare(strict_types=1);

namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\Album;
use iutnc\deefy\audio\lists\AudioList;

class AudioListRenderer implements Renderer
{
    private AudioList $audioList;

    public function __construct(AudioList $audioList)
    {
        $this->audioList = $audioList;
    }

    public function render(int $selector = 0): string
    {
        $liste = "<b>" . $this->audioList->nom . "</b>";

        // Si l'audio liste est un album, on affiche l'artiste et la date de sortie
        if ($this->audioList instanceof Album) {
            $liste .= " de " . $this->audioList->getArtiste() . " (" . $this->audioList->getDateSortie() . ")";
        }

        $liste .= " - " . count($this->audioList->listePistes) . " pistes (" .
            $this->convertToMinutes($this->audioList->dureeTotale) . ") <br/><br/>" .
            $this->renderCompact() . "<hr/>";

        return $liste;
    }

    protected function renderCompact(): string
    {
        $output = "<div class='audio-list'>";
        foreach ($this->audioList as $track) {
            $renderer = RendererFactory::getRenderer($track);
            $output .= $renderer->render(Renderer::COMPLET);
        }
        $output .= "</div>";
        return $output;
    }

    private function convertToMinutes(int $seconds): string
    {
        $minutes = floor($seconds / 60);
        $seconds = $seconds % 60;
        if ($minutes < 1) {
            return $seconds . " secondes";
        } else if ($seconds === 0) {
            return $minutes . " minutes";
        } else {
            return $minutes . " minutes " . $seconds . " secondes";
        }
    }
}