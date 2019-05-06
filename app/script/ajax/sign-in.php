<?php

include('../../app.php');

if (isset($_POST['email']) && isset($_POST['password'])) {

  if ($user->sign_in($_POST['email'], $_POST['password'])) echo 'success';

}

?>
