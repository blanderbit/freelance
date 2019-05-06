<?php

class Availability {

  public function add($data) {

    $user_id = $data['user_id'];
    $type_id = $data['type_id'];
    $comment = $data['comment'];
    $time_start = date('Y-m-d H:i:s', strtotime($data['time_start']));
    $time_end = date('Y-m-d H:i:s', strtotime($data['time_end']));

    $query = "INSERT INTO user_availability (user_id, comment, time_start, time_end, type_id)
      VALUES ($user_id, '$comment', '$time_start', '$time_end', $type_id)";

    if (sql::$con->query($query) === true) return true;

  }

  public function update($id, $data) {

    $user_id = $data['user_id'];
    $type_id = $data['type_id'];
    $comment = $data['comment'];
    $time_start = date('Y-m-d H:i:s', strtotime($data['time_start']));
    $time_end = date('Y-m-d H:i:s', strtotime($data['time_end']));
    $repeat = $data['repeat'];

    $query = "UPDATE user_availability
      SET user_id = $user_id,
      comment = '$comment',
      time_start = '$time_start',
      time_end = '$time_end',
      repeats = $repeat,
      type_id = $type_id
      WHERE id = $id";

    if (sql::$con->query($query) === true) return true;

  }

  public function data($id) {

    $availability = [];

    $query = "SELECT id, user_id, comment, time_start, time_end, type_id
      FROM user_availability
      WHERE id = $id;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $availability = [
          'id'          => $data['id'],
          'user_id'     => $data['user_id'],
          'comment'     => $data['comment'],
          'date_start'  => date('Y-m-d', strtotime($data['time_start'])),
          'time_start'  => date('H:i', strtotime($data['time_start'])),
          'date_end'    => date('Y-m-d', strtotime($data['time_end'])),
          'time_end'    => date('H:i', strtotime($data['time_end'])),
          'type_id'     => $data['type_id']
        ];

      }

    }

    return $availability;

  }

  public function types() {

    $types = [];

    $query = "SELECT type_id, description
      FROM availability_type;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $types[] = [
          'id'            => $data['type_id'],
          'description'   => $data['description']
        ];

      }

    }

    return $types;

  }

}

$availability = new Availability;

?>
