<?php

declare(strict_types=1);

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\PodcastTrack;

class PodcastTrackRenderer extends AudioTrackRenderer implements Renderer
{
    private PodcastTrack $podcastTrack;

    public function __construct(PodcastTrack $podcastTrack)
    {
        parent::__construct($podcastTrack);
        $this->podcastTrack = $podcastTrack;
    }

    public function affichageCompact(): string
    {
        return "<caption><br/><details open><summary><b>" . $this->podcastTrack->titre . "</b></summary>" . $this->podcastTrack->auteur . "<br/>" . $this->podcastTrack->duree . "s</details></caption>";
    }

    public function affichageComplet(): string
    {
        return "<caption><br/><b>" . $this->podcastTrack->titre . "</b> - " . $this->podcastTrack->auteur . " - " . $this->podcastTrack->date->format('d/m/Y') . " - " . $this->podcastTrack->genre . " - " . $this->podcastTrack->duree . "s</caption>";
    }
}