<?php

class Location {

  public function add($data) {

    $employer_id = (int)$data['employer_id'];
    $name = addslashes($data['name']);
    $dress_code = addslashes($data['dress_code']);
    $street = addslashes($data['street']);
    $street_number = (int)$data['street_number'];
    $street_extra = addslashes($data['street_extra']);
    $postal = $data['postal'];
    $city = addslashes($data['city']);
    $country = addslashes($data['country']);

    $query = "INSERT INTO location (employer_id, name, dress_code, street, street_number, street_extra, postal, city, country)
      VALUES ($employer_id, '$name', '$dress_code', '$street', $street_number, '$street_extra', '$postal', '$city', '$country')";

    if (sql::$con->query($query) === true) return true;

  }

  public function update($id, $data) {

    $employer_id = (int)$data['employer_id'];
    $name = addslashes($data['name']);
    $dress_code = addslashes($data['dress_code']);
    $street = addslashes($data['street']);
    $street_number = (int)$data['street_number'];
    $street_extra = addslashes($data['street_extra']);
    $postal = $data['postal'];
    $city = addslashes($data['city']);
    $country = addslashes($data['country']);

    $query = "UPDATE location
      SET employer_id = $employer_id,
          name = '$name',
          dress_code = '$dress_code',
          street = '$street',
          street_number = $street_number,
          street_extra = '$street_extra',
          postal = '$postal',
          city = '$city',
          country = '$country'
      WHERE location_id = $id";

    if (sql::$con->query($query) === true) return true;

  }

  public function info($id) {

    $id = (int)$id;
    $location = [];

    $query = "SELECT location_id, employer_id, name, dress_code, street, street_number, street_extra, postal, city, country
      FROM location WHERE location_id = $id";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $location = [
          'id'            => $data['location_id'],
          'employer_id'   => $data['employer_id'],
          'name'          => $data['name'],
          'dress_code'    => $data['dress_code'],
          'street'        => $data['street'],
          'street_number' => $data['street_number'],
          'street_extra'  => $data['street_extra'],
          'postal'        => $data['postal'],
          'city'          => $data['city'],
          'country'       => $data['country']
        ];

      }

    }

    return $location;

  }

  public function export($employer_id = 'ALL') {

    $target_employer = "";
    if ($employer_id != 'ALL') $target_employer = "WHERE employer.employer_id = $employer_id ";

    $info = [];

    $query = "SELECT location.name, location.dress_code, location.street, location.street_number, location.street_extra, location.postal, location.city, location.country,
      employer.name AS employer_name
      FROM location
      LEFT JOIN employer
      ON employer.employer_id = location.employer_id
      $target_employer;";

    if ($res = sql::$con->query($query)) {

      while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

        $address = $data['street'] . ' ' . $data['street_number'];
        if ($data['street_extra']) $address .= ' ' . $data['street_extra'];

        $info[] = [
          'name'          => $data['name'],
          'employer_name' => $data['employer_name'],
          'address'       => $address,
          'postal'        => $data['postal'],
          'city'          => $data['city'],
          'country'       => $data['country'],
          'dress_code'    => $data['dress_code']
        ];

      }

    }

    return $info;

  }

}

$location = new Location;

?>
