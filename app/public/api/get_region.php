<?php

require_once(__DIR__.'/../../app/model/config.php');
require_once(__DIR__.'/../../app/model/functions.php');
require_once(__DIR__.'/../../app/model/geo_location.php');

enable_cors();

//$createNewEmployer = json_encode($_REQUEST);
//$decodedEmployer = json_decode($createNewEmployer, true);
//$decodedEmployer = json_decode($_REQUEST, true);
$frontSent = file_get_contents('php://input');
$decodedEmployer = json_decode($frontSent, true);

header('Content-type: application/json');
echo json_encode($geo_location->get_region(139));
