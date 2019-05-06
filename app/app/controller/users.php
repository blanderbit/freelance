<?php

if ($user->is_signed_in()) {

  $page_title = 'Werknemers';

  $scripts = [];
  $styles = [];

  if (path(2)) {

    $this_user['id'] = path(2);

    if (isset($_POST['user_uid'])) {

      $form_data = [
        'firstname'       => $_POST['firstname'],
        'lastname'        => $_POST['lastname'],
        'birthdate'       => $_POST['birthdate'],
        'role_id'         => $_POST['role'],
        'drivers_license' => $_POST['drivers_license'],
        'email'           => $_POST['email'],
        'password'        => $_POST['password'],
        'phone'           => $_POST['phone'],
        'street'          => $_POST['street'],
        'street_number'   => $_POST['street_number'],
        'street_extra'    => $_POST['street_extra'],
        'postal'          => $_POST['postal'],
        'city'            => $_POST['city'],
        'country'         => $_POST['country'],
        'nationality'     => $_POST['nationality'],
        'birth_city'      => $_POST['birth_city'],
        'birth_country'   => $_POST['birth_country'],
        'id_id'           => $_POST['identification'],
        'id_exp'          => $_POST['id_exp'],
        'csn'             => $_POST['csn'],
        'length'          => $_POST['length'],
        'service_start'   => $_POST['service_start'],
        'wage'            => $_POST['wage'],
        'travel_cost'     => $_POST['travel_cost'],
        'contract_start'  => $_POST['contract_start'],
        'contract_end'    => $_POST['contract_end'],
        'card_number'     => $_POST['card_number'],
        'card_exp'        => $_POST['card_exp'],
        'sizes_shirt'     => $_POST['sizes_shirt'],
        'sizes_pants'     => $_POST['sizes_pants'],
        'sizes_costume'   => $_POST['sizes_costume'],
        'sizes_shoes'     => $_POST['sizes_shoes']
      ];

      if ($user->update($this_user['id'], $form_data)) header("Refresh:0");

    }

    $this_user = $user->info($this_user['id']);
    $shifts_upcoming = $user->shifts($this_user['id'], 'UPCOMING');
    $shifts_completed = $user->shifts($this_user['id'], 'COMPLETED');
    $shifts_late = $user->shifts_late($this_user['id']);

    $this_user['tasks'] = $user->tasks($this_user['id']);
    $this_user['paychecks'] = $user->paychecks($this_user['id']);
    $this_user['files'] = $user->files($this_user['id']);
    $this_user['availability'] = $user->availability($this_user['id']);

    include(VIEW . 'user/profile.php');

  } else {

    include(VIEW . 'users.php');

  }

} else {

  header('Location: /sign-in');

}

?>
