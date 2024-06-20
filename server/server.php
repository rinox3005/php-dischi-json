<?php

$musicDiscs = file_get_contents(__DIR__ . '/musicDiscs.json');

header('Content-Type: application/json');

echo $musicDiscs;
