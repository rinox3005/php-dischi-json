<?php
header('Content-Type: application/json');
$musicDiscs = file_get_contents(__DIR__ . '/musicDiscs.json');
$discsToSearch = json_decode($musicDiscs, true);

// echo $musicDiscs;

function searchDiscById($id, $discsToSearch)
{
    foreach ($discsToSearch as $disc) {
        if ($disc['id'] == $id) {
            return $disc;
        }
    }
    return null;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $disc = searchDiscById($id, $discsToSearch);
    if ($disc) {
        echo json_encode($disc);
    } else {
        echo json_encode(["error" => 'Disc not found']);
    }
} else {
    echo $musicDiscs;
}
