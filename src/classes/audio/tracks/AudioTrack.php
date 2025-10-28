<?php

declare(strict_types=1);

namespace iutnc\deefy\audio\tracks;

use Exception;
use iutnc\deefy\exception\InvalidPropertyValueException;

class AudioTrack
{

    protected int $id;
    protected string $titre;
    protected string $nomFichier;
    protected int $duree;
    protected string $genre;

    public function __construct(string $titre, string $nomFichier)
    {
        $this->titre = $titre;
        $this->nomFichier = $nomFichier;
    }

    public function __toString(): string
    {
        return json_encode($this);
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            if (isset($this->$name)) {
                return $this->$name;
            } else {
                throw new \Exception("Property $name is not initialized");
            }
        }
        throw new \Exception("Property $name does not exist");
    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @throws InvalidPropertyValueException
     */
    public function setDuree(int $duree): void
    {
        if ($duree < 0) {
            throw new InvalidPropertyValueException("Durée invalide : $duree");
        }
        $this->duree = $duree;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

}