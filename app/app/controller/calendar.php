<?php

if ($user->is_signed_in()) {

  $page_title = 'Kalender';

  $scripts = ['calendar.js'];
  $styles = [];

  if (!path(2)) $calendar_show = 'month';
  else $calendar_show = path(2);

  include(MODEL . 'calendar.php');

  if (path(3)) $this_year = path(3);
  else $this_year = date('Y');

  if ($calendar_show == 'month') {

    if (path(4)) $this_month = path(4);
    else $this_month = date('m');

    if (is_numeric($this_month)) {

      $this_month = sprintf('%02d', (int)$this_month);
      $this_date = date('Y-m-d', strtotime($this_year . '-' . $this_month . '-01'));

    } else {

      $this_date = date('Y-m-d', strtotime('01 ' . $this_month . ' ' . $this_year));
      $this_month = date('m', strtotime($this_date));

    }

  }

  if ($calendar_show == 'week') {

    if (path(4)) $this_week = path(4);
    else $this_week = date('W');

    $this_date = date('Y-m-d', strtotime($this_year . 'W' . $this_week));
    if (date('L', strtotime($this_date)) != 'monday') $this_date = date('Y-m-d', strtotime($this_date . ' this monday'));

  }

  include(VIEW . 'calendar.php');

} else {

  header('Location: /sign-in');

}

?>
