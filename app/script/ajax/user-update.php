<?php

include('../../app.php');

if ($user->is_signed_in()) {

  $post_data = json_decode($_POST['data'], true);

  $errors = 0;

  if (!$post_data['email']) $errors++;
  if (!$post_data['firstname']) $errors++;
  if (!$post_data['lastname']) $errors++;
  if (!$post_data['password']) $errors++;
  if ($post_data['password'] != $post_data['password_repeat']) $errors++;

  if (!$errors) {

    $data = [
      'email'     => $post_data['email'],
      'role_id'   => $post_data['role_id'],
      'firstname' => $post_data['firstname'],
      'lastname'  => $post_data['lastname'],
      'password'  => $post_data['password']
    ];

    echo $user->add($data);

  }

}

?>
