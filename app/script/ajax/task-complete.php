<?php

include('../../app.php');

if ($user->is_signed_in()) {

  include(MODEL . 'task.php');

  if ($task->complete($_POST['id'])) echo 'success';

}

?>
