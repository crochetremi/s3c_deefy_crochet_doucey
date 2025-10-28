<?php

declare(strict_types=1);

namespace iutnc\deefy\audio\tracks;

use Exception;

class PodcastTrack extends AudioTrack
{

    protected \DateTime $date;
    protected string $auteur;

    public function __construct(string $titre, string $nomFichier)
    {
        parent::__construct($titre, $nomFichier);
        $this->date = new \DateTime();
    }

    public function setAuteur(string $auteur): void
    {
        $this->auteur = $auteur;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }
}