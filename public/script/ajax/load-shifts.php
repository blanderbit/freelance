<?php

include('../../app.php');

include(MODEL . 'calendar.php');

$shifts = $calendar->shifts($_POST['from_date'], $_POST['to_date'], $_POST['status'], $_POST['role_id']);

echo json_encode($shifts);

?>
