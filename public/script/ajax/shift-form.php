<?php

include('../../app.php');

if (isset($_POST['uid'])) {

  include(MODEL . 'employer.php');
  include(MODEL . 'planner.php');

  $shift = $planner->shift_info($planner->get_id($_POST['uid']));
  $employer_id = $shift['employer_id'];

  $data = [
    'date'      => date('Y-m-d'),
    'shift'     => $shift,
    'employers' => employer_list(),
    'locations' => $employer->locations($employer_id),
    'users'     => user_list()
  ];

} else {

  $data = [
    'date'      => date('Y-m-d'),
    'employers' => employer_list(),
    'users'     => user_list()
  ];

}

$data = json_encode($data);

echo $data;

?>
