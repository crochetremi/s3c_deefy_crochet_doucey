<?php

declare(strict_types=1);

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AlbumTrack;

class AlbumTrackRenderer extends AudioTrackRenderer implements Renderer
{
    private AlbumTrack $albumTrack;

    public function __construct(AlbumTrack $albumTrack)
    {
        parent::__construct($albumTrack);
        $this->albumTrack = $albumTrack;
    }

    public function affichageCompact(): string
    {
        return "<caption><br/><details open><summary><b>" . $this->albumTrack->titre . "</b></summary>" . $this->albumTrack->artiste . "<br/>" . $this->albumTrack->album . "<br/>Piste " . $this->albumTrack->numPiste . "<br/>" . $this->albumTrack->duree . "s</details></caption>";
    }

    public function affichageComplet(): string
    {
        return "<caption><br/><b>" . $this->albumTrack->titre . "</b> - " . $this->albumTrack->artiste . " - " . $this->albumTrack->album . " - " . $this->albumTrack->annee . " - Piste " . $this->albumTrack->numPiste . " - " . $this->albumTrack->genre . " - " . $this->albumTrack->duree . "s</caption>";
    }
}