<?php

class Calendar {

  public function year_month_url($date, $diff = 0) {

    $date = date('Y-m-d', strtotime($date));
    $year = date('Y', strtotime($date));
    $month = date('m', strtotime($date));

    // Calculating difference

    $new_date = date('d-m-Y', strtotime($date . ' ' . $diff . ' month'));

    $new_year = date('Y', strtotime($new_date));
    $new_month = strtolower(date('F', strtotime($new_date)));

    return $new_year . '/' . $new_month;

  }

  public function year_week_url($date, $diff = 0) {

    $date = date('Y-m-d', strtotime($date));
    $year = date('Y', strtotime($date));
    $week = date('W', strtotime($date));
    $diff = $diff * 7; // working with 7 days instead of 1 week

    // Calculating difference

    $new_date = date('Y-m-d', strtotime($date . ' ' . $diff . ' days'));

    $new_year = date('Y', strtotime($new_date));
    $new_week = strtolower(date('W', strtotime($new_date)));

    return $new_year . '/' . $new_week;

  }

  public function month($date = 'this') {

    if ($date == 'this') {

      $year = date('Y');
      $month = date('m');

    } else {

      $year = date('Y', strtotime($date));
      $month = date('m', strtotime($date));

    }

    $events = [];

    $date = '01-' . $month . '-' . $year;
    $days_in_month = date('t', strtotime($date));
    $first_day = strtotime(date('Y-m-d', strtotime($year . '-' . $month . '-01')));
    $day_of_week = date('w', $first_day) - 1; // Monday through Sunday
    if ($day_of_week == -1) $day_of_week = 6;

    // Days leading up to given month

    for ($i = $day_of_week; $i > 0; $i--) {

      $day = date('Y-m-d', strtotime('-' . $i . ' day', $first_day));

      $events[$day] = [
        'shadow' => true
      ];

    }

    // Days for given month

    for ($i = 1; $i <= $days_in_month; $i++) {

      $day_of_month = sprintf('%02d', $i);
      $day = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day_of_month));

