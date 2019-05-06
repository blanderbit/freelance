<?php

function path($depth = -1) {

  // Original starts at 0
  // This function starts at 1 (1st)

  $p = strtok($_SERVER['REQUEST_URI'], '?');
  $p = ltrim($p, '/');

  if ($depth != -1) {

    $depth--;

    $p_d = explode('/', $p);

    return $p_d[$depth];

  } else {

    return $p;

  }

}

function full_path() {

  return $_SERVER['REQUEST_URI'];

}

function num_paths() {

  $p = strtok($_SERVER['REQUEST_URI'], '?');
  $p = ltrim($p, '/');
  $p = explode('/', $p);
  $p = array_filter($p);

  return count($p);

}

function is_path($path, $depth = 'full') {

  // Original starts at 0
  // This function starts at 1 (1st)

  $p   = strtok($_SERVER['REQUEST_URI'], '?');
  $p   = ltrim($p, '/');

  if ($depth == 'full') {

    if ($p == $path) {

      return true;

    }

  } else {

    $depth--;

    $p_d = explode('/', $p);

    if ($p_d[$depth] == $path) {

      return true;

    }

  }

}

function get_params() {

  if (strlen($_SERVER['QUERY_STRING'])) return '?' . $_SERVER['QUERY_STRING'];
  else return '';  

}

function time_difference($start, $end) {

  $start = strtotime($start);
  $end = strtotime($end);
  $diff = ($start - $end) / 3600;

  return abs(round($diff, 1));

}

function employer_list() {

  $employers = [];

  $query = "SELECT employer_id, employer_uid, name FROM employer";

  if ($res = sql::$con->query($query)) {

    while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

      $employers[] = [
        'id'            => $data['employer_id'],
        'employer_uid'  => $data['employer_uid'],
        'name'          => $data['name']
      ];

    }

  }

  return $employers;

}

function user_list() {

  $employees = [];

  $query = "SELECT user_id, user_uid, firstname, lastname FROM user";

  if ($res = sql::$con->query($query)) {

    while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

      $employees[] = [
        'id'            => $data['user_id'],
        'employee_uid'  => $data['user_uid'],
        'name'          => $data['firstname'] . ' ' . $data['lastname'],
        'firstname'     => $data['firstname'],
        'lastname'      => $data['lastname']
      ];

    }

  }

  return $employees;

}

function location_list() {

  $locations = [];

  $query = "SELECT location_id, name, street, street_number, street_extra FROM location";

  if ($res = sql::$con->query($query)) {

    while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

      $address = $data['street'] . ' ' . $data['street_number'];
      if ($data['street_extra']) $address .= ' ' . $data['street_extra'];

      $locations[] = [
        'id'          => $data['location_id'],
        'name'        => $data['name'],
        'address'     => $address
      ];

    }

  }

  return $locations;

}

function identification_types() {

  $types = [];

  $query = "SELECT id_id, name
    FROM identification";

  if ($res = sql::$con->query($query)) {

    while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

      $types[] = [
        'id_id'  => $data['id_id'],
        'name'   => $data['name']
      ];

    }

  }

  return $types;

}

function contracts_expiring() {

  $contracts = [];

  $query = "SELECT user.user_id, user.firstname, user.lastname, user_info.contract_end
    FROM user_info
    LEFT JOIN user
    ON user.user_id = user_info.user_id
    WHERE user_info.contract_end BETWEEN CURDATE() - INTERVAL 40 DAY AND CURDATE()";

  if ($res = sql::$con->query($query)) {

    while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

      $contracts[] = [
        'user_id'   => $data['user_id'],
        'firstname' => $data['firstname'],
        'lastname'  => $data['lastname'],
        'expires'   => $data['contract_end']
      ];

    }

  }

  return $contracts;

}

function contracts_expired() {

  $contracts = [];

  $query = "SELECT user.user_id, user.firstname, user.lastname, user_info.contract_end
    FROM user_info
    LEFT JOIN user
    ON user.user_id = user_info.user_id
    WHERE user_info.contract_end <= CURDATE()";

  if ($res = sql::$con->query($query)) {

    while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

      $contracts[] = [
        'user_id'   => $data['user_id'],
        'firstname' => $data['firstname'],
        'lastname'  => $data['lastname'],
        'expired'   => $data['contract_end']
      ];

    }

  }

  return $contracts;

}

