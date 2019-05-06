<?php

include('../../app.php');
include(MODEL . 'location.php');

if (isset($_POST['id'])) {

  $data = [
    'date'      => date('Y-m-d'),
    'employers' => employer_list(),
    'location'  => $location->info($_POST['id'])
  ];

} else {

  $data = [
    'date'      => date('Y-m-d'),
    'employers' => employer_list()
  ];

}

$data = json_encode($data);

echo $data;

?>