      $events[$day] = [
        'shadow' => false
      ];

    }

    // Remaining days

    return $events;

  }

  public function week($date = 'this') {

    if ($date == 'this') {

      $year = date('Y');
      $week = date('W');

    } else {

      $year = date('Y', strtotime($date));
      $week = date('W', strtotime($date));

    }

    $events = [];

    $date = date('Y-m-d', strtotime($year . 'W' . $week));

    // Setting date to Sunday of given week

    if (date('L', strtotime($date)) != 'sunday') $date = date('Y-m-d', strtotime($date . ' last sunday'));

    for ($i = 1; $i <= 7; $i++) {

      $date = date('Y-m-d', strtotime($date . ' +1 days')); // Starting at monday (sunday +1)

      $events[$date] = [
        'shadow' => false
      ];

    }

    return $events;

  }

  public function hours_in_day() {

    $hour = -1;
    $hours = [];

    while ($hour++ < 23) {

      $hours[] = sprintf('%02d', $hour) . ':00';

    }

    return $hours;

  }

  public function shifts($from_date, $to_date = 'from_date', $status = 'any', $role_id = 'any') {

    $fd = date('Y-m-d', strtotime($from_date));

    if ($to_date == 'from_date') $td = $fd;
    else $td = date('Y-m-d', strtotime($to_date));

    $target_status = "";
    $target_role = "";

    if ($status == 'unconfirmed') $target_status = "AND shift.confirmed = 0 ";
    if ($status == 'confirmed') $target_status = "AND shift.confirmed = 1 ";
    if ($role_id != 'any') $target_role = "AND user.role_id = $role_id ";

    $shifts = [];

    $query = "SELECT shift.shift_id, shift.shift_uid, shift.time_start, shift.time_end, shift.confirmed,
      employer.employer_uid, employer.name AS employer_name,
      user.user_id, user.user_uid, user.firstname, user.lastname,
      location.name AS location_name, location.street, location.street_number, location.street_extra, location.city
      FROM shift
      LEFT JOIN location
      ON location.location_id = shift.location_id
      LEFT JOIN employer
      ON employer.employer_id = location.employer_id
      LEFT JOIN user
      ON user.user_id = shift.user_id
      WHERE DATE(shift.time_start) BETWEEN '$fd' AND '$td'
      $target_status
      $target_role
      ORDER BY shift.time_start";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $confirmed = false;
        if ($data['confirmed']) $confirmed = true;

        $has_notes = $this->has_notes($data['shift_id']);

        if ($data['user_id'] > 0) $user_available = is_user_available($data['user_id'], $data['shift_id'], $data['time_start'], $data['time_end']);
        else $user_available = true;

        $location_address = $data['street'] . ' ' . $data['street_number'];
        if ($data['street_extra']) $location_address .= ' ' . $data['street_extra'];

        $shifts[] = [
          'uid'               => $data['shift_uid'],
          'date_start'        => date('Y-m-d', strtotime($data['time_start'])),
          'time_start'        => date('H:i', strtotime($data['time_start'])),
          'date_end'          => date('Y-m-d', strtotime($data['time_end'])),
          'time_end'          => date('H:i', strtotime($data['time_end'])),
          'user_uid'          => $data['user_uid'],
          'user_available'    => $user_available,
          'user_name'         => $data['firstname'] . ' ' . $data['lastname'],
          'employer_uid'      => $data['employer_uid'],
          'location_id'       => $data['location_id'],
          'location_name'     => $data['location_name'],
          'location_address'  => $location_address,
          'confirmed'         => $confirmed,
          'has_notes'         => $has_notes
        ];

      }

    }

    return $shifts;

  }

  public function export($date, $period = 'month') {

    $date = date('Y-m-d H:i:s', strtotime($date));

    if ($period == 'month') $select = "MONTH(shift.time_start) = MONTH('$date') OR MONTH(shift.time_end) = MONTH('$date')";

    $shifts = [];

    $query = "SELECT shift.shift_id, shift.shift_uid, shift.time_start, shift.time_end, shift.employer_id, shift.confirmed,
      employer.employer_uid, employer.company_name,
      user.user_id, user.user_uid, user.firstname, user.lastname,
      location.name AS location_name, location.street, location.street_number, location.street_extra, location.city
      FROM shift
      LEFT JOIN employer
      ON employer.employer_id = shift.employer_id
      LEFT JOIN user
      ON user.user_id = shift.user_id
      LEFT JOIN location
      ON location.location_id = shift.location_id
      WHERE $select
      ORDER BY shift.time_start";

    error_log($query);

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $confirmed = false;
        if ($data['confirmed']) $confirmed = true;

        $has_notes = $this->has_notes($data['shift_id']);

        $user_available = is_user_available($data['user_id'], $data['shift_id'], $data['time_start'], $data['time_end']);

        $shifts[] = [
          'Datum'           => date('d-m-Y', strtotime($data['time_start'])),
          'Begint'          => date('H:i', strtotime($data['time_start'])),
          'Eindigt'         => date('H:i', strtotime($data['time_end'])),
          'Locatie'         => $data['location_name'],
          'Werknemer'       => $data['firstname'] . ' ' . $data['lastname'],
        ];

      }

    }

    return $shifts;

  }

  public function events($from_date, $to_date = 'from_date') {

    $fd = date('Y-m-d', strtotime($from_date));

    if ($to_date == 'from_date') $td = $fd;
    else $td = date('Y-m-d', strtotime($to_date));

    $events = [];

    $query = "SELECT event.user_id, event.description, event.time_start, event.time_end,
      color.hex
      FROM event
      LEFT JOIN color
      ON color.color_id = event.color_id
      WHERE event.time_start >= DATE('$fd')
      AND event.time_end <= DATE('$td')
      ORDER BY event.time_start;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $events[] = [
          'user_id'     => $data['user_id'],
          'description' => $data['description'],
          'date_start'  => date('Y-m-d', strtotime($data['time_start'])),
          'time_start'  => date('H:i', strtotime($data['time_start'])),
          'date_end'    => date('Y-m-d', strtotime($data['time_end'])),
          'time_end'    => date('H:i', strtotime($data['time_end'])),
          'color'       => $data['hex']
        ];

      }

    }

    return $events;

  }

  public function birthdays($from_date, $to_date = 'from_date') {

    $fd = date('Y-m-d', strtotime($from_date));

    if ($to_date == 'from_date') $td = $fd;
    else $td = date('Y-m-d', strtotime($to_date));

    $birthdays = [];

    if (date('Y', strtotime($fd)) == date('Y', strtotime($td))) {

      $string = "DATE_FORMAT(user_info.birthdate, '%m')
        BETWEEN DATE_FORMAT('$fd', '%m') AND DATE_FORMAT('$td', '%m')";

    } else {

      $string = "DATE_FORMAT(user_info.birthdate, '%m') = DATE_FORMAT('$fd', '%m')
        OR DATE_FORMAT(user_info.birthdate, '%m') = DATE_FORMAT('$td', '%m')";

    }

    $query = "SELECT user.user_id, user.firstname, user.lastname,
      user_info.birthdate
      FROM user_info
      LEFT JOIN user
      ON user_info.user_id = user.user_id
      WHERE $string;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $birthday = date('m-d', strtotime($data['birthdate']));

        $birthdays[] = [
          'user_id'     => $data['user_id'],
          'date'        => $birthday,
          'firstname'   => $data['firstname'],
          'lastname'    => $data['lastname']
        ];

      }

    }

    return $birthdays;

  }

  public function has_notes($shift_id) {

    $shift_id = (int)$shift_id;

    $query = "SELECT note, archived
      FROM shift_note
      WHERE shift_id = $shift_id
      AND archived = 0;";

    if ($res = sql::$con->query($query)) {

      if ($res->num_rows > 0) return true;

    }

  }

}

$calendar = new Calendar;

?>
