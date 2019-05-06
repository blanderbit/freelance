<?php
require_once(__DIR__.'/../../app/model/config.php');
require_once(__DIR__.'/../../app/model/functions.php');
require_once(__DIR__.'/../../app/model/user.php');

enable_cors();

$frontSent = file_get_contents('php://input');
$decodedUser = json_decode($frontSent, true);

header('Content-type: application/json');
echo json_encode($user->list_all());
