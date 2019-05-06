<?php

if (!$user->is_signed_in()) {

  $page_title = 'Inloggen';

  $scripts = ['user.js'];
  $styles = [];

  include(VIEW . 'sign-in.php');

} else {

  header('Location: /');

}

?>
