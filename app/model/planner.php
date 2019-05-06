<?php

class Planner {

  public function shifts($date, $status = 'any', $role_id = 'any') {

    $shifts = [];

    $day_before = date('Y-m-d', strtotime($date . ' -1 day'));
    $day = date('Y-m-d', strtotime($date));
    $day_after = date('Y-m-d', strtotime($date . ' +1 day'));

    $target_status = "";
    $target_role = "";

    if ($status == 'unconfirmed') $target_status = "AND shift.confirmed = 0 ";
    if ($status == 'confirmed') $target_status = "AND shift.confirmed = 1 ";
    if ($role_id != 'any') $target_role = "AND user.role_id = $role_id ";

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
      WHERE (DATE(shift.time_start) = '$day_before' AND DATE(shift.time_end) = '$day'
      OR DATE(shift.time_start) = '$day')
      $target_status
      $target_role
      ORDER BY shift.location_id, shift.time_start, user.lastname";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $time_start = strtotime($data['time_start']);
        $time_end = strtotime($data['time_end']);
        $duration = round(abs($time_end - $time_start) / 3600, 2);

        $zero_time = strtotime(date('Y-m-d', strtotime($data['time_start'])) . ' 00:00:00');
        $start = round(abs($time_start - $zero_time) / 3600, 2);

        if (date('Y-m-d', strtotime($data['time_start'])) != $day) $start = 0;

        $confirmed = false;
        if ($data['confirmed']) $confirmed = true;

        $has_notes = $this->has_notes($data['shift_id']);

        if (strlen($data['user_uid']) > 0) {

          $user_uid = $data['user_uid'];
          $user_available = is_user_available($data['user_id'], $data['shift_id'], $data['time_start'], $data['time_end']);
          $user_firstname = $data['firstname'];
          $user_lastname = $data['lastname'];
          $user_initials = $data['firstname'][0] . '.' . $data['lastname'][0] . '.';

        } else {

          $user_uid = '';
          $user_available = false;
          $user_firstname = 'n.v.t.';
          $user_lastname = '';
          $user_initials = 'n.v.t.';

        }

        $shifts[] = [
          'uid'             => $data['shift_uid'],
          'date'            => date('Y-m-d', strtotime($data['time_start'])),
          'date_start'      => date('j F', strtotime($data['time_start'])),
          'date_end'        => date('j F', strtotime($data['time_end'])),
          'time_start'      => date('H:i', strtotime($data['time_start'])),
          'time_end'        => date('H:i', strtotime($data['time_end'])),
          'duration'        => $duration,
          'start'           => $start,
          'confirmed'       => $confirmed,
          'has_notes'       => $has_notes,
          'employer_uid'    => $data['employer_uid'],
          'employer_name'   => $data['employer_name'],
          'user_uid'        => $user_uid,
          'user_available'  => $user_available,
          'user_firstname'  => $user_firstname,
          'user_lastname'   => $user_lastname,
          'user_initials'   => $user_initials,
          'location_name'   => $data['location_name'],
          'street'          => $data['street'],
          'street_number'   => $data['street_number'],
          'street_extra'    => $data['street_extra'],
          'city'            => $data['city']
        ];

      }

    }

    return $shifts;

  }

  public function add_shift($data) {

    $shift_uid = md5(uniqid(rand(), true));
    $user_id = $data['user_id'];
    $confirmed = $data['confirmed'] ?: 0;
    $location_id = $data['location_id'];
    $time_start = date('Y-m-d H:i:s', strtotime($data['time_start']));
    $time_end = date('Y-m-d H:i:s', strtotime($data['time_end']));
    $break = $data['break'] ?: 0;
    $late = $data['late'] ?: 0;
    $notes = $data['notes'];

    if (strtotime($time_start) < strtotime($time_end)) {

      $query = "INSERT INTO shift (shift_uid, time_start, time_end, user_id, location_id, confirmed, break, late)
        VALUES ('$shift_uid', '$time_start', '$time_end', $user_id, $location_id, $confirmed, $break, $late)";

      if (sql::$con->query($query) === true) {

        $this->update_shift_notes(sql::$con->insert_id, $notes);

        return true;

      }

    }

  }

  public function update_shift($data) {

    $shift_id = $data['id'];
    $user_id = $data['user_id'];
    $confirmed = $data['confirmed'] ?: 0;
    $location_id = $data['location_id'];
    $time_start = date('Y-m-d H:i:s', strtotime($data['time_start']));
    $time_end = date('Y-m-d H:i:s', strtotime($data['time_end']));
    $break = $data['break'] ?: 0;
    $late = $data['late'] ?: 0;

    if (strtotime($time_start) < strtotime($time_end)) {

      $query = "UPDATE shift
        SET time_start = '$time_start',
            time_end = '$time_end',
            user_id = $user_id,
            location_id = $location_id,
            confirmed = $confirmed,
            break = $break,
            late = $late
        WHERE shift_id = $shift_id";

      if (sql::$con->query($query) === true) {

        $this->update_shift_notes($shift_id, $data['notes']);

        return true;

      }

    }

  }

  public function shift_info($id) {

    $id = (int)$id;
    $shift = [];

    $query = "SELECT shift.shift_uid, shift.time_start, shift.time_end, shift.confirmed, shift.break, shift.late,
      employer.employer_id, employer.employer_uid,
      user.user_id,
      location.location_id
      FROM shift
      LEFT JOIN location
      ON location.location_id = shift.location_id
      LEFT JOIN employer
      ON employer.employer_id = location.employer_id
      LEFT JOIN user
      ON user.user_id = shift.user_id
      WHERE shift.shift_id = $id";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $notes = $this->notes($id);

        $shift = [
          'uid'             => $data['shift_uid'],
          'date_start'      => date('Y-m-d', strtotime($data['time_start'])),
          'time_start'      => date('H:i:s', strtotime($data['time_start'])),
          'date_end'        => date('Y-m-d', strtotime($data['time_end'])),
          'time_end'        => date('H:i:s', strtotime($data['time_end'])),
          'user_id'         => $data['user_id'],
          'employer_id'     => $data['employer_id'],
          'employer_uid'    => $data['employer_uid'],
          'location_id'     => $data['location_id'],
          'confirmed'       => $data['confirmed'],
          'break'           => $data['break'],
          'late'            => $data['late'],
          'notes'           => $notes
        ];

      }

    }

    return $shift;

  }

  public function update_shift_time($id, $start, $end) {

    $id = (int)$id;

    $date_start = '';
    $date_end = '';

    $select_query = "SELECT time_start, time_end FROM shift WHERE shift_id = $id;";

    if ($select_res = sql::$con->query($select_query)) {

      while ($data = $select_res->fetch_array(MYSQLI_ASSOC)) {

        $date_start = date('Y-m-d', strtotime($data['time_start']));
        $date_end = date('Y-m-d', strtotime($data['time_end']));

      }

    }

    $time_start = $date_start . ' ' . $start;
    $time_start = date('Y-m-d H:i:s', strtotime($time_start));
    $time_end = $date_end . ' ' . $end;
    $time_end = date('Y-m-d H:i:s', strtotime($time_end));

    if (strtotime($time_start) < strtotime($time_end)) {

      $update_query = "UPDATE shift
        SET time_start = '$time_start', time_end = '$time_end'
        WHERE shift_id = $id";

      if (sql::$con->query($update_query) === true) return true;

    }

  }

  public function get_id($uid) {

    $id = 0;

    $query = "SELECT shift_id FROM shift WHERE shift_uid = '$uid';";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $id = $data['shift_id'];

      }

    }

    return $id;

  }

  public function update_shift_notes($shift_id, $notes) {

    $shift_id = (int)$shift_id;

    $query = "DELETE FROM shift_note
      WHERE shift_id = $shift_id;";

    foreach ($notes as $data) {

      $note = $data['note'];
      $archived = $data['archived'];

      if (strlen($note) > 0) {

        $query .= "INSERT INTO shift_note (shift_id, note, archived)
          VALUES ($shift_id, '$note', $archived);";

      }

    }

    if (sql::$con->multi_query($query) === true) return true;

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

  public function notes($shift_id) {

    $shift_id = (int)$shift_id;

    $notes = [];

    $query = "SELECT note, archived
      FROM shift_note
      WHERE shift_id = $shift_id
      ORDER BY archived DESC, note_id ASC;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $notes[] = [
          'note'      => $data['note'],
          'archived'  => $data['archived']
        ];

      }

    }

    return $notes;

  }

}

$planner = new Planner;

?>
