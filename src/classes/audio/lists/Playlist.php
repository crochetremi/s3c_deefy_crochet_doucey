<?php

declare(strict_types=1);

namespace iutnc\deefy\audio\lists;

use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\exception\InvalidPropertyValueException;

class Playlist extends AudioList
{

    public function __construct(string $nom, array $listePistes = [])
    {
        parent::__construct($nom, $listePistes);
    }

    public function addTrack(AudioTrack $track): void
    {
        $this->listePistes[] = $track;
        $this->nbPistes++;
        $this->dureeTotale += $track->duree;
    }

    public function removeTrack(int $numPiste): void
    {
        if ($numPiste < 0 || $numPiste >= count($this->listePistes)) {
            throw new InvalidPropertyValueException("Invalid track number : $numPiste");
        }
        $this->nbPistes--;
        $this->dureeTotale -= $this->listePistes[$numPiste]->duree;
        array_splice($this->listePistes, $numPiste, 1);
    }

    public function addTracks(AudioTrack $tracks): void
    {
        foreach ($tracks as $track) {
            if (!in_array($track, $this->listePistes)) {
                $this->listePistes[] = $track;
                $this->nbPistes++;
                $this->dureeTotale += $track->duree;
            }
        }
    }

}