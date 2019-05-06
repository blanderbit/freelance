<?php

class Task {

  public function add($data) {

    $user_id = $data['user_id'];
    $description = $data['description'];
    $time_start = date('Y-m-d H:i:s', strtotime($data['time_start']));
    $time_end = date('Y-m-d H:i:s', strtotime($data['time_end']));

    $query = "INSERT INTO user_task (user_id, description, time_start, time_end)
      VALUES ($user_id, '$description', '$time_start', '$time_end')";

    if (sql::$con->query($query) === true) return true;

  }

  public function update($id, $data) {

    $user_id = $data['user_id'];
    $description = $data['description'];
    $time_start = date('Y-m-d H:i:s', strtotime($data['time_start']));
    $time_end = date('Y-m-d H:i:s', strtotime($data['time_end']));
    $complete = $data['complete'] ?: 0;

    $query = "UPDATE user_task
      SET user_id = $user_id,
      description = '$description',
      time_start = '$time_start',
      time_end = '$time_end',
      complete = $complete
      WHERE task_id = $id";

    if (sql::$con->query($query) === true) return true;

  }

  public function complete($id) {

    $query = "UPDATE user_task SET complete = 1 WHERE task_id = $id";
    if (sql::$con->query($query) === true) return true;

  }

  public function data($task_id) {

    $task = [];

    $query = "SELECT task_id, user_id, description, time_start, time_end, complete
      FROM user_task
      WHERE task_id = $task_id;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $task = [
          'id'          => $data['task_id'],
          'user_id'     => $data['user_id'],
          'description' => $data['description'],
          'date_start'  => date('Y-m-d', strtotime($data['time_start'])),
          'time_start'  => date('H:i', strtotime($data['time_start'])),
          'date_end'    => date('Y-m-d', strtotime($data['time_end'])),
          'time_end'    => date('H:i', strtotime($data['time_end'])),
          'complete'    => $data['complete']
        ];

      }

    }

    return $task;

  }

  public function list_all() {

    $tasks = [];

    $query = "SELECT user_task.task_id, user_task.complete,
      user_task.description, user_task.time_start, user_task.time_end,
      user.user_id, user.firstname, user.lastname
      FROM user_task
      LEFT JOIN user
      ON user.user_id = user_task.user_id
      ORDER BY user_task.complete ASC, user_task.task_id DESC;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $tasks[] = [
          'id'          => $data['task_id'],
          'description' => $data['description'],
          'time_start'  => date('Y-m-d H:i:s', strtotime($data['time_start'])),
          'time_end'    => date('Y-m-d H:i:s', strtotime($data['time_end'])),
          'user_id'     => $data['user_id'],
          'firstname'   => $data['firstname'],
          'lastname'    => $data['lastname'],
          'complete'    => $data['complete']
        ];

      }

    }

    return $tasks;

  }

  public function export($user_id) {

    $tasks = [];

    $query = "SELECT user_task.description, user_task.time_start, user_task.time_end,
      user.firstname, user.lastname
      FROM user_task
      LEFT JOIN user
      ON user.user_id = user_task.user_id
      WHERE user_task.user_id = $user_id
      ORDER BY user_task.task_id DESC;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $tasks[] = [
          'date_start'  => date('m-d-Y', strtotime($data['time_start'])),
          'time_start'  => date('H:i', strtotime($data['time_start'])),
          'time_end'    => date('H:i', strtotime($data['time_end'])),
          'user_name'   => $data['firstname'] . ' ' . $data['lastname'],
          'description' => $data['description'],
        ];

      }

    }

    return $tasks;

  }

}

$task = new Task;

?>
