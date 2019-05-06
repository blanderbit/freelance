<?php

include('../../app.php');

if (isset($_POST['id'])) {

  $data = [
    'date'      => date('Y-m-d'),
    'roles'     => $user->roles()
  ];

} else {

  $data = [
    'date'      => date('Y-m-d'),
    'roles'     => $user->roles()
  ];

}

$data = json_encode($data);

echo $data;

?>