function cards_expiring() {

  $cards = [];

  $query = "SELECT user.user_id, user.firstname, user.lastname, user_info.card_exp
    FROM user_info
    LEFT JOIN user
    ON user.user_id = user_info.user_id
    WHERE user_info.card_exp BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE()";

  if ($res = sql::$con->query($query)) {

    while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

      $cards[] = [
        'user_id'   => $data['user_id'],
        'firstname' => $data['firstname'],
        'lastname'  => $data['lastname'],
        'expires'   => $data['card_exp']
      ];

    }

  }

  return $cards;

}

function cards_expired() {

  $cards = [];

  $query = "SELECT user.user_id, user.firstname, user.lastname, user_info.card_exp
    FROM user_info
    LEFT JOIN user
    ON user.user_id = user_info.user_id
    WHERE user_info.card_exp <= CURDATE()";

  if ($res = sql::$con->query($query)) {

    while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

      $cards[] = [
        'user_id'   => $data['user_id'],
        'firstname' => $data['firstname'],
        'lastname'  => $data['lastname'],
        'expired'   => $data['card_exp']
      ];

    }

  }

  return $cards;

}

function ids_expiring() {

  $cards = [];

  $query = "SELECT user.user_id, user.firstname, user.lastname, user_info.id_exp
    FROM user_info
    LEFT JOIN user
    ON user.user_id = user_info.user_id
    WHERE user_info.id_exp BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()";

  if ($res = sql::$con->query($query)) {

    while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

      $cards[] = [
        'user_id'   => $data['user_id'],
        'firstname' => $data['firstname'],
        'lastname'  => $data['lastname'],
        'expires'   => $data['id_exp']
      ];

    }

  }

  return $cards;

}

function ids_expired() {

  $cards = [];

  $query = "SELECT user.user_id, user.firstname, user.lastname, user_info.id_exp
    FROM user_info
    LEFT JOIN user
    ON user.user_id = user_info.user_id
    WHERE user_info.id_exp <= CURDATE()";

  if ($res = sql::$con->query($query)) {

    while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

      $cards[] = [
        'user_id'   => $data['user_id'],
        'firstname' => $data['firstname'],
        'lastname'  => $data['lastname'],
        'expired'   => $data['id_exp']
      ];

    }

  }

  return $cards;

}

function uncompleted_tasks() {

  $tasks = 0;

  $query = "SELECT task_id
    FROM user_task
    WHERE complete = 0";

  if ($res = sql::$con->query($query)) {

    $tasks = $res->num_rows;

  }

  return $tasks;

}

function birthdate_to_age($birthdate) {

  $date = new DateTime($birthdate);
  $now = new DateTime();
  $interval = $now->diff($date);

  return $interval->y;

}

function is_user_available($user_id, $shift_id, $time_start, $time_end) {

  $user_id = (int)$user_id;
  $time_start = date('Y-m-d H:i:s', strtotime($time_start));
  $time_end = date('Y-m-d H:i:s', strtotime($time_end));

  $available = 1;

  $query = "SELECT shift_id, shift_uid
    FROM shift
    WHERE shift_id != $shift_id
    AND user_id = $user_id
    AND ((time_start BETWEEN '$time_start' AND '$time_end'
      OR time_end BETWEEN '$time_start' AND '$time_end')
      OR ('$time_start' BETWEEN time_start AND time_end
      OR '$time_end' BETWEEN time_start AND time_end));";

  if ($res = sql::$con->query($query)) {

    if ($res->num_rows > 0) $available = 0;

  }

  return $available;

}

