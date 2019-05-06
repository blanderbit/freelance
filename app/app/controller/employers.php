<?php

if ($user->is_signed_in()) {

  $page_title = 'Opdrachtgevers';

  $scripts = [];
  $styles = [];

  include(MODEL . 'employer.php');

  if (path(2)) {

    $this_employer['id'] = path(2);

    if (isset($_POST['employer_uid'])) {

      $form_data = [
        'name'          => $_POST['name'],
        'phone'         => $_POST['phone'],
        'email'         => $_POST['email'],
        'street'        => $_POST['street'],
        'street_number' => $_POST['street_number'],
        'street_extra'  => $_POST['street_extra'],
        'postal'        => $_POST['postal'],
        'city'          => $_POST['city'],
        'country'       => $_POST['country'],
        'kvk'           => $_POST['kvk'],
        'iban'          => $_POST['iban']
      ];

      $employer->update($this_employer['id'], $form_data);

    }

    $this_employer = $employer->info($this_employer['id']);

    include(VIEW . 'employer/profile.php');

  } else {

    include(VIEW . 'employers.php');

  }

} else {

  header('Location: /sign-in');

}

?>
