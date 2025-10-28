<?php

declare(strict_types=1);

namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\audio\tracks\AudioTrack;

class AlbumTrack extends AudioTrack
{

    protected string $artiste;
    protected string $album;
    protected int $annee;
    protected int $numPiste;

    public function __construct(string $titre, string $nomFichier, string $album, int $numPiste)
    {
        parent::__construct($titre, $nomFichier);
        $this->album = $album;
        $this->numPiste = $numPiste;
    }

    public function setArtiste(string $artiste): void
    {
        $this->artiste = $artiste;
    }

    public function setAnnee(int $annee): void
    {
        $this->annee = $annee;
    }

}