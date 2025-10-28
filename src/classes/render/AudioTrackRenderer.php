<?php

declare(strict_types=1);

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AudioTrack;

abstract class AudioTrackRenderer implements Renderer
{
    protected AudioTrack $track;

    public function __construct($track)
    {
        $this->track = $track;
    }

    public function render(int $selector): string
    {
        return "<div class='audio-container' style='display: flex;'>
                    <audio controls>
                        <source src='./resources/audio/" . $this->track->nomFichier . "' type='audio/mpeg'>
                    </audio>
                    <div style='margin-left: 30px;'>
                        " . ($selector === Renderer::COMPACT ? $this->affichageCompact() : $this->affichageComplet()) . "
                    </div>
                  </div>";
    }

    abstract protected function affichageCompact(): string;

    abstract protected function affichageComplet(): string;
}