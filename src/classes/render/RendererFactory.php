<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

class RendererFactory
{
    public static function getRenderer($track): PodcastTrackRenderer|AlbumTrackRenderer
    {
        if ($track instanceof AlbumTrack) {
            return new AlbumTrackRenderer($track);
        } elseif ($track instanceof PodcastTrack) {
            return new PodcastTrackRenderer($track);
        } else {
            throw new \InvalidArgumentException("Type de pistes non supportées dans la factory de renderer");
        }
    }
}