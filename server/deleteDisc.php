<?php
// Indico che questo contenuto deve essere interpretato come json
header('Content-Type: application/json');

// Assegno il percorso del file json del database ad una variabile
$database_file = __DIR__ . '/musicDiscs.json';

// Prendo il file json
$data = file_get_contents($database_file);

// Restituisce array associativo php
$musicDiscs = json_decode($data, true) ?? [];

// Verifico che l'azione sia di tipo 'delete'
if (isset($_POST['action']) && $_POST['action'] === 'delete') {

    // Verifico che l'ID sia presente nella richiesta
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode(["error" => "ID is required."]);
        die();
    }

    $id = intval($_POST['id']);
    $discIndex = -1;

    // Cerco il disco da eliminare tramite ID
    foreach ($musicDiscs as $index => $disc) {
        if ($disc['id'] === $id) {
            $discIndex = $index;
            break;
        }
    }

    // Se non trovo il disco, restituisco un errore
    if ($discIndex === -1) {
        echo json_encode(["error" => "Disc not found."]);
        die();
    }

    // Rimuovo il disco dall'array
    array_splice($musicDiscs, $discIndex, 1);

    // Salvo i dati aggiornati nel file JSON
    if (file_put_contents($database_file, json_encode($musicDiscs))) {
        echo json_encode(["success" => "Disc successfully deleted."]);
    } else {
        echo json_encode(["error" => "Error. Disc not deleted."]);
    }
} else {
    echo json_encode(["error" => "Action not permitted."]);
}
