<?php

function genreBasedOnTemp($temp) {
    switch ($temp) {
        case ($temp < 10):
            // Classic playlist
            return "classic music";
            break;
        case ($temp >= 10 && $temp <= 14):
            // Rock playlist
            return "rock n roll";
            break;
        case ($temp >= 15 && $temp <= 30):
            // Pop playlist
            return "pop music";
            break;
        default:
            // Party playlist
        return "party music";
            break;
    }
}

function playlistTracksNames($playlist) {
    $tracksNames = [];
    foreach($playlist->items as $item) {
        $tracksNames[] = $item->track->name;
    }
    return $tracksNames;
}

function kelvinToCelsius($kelvin) {
    return ($kelvin-273.15);
}
