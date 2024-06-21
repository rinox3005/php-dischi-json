<?php
// Dico che questo contenuto deve essere interpretato come json
header('Content-Type: application/json');

// Assegno il percorso del file json del database ad una variabile
$database_file = __DIR__ . '/musicDiscs.json';

// Prendo il file json
$data = file_get_contents($database_file);

// Restituisce array associativo php
$musicDiscs = json_decode($data, true) ?? [];

if (isset($_POST['action']) && $_POST['action'] === 'create') {

    // Verifica che il nome del disco sia presente nel POST
    if (!isset($_POST['name']) || empty($_POST['name'])) {
        echo json_encode(["error" => "Name is requested."]);
        die();
    }

    // Crea un nuovo disco con i dati inviati dal client
    $newDisc = [
        "id" => rand(10, 200),
        "name" => $_POST['name'],
        "artist" => $_POST['artist'] ?? "Unknown Artist",
        "description" => $_POST['description'] ?? "",
        "cover" => $_POST['cover'] ?? "",
        "year" => $_POST['year'] ?? null,
        "tracks" => $_POST['tracks'] ?? null
    ];

    // Aggiunge il nuovo disco alla lista esistente
    $musicDiscs = [...$musicDiscs, $newDisc];

    // Salvataggio del dato
    if (file_put_contents($database_file, json_encode($musicDiscs))) {
        echo json_encode(["success" => "Disc successfully added.", "disc" => $newDisc]);
    } else {
        echo json_encode(["error" => "Error. Disc not saved."]);
    }
} else {
    echo json_encode(["error" => "Action not permitted."]);
}
