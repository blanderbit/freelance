<?php

include('../../app.php');

if (isset($_POST['employer_id'])) {

  include(MODEL . 'employer.php');

  $locations = $employer->locations($_POST['employer_id']);
  $locations = json_encode($locations);

  echo $locations;

}

?>
