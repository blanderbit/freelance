<?php

date_default_timezone_set('Europe/Amsterdam');

session_start();

define('APP', dirname(dirname(__FILE__)) . '/app/');
define('MODEL', APP . 'model/');
define('VIEW', APP . 'view/');
define('CONTROLLER', APP . 'controller/');

define('VIEW_SNIPPET', VIEW . 'snippet/');
define('VIEW_HEADER', VIEW . 'snippet/header.php');
define('VIEW_NAV', VIEW . 'snippet/nav.php');
define('VIEW_FOOTER', VIEW . 'snippet/footer.php');

include(MODEL . 'config.php');
include(MODEL . 'functions.php');
include(MODEL . 'user.php');

?>
