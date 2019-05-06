<?php

include('../../app.php');
include(MODEL . 'task.php');

if (isset($_POST['id'])) {

  $id = $_POST['id'];

  $data = [
    'date'      => date('Y-m-d'),
    'task'      => $task->data($id),
    'users'     => user_list()
  ];

} else {

  $data = [
    'date'      => date('Y-m-d'),
    'users'     => user_list()
  ];

}

$data = json_encode($data);

echo $data;

?>
