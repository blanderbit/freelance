<div class="calendar-header">

  <div class="calendar-title">

    <h2><?php echo date('F', strtotime($this_date)); ?> <span style="font-weight:600;"><?php echo date('Y', strtotime($this_date)); ?></span></h2>


  </div>

  <div class="time-nav">

    <a href="/calendar/month/<?php echo $calendar->year_month_url($this_date, -1); ?><?php echo get_params(); ?>" class="previous-month">&lt;</a>
    <a href="/calendar/month/<?php echo $calendar->year_month_url($this_date, +1); ?><?php echo get_params(); ?>" class="next-month">&gt;</a>

  </div>

</div>

<br><br>

<div data-calendar="month" class="calendar-month">

  <table>

    <tr class="month-header">

      <td>Ma</td>
      <td>Di</td>
      <td>Wo</td>
      <td>Do</td>
      <td>Vr</td>
      <td>Za</td>
      <td>Zo</td>

    </tr>

  <?php

  $days = 1;

  foreach ($calendar->month($this_date) as $day => $data) { ?>

      <?php

        $current = '';
        if (date('d-m-Y', strtotime($day)) == date('d-m-Y')) $current = 'current';
        if (date('j', strtotime($day)) == 1) $day_title = '<div class="' . $current . '">' . date('j', strtotime($day)) . '</div> ' . date('M', strtotime($day));
        else $day_title = '<div class="' . $current . '">' . date('j', strtotime($day)) . '</div>';

        if ($days == 1) echo '<tr>';

      ?>

      <?php if ($data['shadow']) { ?>

        <td data-date="<?php echo date('Y-m-d', strtotime($day)); ?>" class="month-day shadow">
          <div class="day-of-month">
            <?php echo $day_title; ?>
          </div>
          <div data-events="<?php echo date('Y-m-d', strtotime($day)); ?>" class="month-events"></div>
        </td>

      <?php } else { ?>

        <td data-date="<?php echo date('Y-m-d', strtotime($day)); ?>" class="month-day">
          <div class="day-of-month">
            <?php echo $day_title; ?>
          </div>
          <div data-events="<?php echo date('Y-m-d', strtotime($day)); ?>" class="month-events"></div>
        </td>

      <?php } ?>

  <?php

    if ($days == 7) {

      echo '</tr>';
      $days = 1;

    } else {

      $days++;

    }

  }

  ?>

  </table>

</div>
