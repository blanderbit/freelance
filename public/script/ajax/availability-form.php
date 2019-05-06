<?php

include('../../app.php');

if ($user->is_signed_in()) {

  include(MODEL . 'availability.php');

  if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $data = [
      'date'          => date('Y-m-d'),
      'availability'  => $availability->data($id),
      'types'         => $availability->types(),
      'users'         => user_list()
    ];

  } else {

    $data = [
      'date'      => date('Y-m-d'),
      'types'     => $availability->types(),
      'users'     => user_list()
    ];

  }

  $data = json_encode($data);

  echo $data;

}

?>
