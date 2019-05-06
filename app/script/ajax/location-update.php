<?php

include('../../app.php');

if ($user->is_signed_in()) {

  include(MODEL . 'employer.php');
  include(MODEL . 'location.php');

  $post_data = json_decode($_POST['data'], true);

  $errors = 0;

  if (!$post_data['employer_id']) $errors++;

  if (!$errors) {

    $data = [
      'employer_id'   => $post_data['employer_id'],
      'name'          => $post_data['name'],
      'dress_code'    => $post_data['dress_code'],
      'street'        => $post_data['street'],
      'street_number' => $post_data['street_number'],
      'street_extra'  => $post_data['street_extra'],
      'postal'        => $post_data['postal'],
      'city'          => $post_data['city'],
      'country'       => $post_data['country']
    ];

    if ($post_data['id']) {

      $data['id'] = $post_data['id']; // append location ID to data
      if ($location->update($data['id'], $data)) echo 'success';

    } else {

      if ($location->add($data)) echo 'success';

    }

  }

}

?>
