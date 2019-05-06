<?php

include('../../app.php');

if ($user->is_signed_in()) {

  include(MODEL . 'task.php');

  $post_data = json_decode($_POST['data'], true);

  $errors = 0;

  if (!$post_data['user_id']) $errors++;

  if (!$errors) {

    $data = [
      'user_id'       => $post_data['user_id'],
      'description'   => $post_data['description'],
      'time_start'    => $post_data['time_start'],
      'time_end'      => $post_data['time_end'],
      'complete'      => $post_data['complete']
    ];

    if ($post_data['id']) {

      $data['id'] = $post_data['id']; // append task ID to data
      if ($task->update($data['id'], $data)) echo 'success';

    } else {

      if ($task->add($data)) echo 'success';

    }

  }

}

?>
