<?php

include('../../app.php');

if ($user->is_signed_in()) {

  include(MODEL . 'planner.php');

  $id = $planner->get_id($_POST['shift_uid']);

  if ($planner->update_shift_time($id, $_POST['time_start'], $_POST['time_end'])) echo 'success';

}

?>
