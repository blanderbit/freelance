<?php

class User
{

    public function get_id($uid)
    {

        $id = 0;

        $query = "SELECT user_id FROM user WHERE user_uid = '$uid';";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $id = $data['user_id'];

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $id;

    }

    public function get_uid($id)
    {

        $uid = 0;

        $query = "SELECT user_uid FROM user WHERE user_id = $id;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $uid = $data['user_uid'];

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $uid;

    }


    public function is_signed_in()
    {

        if (isset($_SESSION['id'])) return true;

    }

    public function sign_in($email, $password)
    {

        $query = "SELECT user_uid, email, firstname, lastname, password
        FROM user WHERE email = '$email' LIMIT 1;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                if (strlen($data['password']) >= 6) {

                    if (password_verify($password, $data['password'])) {

                        $_SESSION = [
                            'id' => md5(uniqid($data['user_uid'], true)),
                            'user_id' => $_SESSION['user_uid'] = $data['user_uid'],
                            'user_email' => $data['email'],
                            'user_firstname' => $data['firstname'],
                            'user_lastname' => $data['lastname']
                        ];

                        return true;

                    }

                }

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

    }

    public function sign_out()
    {

        session_destroy();
        session_unset();
        unset($_SESSION['id']);
        $_SESSION = [];

    }

    public function add($data)
    {

        $user_uid = md5(uniqid(rand(), true));
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        /*
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $role_id = $data['role_id'];
        */

        $firstname = 'John';
        $lastname = 'Doe';
        $role_id = '1';
        $created = date('Y-m-d H:i:s');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            response_json(['error' => 'E-mail address is invalid'], 400);
            throw new Exception('E-mail address is invalid');
        }
        //if(!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $email)) throw new Exception('E-mail address is invalid');
        if ($this->user_email_exists($email)) {
            response_json(['error' => 'E-mail address is already taken'], 400);
            throw new Exception('E-mail address is already taken');

        }

        $query = "INSERT INTO user (user_uid, email, password, firstname, lastname, role_id, created)
      VALUES ('$user_uid', '$email', '$password', '$firstname', '$lastname', $role_id, '$created');
    INSERT INTO user_contact (user_id)
      VALUES (LAST_INSERT_ID());
    INSERT INTO user_info (user_id)
      VALUES (LAST_INSERT_ID());
    INSERT INTO user_clothing (user_id)
      VALUES (LAST_INSERT_ID());";

