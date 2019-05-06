<?php

include('../../app.php');

include(MODEL . 'calendar.php');

$events = $calendar->events($_POST['from_date'], $_POST['to_date']);

echo json_encode($events);

?>
