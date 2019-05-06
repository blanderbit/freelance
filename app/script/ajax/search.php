<?php

include('../../app.php');

if (isset($_POST['needle'])) {

  $haystack = $_POST['haystack'];
  $needle = $_POST['needle'];
  $results = [];

  if ($haystack == 'all' && strlen($needle) >= 2) {

    include(MODEL . 'employer.php');

    $results = $employer->search($needle);
    $results = array_merge($results, $user->search($needle));

  }

  if ($haystack == 'employers' && strlen($needle) >= 2) {

    include(MODEL . 'employer.php');
    $results = $employer->search($needle);

  }

  if ($haystack == 'users' && strlen($needle) >= 2) {

    $results = $user->search($needle);

  }

  $results = json_encode($results);
  echo $results;

}

?>
