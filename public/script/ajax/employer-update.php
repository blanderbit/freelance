<?php

include('../../app.php');
include(MODEL . 'employer.php');

$post_data = json_decode($_POST['data'], true);

$errors = 0;

if (!$post_data['name']) $errors++;

if (!$errors) {

  $data['name'] = $post_data['name'];

  echo $employer->add($data);

}

?>
