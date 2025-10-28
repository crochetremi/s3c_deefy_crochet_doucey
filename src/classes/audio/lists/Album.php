<?php

namespace iutnc\deefy\audio\lists;

use iutnc\deefy\audio\lists\AudioList;

class Album extends AudioList
{

    private string $artiste;
    private string $dateSortie;

    public function __construct(string $nom, string $artiste, string $dateSortie, array $listePistes)
    {
        parent::__construct($nom, $listePistes);
        $this->artiste = $artiste;
        $this->dateSortie = $dateSortie;
        $this->nbPistes = count($listePistes);
        $this->dureeTotale = $this->calculerDureeTotale();
    }

    public function setArtiste(string $artiste): void
    {
        $this->artiste = $artiste;
    }

    public function setDateSortie(string $dateSortie): void
    {
        $this->dateSortie = $dateSortie;
    }

    public function getArtiste(): string
    {
        return $this->artiste;
    }

    public function getDateSortie(): string
    {
        return $this->dateSortie;
    }

}