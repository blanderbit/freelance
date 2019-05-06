<?php

class Employer
{

    public function add($data)
    {

        $uid = md5(uniqid(rand(), true));
        $name = addslashes($data['name']);

        $query = "INSERT INTO employer (employer_uid, name)
      VALUES ('$uid', '$name')";

        if (sql::$con->query($query) === true) return sql::$con->insert_id;

    }


    public function list_all()
    {

        $employers = [];

        $query = "SELECT employer_id, employer_uid, name, phone, email
      FROM employer";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $employers[] = [
                    'id' => $data['employer_id'],
                    'uid' => $data['employer_uid'],
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'email' => $data['email']
                ];

            }

        }

        return $employers;

    }

    public function update($id, $data)
    {

        $name = addslashes($data['name']);
        $phone = $data['phone'];
        $email = $data['email'];
        $street = addslashes($data['street']);
        $street_number = $data['street_number'];
        $street_extra = addslashes($data['street_extra']);
        $postal = $data['postal'];
        $city = addslashes($data['city']);
        $country = addslashes($data['country']);
        $kvk = $data['kvk'];
        $iban = $data['iban'];

        $query = "UPDATE employer SET
      name = '$name',
      phone = '$phone',
      email = '$email',
      street = '$street',
      street_number = $street_number,
      street_extra = '$street_extra',
      postal = '$postal',
      city = '$city',
      country = '$country',
      kvk = '$kvk',
      iban = '$iban'
      WHERE employer_id = $id;";

        if (sql::$con->query($query) === true) return true;

    }

    public function info($id)
    {

        $id = (int)$id;
        $info = [];

        $query = "SELECT employer.employer_id, employer.employer_uid, employer.name,
      employer.email, employer.phone, employer.street, employer.street_number, employer.street_extra, employer.postal, employer.city, employer.country,
      employer.kvk, employer.iban
      FROM employer
      WHERE employer.employer_id = $id;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $info = [
                    'id' => $data['employer_id'],
                    'uid' => $data['employer_uid'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    //'group' => $data['group_title'],
                    'street' => $data['street'],
                    'street_number' => $data['street_number'],
                    'street_extra' => $data['street_extra'],
                    'postal' => $data['postal'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'kvk' => $data['kvk'],
                    'iban' => $data['iban']
                ];

            }

        }

        return $info;

    }

    public function export($employer_id = 'ALL')
    {

        $target_employer = "";
        if ($employer_id != 'ALL') $target_employer = "WHERE employer.employer_id = $employer_id ";

        $info = [];

        $query = "SELECT employer.employer_id, employer.employer_uid, employer.name,
        employer.email, employer.phone, employer.street, employer.street_number, employer.street_extra, employer.postal, employer.city, employer.country,
        employer.kvk, employer.iban
        FROM employer
        $target_employer;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $address = $data['street'] . ' ' . $data['street_number'];
                if ($data['street_extra']) $address .= ' ' . $data['street_extra'];

                $info[] = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'address' => $address,
                    'postal' => $data['postal'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'kvk' => $data['kvk'],
                    'iban' => $data['iban']
                ];

            }

        }

        error_log(print_r($info, true));

        return $info;

    }


    public function shifts($employer_id, $period = 'ALL')
    {

        if (strcasecmp($period, 'UPCOMING')) $where_date = "shift.time_start < CURDATE() ";
        else if (strcasecmp($period, 'COMPLETE')) $where_date = "shift.time_start >= CURDATE() ";
        else $where_date = "shift.time_start IS NOT NULL ";

        $shifts = [];

        $locations = $this->location_ids($employer_id);
        $locations = implode(',', $locations);

        $query = "SELECT shift.shift_id, shift.shift_uid, shift.time_start, shift.time_end,
        shift.location_id, shift.confirmed, shift.break,
        location.name AS location_name, location.street, location.street_number,
        location.street_extra, location.postal, location.city, location.country,
        employer.name AS employer_name, employer.phone, employer.email,
        user.user_id, user.firstname, user.lastname
        FROM shift
        LEFT JOIN location
        ON location.location_id = shift.location_id
        LEFT JOIN employer
        ON employer.employer_id = shift.location_id
        LEFT JOIN user
        ON user.user_id = shift.user_id
        WHERE shift.location_id IN ($locations)
        AND $where_date
        ORDER BY shift.time_start DESC
        LIMIT 30;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $address = $data['street'] . ' ' . $data['street_number'];
                if ($data['street_extra']) $address .= ' ' . $data['street_extra'];

                $hours = time_difference($data['time_start'], $data['time_end']);

                $shifts[] = [
                    'id' => $data['shift_id'],
                    'uid' => $data['shift_uid'],
                    'time_start' => date('Y-m-d H:i', strtotime($data['time_start'])),
                    'time_end' => date('Y-m-d H:i', strtotime($data['time_end'])),
                    'hours' => $hours,
                    'user_id' => $data['user_id'],
                    'user_name' => $data['firstname'] . ' ' . $data['lastname'],
                    'user_firstname' => $data['firstname'],
                    'user_lastname' => $data['lastname'],
                    'location_id' => $data['location_id'],
                    'location' => $data['location_name'],
                    'address' => $address,
                    'street' => $data['street'],
                    'street_number' => $data['street_number'],
                    'street_extra' => $data['street_extra'],
                    'employer' => $data['employer_name'],
                    'postal' => $data['postal'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'confirmed' => $data['confirmed'],
                    'break' => $data['break']
                ];

            }

        }

        return $shifts;

    }

    public function shifts_export($employer_id = 'ALL', $period = 'ALL')
    {

        $target_employer = "";

        if ($employer_id != 'ALL') {

            $locations = $this->location_ids($employer_id);
            $locations = implode(',', $locations);
            $target_employer = "AND shift.location_id IN ($locations) ";

        }

        if (strcasecmp($period, 'UPCOMING')) $target_period = "WHERE shift.time_start < CURDATE() ";
        else if (strcasecmp($period, 'COMPLETE')) $target_period = "WHERE shift.time_start >= CURDATE() ";
        else $target_period = "WHERE shift.time_start IS NOT NULL ";

        $shifts = [];

        $query = "SELECT shift.shift_id, shift.shift_uid, shift.time_start, shift.time_end,
        shift.location_id, shift.confirmed, shift.break,
        location.name AS location_name, location.street, location.street_number,
        location.street_extra, location.postal, location.city, location.country,
        employer.employer_id, employer.name AS employer_name, employer.phone AS employer_phone, employer.email,
        user.firstname AS user_firstname, user.lastname AS user_lastname,
        user_contact.phone AS user_phone
        FROM shift
        LEFT JOIN location
        ON location.location_id = shift.location_id
        LEFT JOIN employer
        ON employer.employer_id = location.employer_id
        LEFT JOIN user
        ON user.user_id = shift.user_id
        LEFT JOIN user_contact
        ON user_contact.user_id = shift.user_id
        $target_period
        $target_employer
        ORDER BY shift.time_start DESC
        LIMIT 30;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $address = $data['street'] . ' ' . $data['street_number'];
                if ($data['street_extra']) $address .= ' ' . $data['street_extra'];

                $shifts[] = [
                    'date_start' => date('m-d-Y', strtotime($data['time_start'])),
                    'time_start' => date('H:i', strtotime($data['time_start'])),
                    'time_end' => date('H:i', strtotime($data['time_end'])),
                    'user_name' => $data['user_firstname'] . ' ' . $data['user_lastname'],
                    'user_phone' => $data['user_phone'],
                    'employer_name' => $data['employer_name'],
                    'employer_phone' => $data['employer_phone'],
                    'location_name' => $data['location_name'],
                    'address' => $address,
                    'postal' => $data['postal'],
                    'city' => $data['city'],
                    'country' => $data['country']
                ];

            }

        }

        return $shifts;

    }

    public function get_id($uid)
    {

        $id = 0;

        $query = "SELECT employer_id FROM employer WHERE employer_uid = '$uid';";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $id = $data['employer_id'];

            }

        }

        return $id;

    }

    public function search($string)
    {

        $employers = [];

        $string = str_replace(' ', '+', $string);
        $needles = explode('+', $string);

        $query = "SELECT employer_id, employer_uid, name
        FROM employer
        WHERE name LIKE '.' ";

        foreach ($needles as $needle) {

            $query .= "OR name LIKE '%$needle%'";

        }

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $employers[] = [
                    'uid' => $data['employer_uid'],
                    'name' => $data['name'],
                    'url' => '/employers/' . $data['employer_id']
                ];

            }

        }

        return $employers;

    }

    public function locations($id)
    {

        $locations = [];

        $query = "SELECT location_id, name, dress_code, street, street_number, street_extra, postal, city, country
      FROM location
      WHERE employer_id = $id;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $address = $data['street'] . ' ' . $data['street_number'];
                if (strlen($data['street_extra'])) $address .= ' ' . $data['street_extra'];

                $locations[] = [
                    'id' => $data['location_id'],
                    'name' => $data['name'],
                    'dress_code' => $data['dress_code'],
                    'street' => $data['street'],
                    'street_number' => $data['street_number'],
                    'street_extra' => $data['street_extra'],
                    'postal' => $data['postal'],
                    'city' => $data['city'],
                    'country ' => $data['country'],
                    'address' => $address
                ];

            }

        }

        return $locations;

    }

    public function location_ids($id)
    {

        $locations = [];

        $query = "SELECT location_id FROM location WHERE employer_id = $id;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $locations[] = $data['location_id'];

            }

        }

        return $locations;

    }

}

$employer = new Employer;

?>
