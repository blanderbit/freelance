<?php

include('../../app.php');

if ($user->is_signed_in()) {

  include(MODEL . 'file.php');

  if (isset($_POST['file'])) {

    if ($file->delete($_POST['file'])) echo 'success';

  }

}

?>
