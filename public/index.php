<?php

require_once('app.php');

$controller = CONTROLLER;

if (is_path('')) {

  $controller .= 'dashboard';

} else {

  $controller .= path(1);

}

$controller .= '.php';

if (file_exists($controller)) {

  include($controller);

} else {

  include(VIEW . '404.php');

}

?>
