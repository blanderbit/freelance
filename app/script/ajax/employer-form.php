<?php

include('../../app.php');

$data = [
  'date'  => date('Y-m-d')
];

$data = json_encode($data);

echo $data;

?>
