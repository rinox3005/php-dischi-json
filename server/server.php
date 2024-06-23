<?php
// Dico che questo contenuto deve essere interpretato come JSON
header('Content-Type: application/json');

// Prendo il file JSON
$musicDiscs = file_get_contents(__DIR__ . '/musicDiscs.json');

// Verifico se il JSON è stato caricato correttamente
if ($musicDiscs === false) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Failed to load music discs."]);
    exit;
}

// Converto il JSON in array associativo manipolabile da PHP
$discsToSearch = json_decode($musicDiscs, true);

// Verifico se il JSON è stato decodificato correttamente
if ($discsToSearch === null) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Failed to decode music discs JSON."]);
    exit;
}

// Funzione per cercare un disco in un array di dischi basato sull'ID
function searchDiscById($id, $discsToSearch)
{
    foreach ($discsToSearch as $disc) {
        if ($disc['id'] === $id) {
            return $disc;
        }
    }
    return null;
}

// Se l'ID è specificato, cerco il disco corrispondente
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Converto l'ID in un intero
    $disc = searchDiscById($id, $discsToSearch);
    if ($disc) {
        echo json_encode($disc);
    } else {
        echo json_encode(["error" => "Disc not found for ID: $id"]);
    }
} else {
    // Se l'ID non è specificato, restituisco l'intero elenco di dischi
    echo $musicDiscs;
}
