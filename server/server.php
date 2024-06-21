<?php
// Dico che questo contenuto deve essere interpretato come json
header('Content-Type: application/json');

// Prendo il file json
$musicDiscs = file_get_contents(__DIR__ . '/musicDiscs.json');

// Converto il json in array associativo manipolabile e leggibile da php, lo importo a true per renderlo disponibile al server
$discsToSearch = json_decode($musicDiscs, true);

// echo $musicDiscs;

// Funzione per cercare un disco in un array di dischi basato sull'id. Se trova il disco con l'ID corrispondente, lo restituisce; altrimenti, restituisce null.
function searchDiscById($id, $discsToSearch)
{
    foreach ($discsToSearch as $disc) {
        if ($disc['id'] === $id) {
            return $disc;
        }
    }
    return null;
}

// Se clicco su un disco e passo un ID con ($_GET['id']) ottengo quel disco specifico per la modale. Se l'ID non è specificato, restituisce l'intero elenco di dischi.
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $disc = searchDiscById($id, $discsToSearch);
    if ($disc) {
        echo json_encode($disc);
    } else {
        echo json_encode(["error" => 'Disc does not have an ID']);
    }
} else {
    echo $musicDiscs;
}