function translate_month($month) {

  switch (strtolower($month)) {

    case 'january':
      return 'januari';
      break;
    case 'february':
      return 'februari';
      break;
    case 'march':
      return 'maart';
      break;
    case 'april':
      return 'april';
      break;
    case 'may':
      return 'mei';
      break;
    case 'june':
      return 'juni';
      break;
    case 'july':
      return 'juli';
      break;
    case 'august':
      return 'augustus';
      break;
    case 'september':
      return 'september';
      break;
    case 'october':
      return 'oktober';
      break;
    case 'november':
      return 'november';
      break;
    case 'december':
      return 'december';
      break;

  }

}

function translate_day($day) {

  switch (strtolower($day)) {

    case 'monday':
      return 'maandag';
      break;
    case 'tuesday':
      return 'dinsdag';
      break;
    case 'wednesday':
      return 'woensdag';
      break;
    case 'thursday':
      return 'donderdag';
      break;
    case 'friday':
      return 'vrijdag';
      break;
    case 'saturday':
      return 'zaterdag';
      break;
    case 'sunday':
      return 'zondag';
      break;

  }

}

/**
 * Enable CORS. Original code https://stackoverflow.com/a/9866124/10144060
 * @return void
 */
function enable_cors()
{

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        }
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers:" . $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']);
        }
        exit(0);
    }
}

/**
 * Function for upload files
 *
 * @param string $path
 * @param string $filename
 * @return string|bool
 */
function upload_files($path, $filename)
{
    if((isset($filename['name'])) and (!empty($filename['name']))){
        $file_info = pathinfo($filename['name']);
        $megabyte = 1048576;
        if ($filename['size'] <= 20 * $megabyte){
            if(!file_exists($path)){// if dir doesn't exists
                mkdir($path, 0755, true);
            }
            $file = str_replace(' ', '-',$filename['name']);
            if(strlen($file) >= 244){// if file name very-very long - autocreate unique name
                $file = time().$file;
                $file = substr($file, 0, 244);
            }
            $target_file = $path . $file;
            if(file_exists($target_file)){
                $target_file = $path.'/'.$file_info['filename'].'-'.str_replace('.', '', microtime(true)).'.'.$file_info['extension'];
            }

            if(move_uploaded_file($filename['tmp_name'], $target_file)){
                return $target_file;
            }else{
                return false;
            }
        }
        if(file_exists($filename['tmp_name'])){
            $file = pathinfo($filename['tmp_name']);
            $file = $file['dirname'].'/'.$file['basename'];
            unlink($file);
        }
    }
}

/**
 * Function for multi upload files
 *
 * @param string $path
 * @param string $filename
 * @return array
 */
function multi_upload_files($path, $filename, $whitelist)
{
    $result = array();
    $i_stop = count($filename['name']);
    for($i=0;$i<$i_stop;$i++){
        if(isset($filename['name'][$i])){
            $megabyte = 1048576;

            $file_info = pathinfo($filename['name'][$i]);

            if ( ($filename['size'][$i] <= 20 * $megabyte) and (in_array(pathinfo($filename['name'][$i], PATHINFO_EXTENSION), $whitelist)) ){
                if(!file_exists($path)){// if dir doesn't exists
                    mkdir($path, 0755, true);
                }

                $file = str_replace(' ', '-', $filename['name'][$i]);
                if(strlen($file) >= 244){// if file name very-very long - autocreate unique name
                    $file = time().$file;
                    $file = substr($file, 0, 244);
                }

                $target_file = $path .'/'. $file;
                if(file_exists($target_file)){
                    $target_file = $path.'/'.$file_info['filename'].'-'.str_replace('.', '', microtime(true)).'.'.$file_info['extension'];
                }
                if(move_uploaded_file($filename['tmp_name'][$i], $target_file)){
                    $result[$i] = $target_file;
                }else{
                    $result[$i] = false;
                }
            }else{
                $result[$i] = false;
            }
            if(file_exists($filename['tmp_name'][$i])){
                $file = pathinfo($filename['tmp_name'][$i]);
                $file = $file['dirname'].'/'.$file['basename'];
                unlink($file);
            }
        }
    }
    return $result;
}

/**
 * Function for delete files
 *
 * @param string $path_to_file
 * @return bool
 */
function delete_files($path_to_file)
{
    if(file_exists($path_to_file)){
        return unlink($path_to_file);
    }else{
      return false;
    }
}

?>
