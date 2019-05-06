<?php

if ($user->is_signed_in()) {

  $page_title = 'Dashboard';

  $scripts = ['planner.js'];
  $styles = [];

  include(MODEL . 'employer.php');

  if (strlen(path(2)) > 0) $this_date = date('Y-m-d', strtotime(path(2)));
  else $this_date = date('Y-m-d');

  include(VIEW . 'dashboard.php');

} else {

  header('Location: /sign-in');

}

?>
