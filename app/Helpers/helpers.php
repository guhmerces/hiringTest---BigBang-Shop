<?php

function playlistBasedOnTemp($temp) {
    switch ($temp) {
        case ($temp < 10):
            return "5ggSdArYBwNDU95ePtnPYG";
            break;
        case ($temp >= 10 && $temp <= 14):
            return "0dRdi9ghHuB3HUJPJ2pZNL";
            break;
        case ($temp >= 15 && $temp <= 30):
            return "5sTHqyG2DAwmTCopHXHRdz";
            break;
        default:
        return "0iXxGK2xnmNyzm8WsB1Oss";
            break;
    }
}

function playlistTracksNames($playlist) {
    $tracks = [];
    foreach($playlist->items as $item) {
        $tracks[] = $item->track->name;
    }
    return $tracks;
}

function kelvinToCelsius($kelvin) {
    return ($kelvin-273.15);
}
