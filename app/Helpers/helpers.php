<?php

function playlistBasedOnTemp($temp) {
    switch ($temp) {
        case ($temp < 10):
            // Classic playlist
            return "5ggSdArYBwNDU95ePtnPYG";
            break;
        case ($temp >= 10 && $temp <= 14):
            // Rock playlist
            return "0dRdi9ghHuB3HUJPJ2pZNL";
            break;
        case ($temp >= 15 && $temp <= 30):
            // Pop playlist
            return "5sTHqyG2DAwmTCopHXHRdz";
            break;
        default:
            // Party playlist
        return "0iXxGK2xnmNyzm8WsB1Oss";
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
