<?php

include('../../app.php');

include(MODEL . 'calendar.php');

$birthdays = $calendar->birthdays($_POST['from_date'], $_POST['to_date']);

echo json_encode($birthdays);

?>
