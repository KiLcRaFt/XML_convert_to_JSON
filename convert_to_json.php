<?php

$xmlFile = 'Kompaania.xml';
$jsonFile = 'Kompaania.json';

if (file_exists($xmlFile)) {

    $xml = simplexml_load_file($xmlFile);

    // XML-i konverteerimine JSON-i
    $json = json_encode($xml, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    // JSON-i salvestamine faili
    file_put_contents($jsonFile, $json);

    header('Content-type: application/json');
    echo $json;
} else {
    exit('Ei saa ava Kompaania.xml.');
}
