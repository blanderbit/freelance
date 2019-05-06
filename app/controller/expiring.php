<?php

$page_title = 'Expiring';

if ($user->is_signed_in()) {

  if (path(2) == 'contracts') {

    include(VIEW . 'expiring/contracts.php');

  }

  if (path(2) == 'cards') {

    include(VIEW . 'expiring/cards.php');

  }

  if (path(2) == 'identifications') {

    include(VIEW . 'expiring/identifications.php');

  }

}

?>