        if (sql::$con->multi_query($query) === true) return sql::$con->insert_id;

    }

    public function update($id, $data)
    {

        $firstname = addslashes($data['firstname']);
        $lastname = addslashes($data['lastname']);
        $birthdate = date('Y-m-d', strtotime($data['birthdate']));
        $role_id = (int)$data['role_id'];
        $drivers_license = (int)$data['drivers_license'];
        $email = $data['email'];
        $password = $data['password'];
        $phone = $data['phone'];
        $street = addslashes($data['street']);
        $street_number = $data['street_number'] ?: 0;
        $street_extra = $data['street_extra'];
        $postal = $data['postal'];
        $city = addslashes($data['city']);
        $country = addslashes($data['country']);
        $nationality = addslashes($data['nationality']);
        $birth_city = addslashes($data['birth_city']);
        $birth_country = addslashes($data['birth_country']);
        $id_id = (int)$data['id_id'] ?: 0;
        $id_exp = date('Y-m-d', strtotime($data['id_exp']));
        $csn = (int)$data['csn'] ?: 0;
        $length = $data['length'];
        $wage = $data['wage'] ?: 0.00;
        $travel_cost = $data['travel_cost'];
        $contract_start = date('Y-m-d', strtotime($data['contract_start']));
        $contract_end = date('Y-m-d', strtotime($data['contract_end']));
        $service_start = date('Y-m-d', strtotime($data['service_start']));
        $card_number = (int)$data['card_number'];
        $card_exp = date('Y-m-d', strtotime($data['card_exp']));
        $sizes_shirt = (int)$data['sizes_shirt'];
        $sizes_pants = $data['sizes_pants'];
        $sizes_costume = $data['sizes_costume'];
        $sizes_shoes = $data['sizes_shoes'];

        $query = "START TRANSACTION;
      UPDATE user SET
      email = '$email',
      firstname = '$firstname',
      lastname = '$lastname',
      role_id = $role_id
      WHERE user_id = $id;
      UPDATE user_info SET
      birthdate = '$birthdate',
      birth_city = '$birth_city',
      birth_country = '$birth_country',
      nationality = '$nationality',
      csn = $csn,
      id_id = $id_id,
      id_exp = '$id_exp',
      length = $length,
      wage = $wage,
      travel_cost = $travel_cost,
      card_number = $card_number,
      card_exp = '$card_exp',
      contract_start = '$contract_start',
      contract_end = '$contract_end',
      service_start = '$service_start'
      WHERE user_id = $id;
      UPDATE user_contact SET
      phone = '$phone',
      street = '$street',
      street_number = $street_number,
      street_extra = '$street_extra',
      postal = '$postal',
      city = '$city',
      country = '$country'
      WHERE user_id = $id;
      UPDATE user_clothing SET
      shirt = $sizes_shirt,
      pants = $sizes_pants,
      costume = $sizes_costume,
      shoes = $sizes_shoes
      WHERE user_id = $id;
      COMMIT;";

        if (sql::$con->multi_query($query) === true) return true;

    }

    public function list_all()
    {

        $employees = [];
        /*
         * email
         * roles
         *
         * */

        $query = "SELECT user.user_id, user.user_uid, user.email, user.firstname, user.lastname,
        role.role_id, role.name AS role_name,
        user_info.birthdate, user_info.nationality, user_info.csn, user_info.birth_country, user_info.birth_city, user_info.avatar, user_info.profile_status,
        
        user.email, user.role_id, user_contact.phone, user_contact.country, user_contact.city, user_info.birthdate, user_info.rating, user_info.region AS user_region, user_info.city AS user_city, 
        user_info.age, user_info.about_me, user_info.languages, user_info.location, user_info.relevant_training, user_info.years_experience,
        role.name AS role_name,
        user_place_to_work.name AS user_place_to_work,
        
        user_info.id_id, user_info.id_exp, user_info.length,
        user_info.service_start, user_info.wage, user_info.travel_cost, user_info.contract_id, user_info.contract_start, user_info.contract_end, user_info.card_number, user_info.card_exp,
        user_info.drivers_license, user_info.contract_end_current_time,
        user_contact.phone, user_contact.street, user_contact.street_number, user_contact.street_extra, user_contact.postal, user_contact.city, user_contact.country,
        user_clothing.shirt AS sizes_shirt, user_clothing.costume AS sizes_costume, user_clothing.pants AS sizes_pants, user_clothing.shoes AS sizes_shoes,
        
        hourly_rate.rate AS user_hourly_rate, hourly_rate.title AS user_hourly_rate_title
        
        FROM user
        
        LEFT JOIN role
        ON role.role_id = user.role_id
        LEFT JOIN user_info
        ON user_info.user_id = user.user_id
        LEFT JOIN user_contact
        ON user_contact.user_id = user.user_id
        LEFT JOIN user_clothing
        ON user_clothing.user_id = user.user_id
        
        LEFT JOIN user_place_to_work
        ON user_place_to_work.id = user_info.place_to_work
        
        LEFT JOIN hourly_rate
        ON hourly_rate.id = user_info.hourly_rate
        
        WHERE user_info.profile_status <> 0
        
        ORDER BY user.lastname ASC";

        if ($res = sql::$con->query($query) or die(sql::$con->error)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $contract = $this->contract($data['contract_id']);

                if (!$data['contract_end']) $contract_end = 'Vast';
                else $contract_end = date('Y-m-d', strtotime($data['contract_end']));

                $employees[] = [
                    'id' => $data['user_id'],
                    'uid' => $data['user_uid'],
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'role_id' => $data['role_id'],
                    'role' => $data['role_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'street' => $data['street'],
                    'street_number' => $data['street_number'],
                    'street_extra' => $data['street_extra'],
                    'postal' => $data['postal'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'birthdate' => date('Y-m-d', strtotime($data['birthdate'])),
                    'nationality' => $data['nationality'],
                    'birth_country' => $data['birth_country'],
                    'birth_city' => $data['birth_city'],
                    'csn' => $data['csn'],
                    'id_id' => $data['id_id'],
                    'id_exp' => $data['id_exp'],
                    'length' => $data['length'],
                    'service_start' => date('Y-m-d', strtotime($data['service_start'])),
                    'wage' => $data['wage'],
                    'travel_cost' => $data['travel_cost'],
                    'contract' => $contract,
                    'contract_start' => date('Y-m-d', strtotime($data['contract_start'])),
                    'contract_end' => $contract_end,
                    'contract_end_current_time' => $data['contract_end_current_time'],
                    'card_number' => $data['card_number'],
                    'card_exp' => date('Y-m-d', strtotime($data['card_exp'])),
                    'driver_license' => $data['drivers_license'],
                    'rating' => $data['rating'],
                    'user_hourly_rate' => $data['user_hourly_rate'],
                    'user_hourly_rate_title' => $data['user_hourly_rate_title'],
                    'user_place_to_work'=>$data['user_place_to_work'],
                    'user_region' => $data['user_region'],
                    'user_city' => $data['user_city'],
                    'user_avatar' => $data['avatar'] != '' ? '/file/avatars/'.$this->get_uid($data['user_id']).'/'.$data['avatar'] : '/image/unknown_person.png',
                    'count_user_weekday_availability_hours' => $this->count_user_weekday_availability_hours($this->get_user_weekday_availability($data['user_id'])),
                    'clothing' => [
                        'shirt' => $data['sizes_shirt'],
                        'costume' => $data['sizes_costume'],
                        'pants' => $data['sizes_pants'],
                        'shoes' => $data['sizes_shoes']
                    ],
                    'user_rewiew' => $this->get_user_reviews($data['user_id']),
                    'user_education_certificats' => $this->get_user_education_certificats($data['user_id']),
                    'skills' => $this->skills($data['user_id']),
                    'portfolio' => $this->get_portfolio_item( $data['user_id']),
                    'weekday_availability' => $this->get_user_weekday_availability($data['user_id']),
                    'previous_work_experience' => $this->get_previous_work_experience($data['user_id']),
                    'age' => $data['age'],
                    'location' => $data['location'],
                    'relevant_training' => $data['relevant_training'],
                    'years_experience' => $data['years_experience'],
                    'about_me' => htmlspecialchars_decode($data['about_me'], ENT_QUOTES|ENT_DISALLOWED),
                    'user_languages' => $this->get_languages_names(unserialize($data['languages'])),

                ];

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $employees;

    }

    public function export($user_id = 'ALL')
    {

        $target_user = "";
        if ($user_id != 'ALL') $target_user = "WHERE user_id = $user_id ";

        $info = [];

        $query = "SELECT user.user_id, user.user_uid, user.email, user.firstname, user.lastname,
      role.role_id, role.name AS role_name,
      user_info.birthdate, user_info.nationality, user_info.csn, user_info.birth_country, user_info.birth_city,
      user_info.id_id, user_info.id_exp, user_info.length,
      user_info.service_start, user_info.wage, user_info.travel_cost, user_info.contract_id, user_info.contract_start, user_info.contract_end, user_info.card_number, user_info.card_exp,
      user_info.drivers_license, user_info.rating,
      user_contact.phone, user_contact.street, user_contact.street_number, user_contact.street_extra, user_contact.postal, user_contact.city, user_contact.country,
      user_clothing.shirt AS sizes_shirt, user_clothing.costume AS sizes_costume, user_clothing.pants AS sizes_pants, user_clothing.shoes AS sizes_shoes
      FROM user
      LEFT JOIN role
      ON role.role_id = user.role_id
      LEFT JOIN user_info
      ON user_info.user_id = user.user_id
      LEFT JOIN user_contact
      ON user_contact.user_id = user.user_id
      LEFT JOIN user_clothing
      ON user_clothing.user_id = user.user_id
      $target_user;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $contract = $this->contract($data['contract_id']);

                if (!$data['contract_end']) $contract_end = 'Vast';
                else $contract_end = date('Y-m-d', strtotime($data['contract_end']));

                $address = $data['street'] . ' ' . $data['street_number'];
                if ($data['street_extra']) $address .= ' ' . $data['street_extra'];

                if ($data['drivers_license']) $drivers_license = 'Ja';
                else $drivers_license = 'Nee';

                $info[] = [
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'role' => $data['role_title'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'address' => $address,
                    'postal' => $data['postal'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'birthdate' => date('Y-m-d', strtotime($data['birthdate'])),
                    'nationality' => $data['nationality'],
                    'birth_country' => $data['birth_country'],
                    'birth_city' => $data['birth_city'],
                    'csn' => $data['csn'],
                    'id_id' => $data['id_id'],
                    'id_exp' => $data['id_exp'],
                    'length' => $data['length'],
                    'service_start' => date('Y-m-d', strtotime($data['service_start'])),
                    'wage' => $data['wage'],
                    'travel_cost' => $data['travel_cost'],
                    'contract' => $contract,
                    'contract_start' => date('Y-m-d', strtotime($data['contract_start'])),
                    'contract_end' => $contract_end,
                    'card_number' => $data['card_number'],
                    'card_exp' => date('Y-m-d', strtotime($data['card_exp'])),
                    'drivers_license' => $drivers_license,
                    'rating' => $data['rating'],
                    'shirt' => $data['sizes_shirt'],
                    'costume' => $data['sizes_costume'],
                    'pants' => $data['sizes_pants'],
                    'shoes' => $data['sizes_shoes']
                ];

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $info;

    }

    public function info($id)
    {

        $id = (int)$id;
        $info = [];


        $query = "SELECT user.user_id, user.user_uid, user.email, user.firstname, user.lastname,
        role.role_id, role.name AS role_name,
        user_info.birthdate, user_info.nationality, user_info.csn, user_info.birth_country, user_info.birth_city, user_info.region AS user_region, user_info.city AS user_city, user_info.avatar,
        
        user.email, user.role_id, user_contact.phone, user_contact.country, user_contact.city, user_info.birthdate, user_info.rating, user_info.contract_end_current_time, 
        user_info.profile_status, user_info.age, user_info.about_me, user_info.languages, 
        user_info.location, user_info.relevant_training, user_info.years_experience, user_info.languages, 
        role.name AS role_name,
        user_place_to_work.name AS user_place_to_work,
        
        user_info.id_id, user_info.id_exp, user_info.length,
        user_info.service_start, user_info.wage, user_info.travel_cost, user_info.contract_id, user_info.contract_start, user_info.contract_end, user_info.card_number, user_info.card_exp,
        user_info.drivers_license,
        user_contact.phone, user_contact.street, user_contact.street_number, user_contact.street_extra, user_contact.postal, user_contact.city, user_contact.country,
        user_clothing.shirt AS sizes_shirt, user_clothing.costume AS sizes_costume, user_clothing.pants AS sizes_pants, user_clothing.shoes AS sizes_shoes,
        
        hourly_rate.rate AS user_hourly_rate, hourly_rate.title AS user_hourly_rate_title
        
        FROM user
        
        LEFT JOIN role
        ON role.role_id = user.role_id
        LEFT JOIN user_info
        ON user_info.user_id = user.user_id
        LEFT JOIN user_contact
        ON user_contact.user_id = user.user_id
        LEFT JOIN user_clothing
        ON user_clothing.user_id = user.user_id
        LEFT JOIN hourly_rate
        ON hourly_rate.id = user_info.hourly_rate
        
        LEFT JOIN user_place_to_work
        ON user_place_to_work.id = user_info.place_to_work
        WHERE user.user_id = $id AND profile_status <> 0;";

        if ($res = sql::$con->query($query) or die(sql::$con->error)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $contract = $this->contract($data['contract_id']);

                if (!$data['contract_end']) $contract_end = 'Vast';
                else $contract_end = date('Y-m-d', strtotime($data['contract_end']));

                $info = [
                    'id' => $data['user_id'],
                    'uid' => $data['user_uid'],
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'role_id' => $data['role_id'],
                    'role' => $data['role_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'street' => $data['street'],
                    'street_number' => $data['street_number'],
                    'street_extra' => $data['street_extra'],
                    'postal' => $data['postal'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'birthdate' => date('Y-m-d', strtotime($data['birthdate'])),
                    'nationality' => $data['nationality'],
                    'birth_country' => $data['birth_country'],
                    'birth_city' => $data['birth_city'],
                    'csn' => $data['csn'],
                    'id_id' => $data['id_id'],
                    'id_exp' => $data['id_exp'],
                    'length' => $data['length'],
                    'service_start' => date('Y-m-d', strtotime($data['service_start'])),
                    'wage' => $data['wage'],
                    'travel_cost' => $data['travel_cost'],
                    'contract' => $contract,
                    'contract_start' => date('Y-m-d', strtotime($data['contract_start'])),
                    'contract_end' => $contract_end,
                    'contract_end_current_time' => $data['contract_end_current_time'],
                    'card_number' => $data['card_number'],
                    'card_exp' => date('Y-m-d', strtotime($data['card_exp'])),
                    'driver_license' => $data['drivers_license'],
                    'user_hourly_rate' => $data['user_hourly_rate'],
                    'user_hourly_rate_title' => $data['user_hourly_rate_title'],
                    'user_place_to_work' => $data['user_place_to_work'],
                    'user_region' => $data['user_region'],
                    'user_city' => $data['user_city'],
                    'user_avatar' => $data['avatar'] != '' ? '/file/avatars/'.$this->get_uid($data['user_id']).'/'.$data['avatar'] : '/image/unknown_person.png',
                    'count_user_weekday_availability_hours' => $this->count_user_weekday_availability_hours($this->get_user_weekday_availability($id)),
                    'rating' => $data['rating'],
                    'clothing' => [
                        'shirt' => $data['sizes_shirt'],
                        'costume' => $data['sizes_costume'],
                        'pants' => $data['sizes_pants'],
                        'shoes' => $data['sizes_shoes']
                    ],
                    'user_rewiew' => $this->get_user_reviews($data['user_id']),
                    'user_education_certificats' => $this->get_user_education_certificats($data['user_id']),
                    'skills' => $this->skills($data['user_id']),
                    'portfolio' => $this->get_portfolio_item( $data['user_id']),
                    'weekday_availability' => $this->get_user_weekday_availability($data['user_id']),
                    'previous_work_experience' => $this->get_previous_work_experience($data['user_id']),
                    'user_video' => $this->get_user_video($data['user_id']),
                    'age' => $data['age'],
                    'location' => $data['location'],
                    'relevant_training' => $data['relevant_training'],
                    'years_experience' => $data['years_experience'],
                    'about_me' => htmlspecialchars_decode($data['about_me'], ENT_QUOTES|ENT_DISALLOWED),
                    'user_languages' => $this->get_languages_names(unserialize($data['languages'])),
                ];

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $info;

    }

    public function availability($user_id)
    {

        $availability = [];

        $query = "SELECT user_availability.id, user_availability.user_id, user_availability.comment,
        user_availability.time_start, user_availability.time_end, user_availability.type_id,
        availability_type.description
        FROM user_availability
        LEFT JOIN availability_type
        ON availability_type.type_id = user_availability.type_id
        WHERE user_availability.user_id = $user_id
        AND user_availability.time_start >= CURDATE();";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $availability[] = [
                    'id' => $data['id'],
                    'user_id' => $data['user_id'],
                    'comment' => $data['comment'],
                    'time_start' => $data['time_start'],
                    'time_end' => $data['time_end'],
                    'type_id' => $data['type_id'],
                    'type' => $data['description']
                ];

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $availability;

    }

    public function files($user_id)
    {

        $user_uid = $this->get_uid($user_id);

        $files = [];

        $path = APP . 'file/' . $user_uid . '/';
        $raw_files = scandir($path);

        foreach ($raw_files as $raw_file) {

            if ($raw_file != '.' && $raw_file != '..') {

                $filectime = filectime($path . $raw_file);
                $filesize = filesize($path . $raw_file);

                $files[] = [
                    'name' => $raw_file,
                    'created' => date('Y-m-d', $filectime),
                    'size' => $filesize
                ];

            }

        }

        return $files;

    }

    public function contract($id)
    {

        $id = (int)$id;
        $contract = 'Unknown';

        $query = "SELECT name FROM contract WHERE contract_id = $id";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $contract = $data['name'];

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $contract;

    }

    public function user_email_exists($email)
    {

        $query = "SELECT user_uid FROM user WHERE email = '$email';";

        if ($res = sql::$con->query($query)) {

            if ($res->num_rows) {
                if(is_object($res)){
                    $res->free_result();
                }
                return true;
            } else {
                return false;
            }

        } else {

            return false;

        }

    }

    public function shifts($user_id, $period = 'ALL')
    {

        if (strcasecmp($period, 'UPCOMING')) $where_date = "shift.time_start < CURDATE() ";
        else if (strcasecmp($period, 'COMPLETE')) $where_date = "shift.time_start >= CURDATE() ";
        else $where_date = "shift.time_start IS NOT NULL ";

        $shifts = [];

        $query = "SELECT shift.shift_id, shift.shift_uid, shift.time_start, shift.time_end,
      shift.location_id, shift.confirmed, shift.break,
      location.name AS location_name, location.street, location.street_number,
      location.street_extra, location.postal, location.city, location.country,
      employer.employer_id, employer.name AS employer_name, employer.phone, employer.email
      FROM shift
      LEFT JOIN location
      ON location.location_id = shift.location_id
      LEFT JOIN employer
      ON employer.employer_id = location.employer_id
      WHERE user_id = $user_id
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
                    'employer_id' => $data['employer_id'],
                    'employer_name' => $data['employer_name'],
                    'location_id' => $data['location_id'],
                    'location' => $data['location_name'],
                    'address' => $address,
                    'street' => $data['street'],
                    'street_number' => $data['street_number'],
                    'street_extra' => $data['street_extra'],
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

        if(is_object($res)){
            $res->free_result();
        }

        return $shifts;

    }

    public function shifts_late($user_id)
    {

        $shifts = [];

        $query = "SELECT shift.shift_id, shift.shift_uid, shift.time_start, shift.time_end,
      shift.location_id, shift.confirmed, shift.break, shift.late,
      location.name AS location_name, location.street, location.street_number,
      location.street_extra, location.postal, location.city, location.country,
      employer.employer_id, employer.name AS employer_name, employer.phone, employer.email
      FROM shift
      LEFT JOIN location
      ON location.location_id = shift.location_id
      LEFT JOIN employer
      ON employer.employer_id = location.employer_id
      WHERE shift.user_id = $user_id
      AND shift.late > 0
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
                    'employer_id' => $data['employer_id'],
                    'employer_name' => $data['employer_name'],
                    'location_id' => $data['location_id'],
                    'location' => $data['location_name'],
                    'address' => $address,
                    'street' => $data['street'],
                    'street_number' => $data['street_number'],
                    'street_extra' => $data['street_extra'],
                    'postal' => $data['postal'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'confirmed' => $data['confirmed'],
                    'break' => $data['break'],
                    'late' => $data['late']
                ];

            }

        }

        if(is_object($res)){
            $res->free_result();
        }

        return $shifts;

    }

    public function shifts_export($user_id = 'ALL', $period = 'ALL')
    {

        $target_user = "";
        if ($user_id != 'ALL') $target_user = "AND shift.user_id = $user_id ";

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
      $target_user
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

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $shifts;

    }

    public function roles()
    {

        $roles = [];

        $query = "SELECT role_id, name, filename
      FROM role
      ORDER BY role_id DESC;";

        if ($res = sql::$con->query($query)) {
            $server_url = ( (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == true) ? 'https://' : 'http://' ).$_SERVER['HTTP_HOST'];
            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $roles[] = [
                    'id' => $data['role_id'],
                    'name' => $data['name'],
                    'img_url' => $server_url.'/image/role/'.$data['filename']
                ];

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $roles;

    }

    public function tasks($user_id)
    {

        $tasks = [];

        $query = "SELECT task_id, user_id, description, time_start, time_end, complete
      FROM user_task
      WHERE user_id = $user_id
      ORDER BY complete ASC, task_id DESC;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $tasks[] = [
                    'id' => $data['task_id'],
                    'user_id' => $data['user_id'],
                    'description' => $data['description'],
                    'time_start' => $data['time_start'],
                    'time_end' => $data['time_end'],
                    'complete' => $data['complete']
                ];

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $tasks;

    }

    public function paychecks($user_id, $year = 'current')
    {

        if ($year == 'current') $year = date('Y');

        $paychecks = [];

        for ($i = 12; $i >= 1; $i--) {

            $month = sprintf('%02d', $i);
            $date = $year . '-' . $month . '-01';

            if ($month <= date('m')) $paychecks[$date] = $this->paycheck($user_id, $date);

        }

        return $paychecks;

    }

    public function paycheck($user_id, $month)
    {

        $paycheck = 0;
        $wage = 0;
        $hours = 0;

        $query = "SELECT user.user_id,
      shift.time_start, shift.time_end,
      user_info.wage
      FROM shift
      LEFT JOIN user
      ON user.user_id = shift.user_id
      LEFT JOIN user_info
      ON user_info.user_id = shift.user_id
      WHERE shift.user_id = $user_id
      AND MONTH(shift.time_start) = MONTH('$month')
      AND YEAR(shift.time_start) = YEAR('$month');";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $wage = $data['wage'];
                $hours += time_difference($data['time_start'], $data['time_end']);

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        $paycheck = $hours * $wage;

        return $paycheck;

    }

    public function search($string)
    {

        $users = [];

        $string = str_replace(' ', '+', $string);
        $needles = explode('+', $string);

        $query = "SELECT user_id, user_uid, firstname, lastname
      FROM user
      WHERE firstname != 0 ";

        foreach ($needles as $needle) {

            $query .= "OR firstname LIKE '%$needle%' OR lastname LIKE '%$needle%' OR email LIKE '%$needle%' ";

        }

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $users[] = [
                    'uid' => $data['user_uid'],
                    'name' => $data['firstname'] . ' ' . $data['lastname'],
                    'url' => '/users/' . $data['user_id']
                ];

            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $users;

    }

    /**
     * Get rewiews list on user page
     *
     * @param integer $user_id
     * @return array
     */
    public function get_user_reviews($user_id)
    {
        $user_id = intval($user_id);

        $rewiews = [];

        $query = "SELECT id, author, company_name, company_site, review, rating FROM user_review WHERE user_id='$user_id'";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $rewiews[] = $data;
            }
        }

        return $rewiews;
    }

    /**
     * Get all education certificates
     *
     * @param integer $user_id
     * @return array
     */
    public function get_user_education_certificats($user_id)
    {

        $user_id = intval($user_id);

        $certificates = [];

        $query = "SELECT `uid`, `type`, `file_name`, `title` FROM `user_education_certificats` WHERE `user_id`='$user_id'";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                ///education-certificats/'.$user_education_certificate['type'].'/'.$this_user['uid'].'/'.$user_education_certificate['file_name']
                $data['file_name'] = '/education-certificats/'.$data['type'].'/'.$data['uid'].'/'.$data['file_name'];
                $certificates[] = $data;
            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $certificates;
    }

    /**
     * Get user skills
     *
     * @param int $user_id
     * @return array
     */
    public function skills($user_id){

        $user_id = intval($user_id);

        $skills = [];

        $query = "SELECT `id`, `user_id`, `name` FROM `user_skill` WHERE `user_id`='$user_id'";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $skills[] = $data;
            }

            if(is_object($res)){
                $res->free_result();
            }
        }

        return $skills;
    }

    /**
     * Get all user portfolio items
     *
     * @param int $user_id
     * @return bool
     */
    public function get_portfolio_item($user_id){

        $user_id = intval($user_id);

        $portfolio_items = [];

        $query = "SELECT `id`, `uid`, `full_size`, `crop_size` FROM `user_portfolio` WHERE `user_id`='$user_id'";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                //$data['file_name'] = '/education-certificats/'.$data['type'].'/'.$data['uid'].'/'.$data['file_name'];
                $data['full_size'] = '/file/user-portfolio/'.$data['uid'].'/'.$data['full_size'];
                $data['crop_size'] = '/file/user-portfolio/'.$data['uid'].'/'.$data['crop_size'];
                $portfolio_items[] = $data;
            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $portfolio_items;
    }

    /**
     * Get user days of week and num of hours availability
     *
     * @param int $user_id
     * @return array
     */
    public function get_user_weekday_availability($user_id){

        $user_id = intval($user_id);

        $user_weekday_availability = [];

        $query = "SELECT `id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `hours` FROM `user_weekday_availability` WHERE `user_id`='$user_id' LIMIT 1";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $user_weekday_availability = $data;
            }

            if(is_object($res)){
                $res->free_result();
            }
        }

        if(empty($user_weekday_availability)){
            $user_weekday_availability['monday'] = 0;
            $user_weekday_availability['tuesday'] = 0;
            $user_weekday_availability['wednesday'] = 0;
            $user_weekday_availability['thursday'] = 0;
            $user_weekday_availability['friday'] = 0;
            $user_weekday_availability['saturday'] = 0;
            $user_weekday_availability['sunday'] = 0;
            $user_weekday_availability['hours'] = 0;
            $user_weekday_availability['id'] = '';
        }

        return $user_weekday_availability;

    }

    /**
     * Count hours of user availability in week
     *
     * @param array $availability_array
     * @return int
     */
    public function count_user_weekday_availability_hours($availability_array){
        $total_hours = 0;
        $hours = 0;
        $days_count = 0;

        if(is_array($availability_array)){
            foreach ($availability_array as $key=>&$value) {
                if($key == 'hours'){
                    // select hours value
                    $hours = $value;
                }elseif($key != 'id'){
                    //select availability days
                    if($value != 0){
                        $days_count++;
                    }
                }
            }
        }

        $total_hours = $hours * $days_count;

        return $total_hours;

    }

    /**
     * Get all user previous expirience
     *
     * @param int $user_id
     * @return array
     */
    public function get_previous_work_experience($user_id){

        $user_id = intval($user_id);

        $previous_work_experience = [];

        $query = "SELECT `id`, `uid`, `logo_file_name`, `title`, `description`, `start_to_work`, `stop_to_work`, `contract_end_current_time` FROM `previous_work_experience` WHERE `user_id`='$user_id'";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $data['file_name'] = '/file/previous-work-experience/'.$data['uid'].'/company-logo/'.$data['logo_file_name'];
                $previous_work_experience[] = $data;
            }

            if(is_object($res)){
                $res->free_result();
            }

        }

        return $previous_work_experience;
    }

    /**
     * Get all user portfolio items
     *
     * @param int $user_id
     * @return bool
     */
    public function get_user_video($user_id){

        $user_id = intval($user_id);
        $uid = $this->get_uid($user_id);

        $query = "SELECT `id`, `source`, `uid`, `filename_or_link` FROM `user_video` WHERE `uid`='$uid';";

        $user_videos = [];

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                if($data['source'] == 'local'){
                    $file_path = '/file/video/'.$uid.'/'.$data['filename_or_link'];
                    $data['filename_or_link'] = $file_path;
                }
                $user_videos[] = $data;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }

        }
        /*
         * FOR EXAMPLE FRAMES
         * <iframe style="width: 485px; min-height: 411px;" src="<YOUTUBE-LINK>" frameborder="0" allowfullscreen allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"></iframe>
         * <iframe style="width: 485px; min-height: 411px;" src="<VIMEO-LINK>" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen ></iframe>
         *
         * */

        return $user_videos;
    }

    public function places_to_work(){
        $places_to_work = [];

        $query = "SELECT id, name FROM user_place_to_work";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $places_to_work[$data['id']] = $data['name'];
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
        }

        return $places_to_work;
    }

    /**
     * Get languages names with language id
     *
     * @param array|integer ID or array of ID languages
     * @return array
     */
    public function get_languages_names($lang_identifiers)
    {
        $result = array();
        $serach_indefiers = '';
        //if(is_array($lang_identifiers)){
        foreach ((array)$lang_identifiers as $identifier) {
            $serach_indefiers .= intval($identifier) . ', ';
        }
        $identifier = rtrim($serach_indefiers, ', ');
        //}
        //print_r($lang_identifiers);
        //exit();
        $query = "SELECT `name` FROM `languages` WHERE `id` IN ($identifier)";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $result[] = $data['name'];
            }

        }
        return $result;
    }

}

$user = new User;

?>
