<?php

include('../../app.php');

if ($user->is_signed_in()) {

  $post_data = json_decode($_POST['data'], true);

  $errors = 0;

  if (!$post_data['user_id']) $errors++;

  if (!$errors) {

    include(MODEL . 'availability.php');

    $data = [
      'user_id'       => $post_data['user_id'],
      'type_id'       => $post_data['type_id'],
      'comment'       => $post_data['comment'],
      'time_start'    => $post_data['time_start'],
      'time_end'      => $post_data['time_end'],
      'repeat'        => $post_data['repeat']
    ];

    if ($post_data['id']) {

      $data['id'] = $post_data['id']; // append task ID to data
      if ($availability->update($data['id'], $data)) echo 'success';

    } else {

      if ($availability->add($data)) echo 'success';

    }

  }

}

?>
