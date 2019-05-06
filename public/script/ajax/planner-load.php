<?php

include('../../app.php');

include(MODEL . 'planner.php');

$shifts = $planner->shifts($_POST['date'], $_POST['status'], $_POST['role_id']);

echo json_encode($shifts);

?>
