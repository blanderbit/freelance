<div class="calendar-header">

  <div class="calendar-title">

    <h2>Week <?php echo date('W', strtotime($this_date)); ?><span style="font-weight:600;">, <?php echo date('Y', strtotime($this_date)); ?></span></h2>


  </div>

  <div class="time-nav">

    <a href="/calendar/week/<?php echo $calendar->year_week_url($this_date, -1); ?><?php echo get_params(); ?>" class="previous-month">&lt;</a>
    <a href="/calendar/week/<?php echo $calendar->year_week_url($this_date, +1); ?><?php echo get_params(); ?>" class="next-month">&gt;</a>

  </div>

</div>

<br><br>

<div data-calendar="month" class="calendar-month">

  <table>

    <tr class="month-header">

    <?php foreach ($calendar->week($this_date) as $day => $data) { ?>

      <td>

        <?php echo substr(translate_day(date('l', strtotime($day))), 0, 2); ?>

        <?php echo date('j', strtotime($day)); ?>

        <?php echo substr(translate_month(date('F', strtotime($day))), 0, 3); ?>

      </td>

    <?php } ?>

    </tr>

    <tr>

    <?php foreach ($calendar->week($this_date) as $day => $data) { ?>

      <?php

        $current = '';
        if (date('d-m-Y', strtotime($day)) == date('d-m-Y')) $current = 'current';
        if (date('j', strtotime($day)) == 1) $day_title = '<div class="' . $current . '">' . date('j', strtotime($day)) . '</div> ' . date('M', strtotime($day));
        else $day_title = '<div class="' . $current . '">' . date('j', strtotime($day)) . '</div>';

      ?>

      <td data-date="<?php echo date('Y-m-d', strtotime($day)); ?>" class="month-day">
        <div data-events="<?php echo date('Y-m-d', strtotime($day)); ?>" class="month-events"></div>
      </td>

    <?php } ?>

    </tr>

  </table>

</div>
