<?php

include('../../app.php');

if ($user->is_signed_in()) {

  include(MODEL . 'employer.php');
  include(MODEL . 'planner.php');

  $post_data = json_decode($_POST['data'], true);

  $notes = (array)$post_data['notes'];

  $errors = 0;

  if (!$post_data['location_id']) $errors++;

  if (!$errors) {

    $data = [
      'user_id'       => (int)$post_data['user_id'],
      'confirmed'     => (int)$post_data['confirmed'],
      'location_id'   => (int)$post_data['location_id'],
      'time_start'    => date('Y-m-d H:i:s', strtotime($post_data['time_start'])),
      'time_end'      => date('Y-m-d H:i:s', strtotime($post_data['time_end'])),
      'break'         => $post_data['break'],
      'late'          => $post_data['late'],
      'notes'         => $notes
    ];

    if ($post_data['uid']) {

      $data['uid'] = $post_data['uid'];
      $data['id'] = $planner->get_id($data['uid']);

      if ($planner->update_shift($data)) echo 'success';

    } else {

      if ($planner->add_shift($data)) echo 'success';

    }

  }

}

?>
