<?php

class User
{

    public function get_id($uid)
    {

        $id = 0;

        $query = "SELECT user_id FROM user WHERE user_uid = '$uid';";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $id = $data['user_id'];

            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }

        }

        return $id;

    }

    public function get_uid($id)
    {

        $uid = 0;

        $query = "SELECT user_uid FROM user WHERE user_id = $id;";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $uid = $data['user_uid'];

            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

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
                $res->close();
                sql::$con->store_result();
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
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $role_id = $data['role_id'];
        $created = date('Y-m-d H:i:s');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception('E-mail address is invalid');
        if ($this->user_email_exists($email)) throw new Exception('E-mail address is already taken');

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

        $profile_status = intval($data['profile_status']);// 1 - published ; 0 - draft (unpublished)
        $firstname = addslashes($data['firstname']);
        $lastname = addslashes($data['lastname']);
        $birthdate = date('Y-m-d', strtotime($data['birthdate']));
        $age = intval($data['age']);
        $role_id = (int)$data['role_id'];
        $drivers_license = intval($data['drivers_license']);
        $email = $data['email'];
        $password = $data['password'];
        $phone = $data['phone'];
        $street = addslashes($data['street']);
        $street_number = $data['street_number'] ?: 0;
        $street_extra = $data['street_extra'];
        $postal = $data['postal'];
        $region = addslashes($data['region']);
        $city = $data['city'];
        $country = $data['country'];
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
        $contract_end_current_time = ($data['contract_end_current_time'] == 'on') ? 1 : 0;
        $service_start = date('Y-m-d', strtotime($data['service_start']));
        $card_number = (int)$data['card_number'];
        $card_exp = date('Y-m-d', strtotime($data['card_exp']));
        $sizes_shirt = (int)$data['sizes_shirt'];
        $sizes_pants = $data['sizes_pants'];
        $sizes_costume = $data['sizes_costume'];
        $sizes_shoes = $data['sizes_shoes'];
        $place_to_work = $data['place_to_work'];
        $skills = $data['skills'];
        $hourly_rate = $data['hourly_rate'];
        $user_avatar = $data['user_avatar'];
        $old_user_avatar = $data['old_user_avatar'];
        $location = $data['location'];
        $years_experience = $data['years_experience'];
        $relevant_training = $data['relevant_training'];
        $about_me = htmlspecialchars($data['about_me'],ENT_QUOTES|ENT_DISALLOWED);
        $user_languages = serialize(array_slice($data['user_languages'], 0, 10));

        $avatar_sql = "";
        if($user_avatar['name'] != ''){
            $path_to_avatars = APP.'file/avatars/'.$this->get_uid($id).'/';
            $uploaded_file = pathinfo(upload_files($path_to_avatars, $user_avatar));
            if(!empty($uploaded_file['basename'])){
                if($old_user_avatar != ''){
                    delete_files($path_to_avatars.$old_user_avatar);
                }
                $avatar_sql = "`avatar`='".$uploaded_file['basename']."', ";
            }
        }

        $skills_sql = 'INSERT INTO `user_skill`(`user_id`, `name`) VALUES ';
        $skills_count = count($skills);
        if($skills_count > 15){
            $skills_count = 15;
        }
        for($i=0; $i<$skills_count; $i++){
            $skills_sql .= '(\''.$id.'\', \''.$skills[$i].'\'), ';
        }
        $skills_sql = rtrim($skills_sql, ', ');
        $skills_sql .= ';';

        if($skills_count == 0){
            $skills_sql = '';
        }

        $query = "START TRANSACTION;
        UPDATE user SET
        email = '$email',
        firstname = '$firstname',
        lastname = '$lastname',
        role_id = $role_id
        WHERE user_id = $id;
DELETE FROM `user_skill` WHERE `user_id`='$id';
-- reset autoincrement start
SET @i :=0;
UPDATE `user_skill` SET  `id` = (@i := @i + 1);
ALTER TABLE `user_skill` AUTO_INCREMENT = 1;
-- reset autoincrement end
        $skills_sql
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
        contract_end_current_time = '$contract_end_current_time',
        service_start = '$service_start',
        place_to_work = '$place_to_work',
        hourly_rate = '$hourly_rate',
        city = '$city',
        region = '$region',
        ".$avatar_sql."
        profile_status = '$profile_status',
        age = '$age',
        location = '$location',
        relevant_training = '$relevant_training',
        years_experience = '$years_experience',
        about_me = '$about_me',
        languages = '$user_languages',
        drivers_license = '$drivers_license'
        WHERE user_id = $id;
        UPDATE user_contact SET
        phone = '$phone',
        street = '$street',
        street_number = $street_number,
        street_extra = '$street_extra',
        postal = '$postal',
        country = '$country'
        WHERE user_id = $id;
        UPDATE user_clothing SET
        shirt = '$sizes_shirt',
        pants = '$sizes_pants',
        costume = '$sizes_costume',
        shoes = '$sizes_shoes'
        WHERE user_id = $id;
        COMMIT;";

        if ($res = sql::$con->multi_query($query) === true){
            while (@sql::$con->next_result()) {}// FREE MULTI QUERY

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }

            //exit(sql::$con->error);

            return true;
        }

    }

    public function list_all()
    {

        $employees = [];
/*
        $query = "SELECT user.user_id, user.user_uid, user.firstname, user.lastname, user.email, user.role_id,
        user_contact.phone,
        user_info.birthdate,
        role.name AS role_name,
        user_place_to_work.name AS user_pace_to_work
        FROM user
        LEFT JOIN user_contact
        ON user_contact.user_id = user.user_id
        LEFT JOIN user_info
        ON user_info.user_id = user.user_id
        LEFT JOIN role
        ON role.role_id = user.role_id
        LEFT JOIN user_place_to_work
        ON user_place_to_work.id = user_info.place_to_work
        ORDER BY user.lastname ASC";
*/

        $query = "SELECT user.user_id, user.user_uid, user.email, user.firstname, user.lastname,
        role.role_id, role.name AS role_name,
        user_info.birthdate, user_info.nationality, user_info.csn, user_info.birth_country, user_info.birth_city, user_info.region AS user_region, user_info.city AS user_city, user_info.avatar, user_info.profile_status,
        
        user.email, user.role_id, user_contact.phone, user_contact.country, user_contact.city, user_info.birthdate, user_info.rating,
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
        
        LEFT JOIN user_place_to_work
        ON user_place_to_work.id = user_info.place_to_work
        
        LEFT JOIN hourly_rate
        ON hourly_rate.id = user_info.hourly_rate
        
        ORDER BY user.lastname ASC";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT) or die(sql::$con->error)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                /*
                $employees[] = [
                    'id' => $data['user_id'],
                    'uid' => $data['user_uid'],
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'role_id' => $data['role_id'],
                    'role_name' => $data['role_name'],
                    'age' => birthdate_to_age($data['birthdate']),
                    'place_to_work' => $data['user_pace_to_work'],
                    'user_hourly_rate' => $data['user_hourly_rate'],
                    'user_hourly_rate_title' => $data['user_hourly_rate_title'],
                ];
                */

                if($data['rating'] == null) {
                    $rating = 0;
                } else {
                    $rating = $data['rating'];
                }

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
                    //'contract' => $contract,
                    'contract_start' => date('Y-m-d', strtotime($data['contract_start'])),
                   // 'contract_end' => $contract_end,
                    'card_number' => $data['card_number'],
                    'card_exp' => date('Y-m-d', strtotime($data['card_exp'])),
                    'drivers_license' => $data['drivers_license'],
                    'rating' => $rating,
                    'user_hourly_rate' => $data['user_hourly_rate'],
                    'user_hourly_rate_title' => $data['user_hourly_rate_title'],
                    'user_place_to_work' => $data['user_place_to_work'],
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
                ];

            }

        }

        if(is_object($res)){
            $res->close();
            sql::$con->store_result();
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
      user_info.drivers_license,
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

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
                    'shirt' => $data['sizes_shirt'],
                    'costume' => $data['sizes_costume'],
                    'pants' => $data['sizes_pants'],
                    'shoes' => $data['sizes_shoes']
                ];

            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }

        }

        return $info;

    }

    public function info($id)
    {

        $id = (int)$id;
        $info = [];

        /*
        $query = "SELECT user.user_id, user.user_uid, user.email, user.firstname, user.lastname,
        role.role_id, role.name AS role_name,
        user_info.birthdate, user_info.nationality, user_info.csn, user_info.birth_country, user_info.birth_city,
        user_info.id_id, user_info.id_exp, user_info.length,
        user_info.service_start, user_info.wage, user_info.travel_cost, user_info.contract_id, user_info.contract_start, user_info.contract_end, user_info.card_number, user_info.card_exp,
        user_info.drivers_license, user_info.place_to_work, user_info.hourly_rate,
        user_contact.phone, user_contact.street, user_contact.street_number, user_contact.street_extra, user_contact.postal, user_contact.city, user_contact.country,
        user_clothing.shirt AS sizes_shirt, user_clothing.costume AS sizes_costume, user_clothing.pants AS sizes_pants, user_clothing.shoes AS sizes_shoes,
        user_place_to_work.name AS user_place_to_work
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
        WHERE user.user_id = $id;";
        */

        $query = "SELECT user.user_id, user.user_uid, user.email, user.firstname, user.lastname,
        role.role_id, role.name AS role_name,
        user_info.birthdate, user_info.nationality, user_info.csn, user_info.birth_country, user_info.birth_city, user_info.avatar, user_info.region, user_info.city AS user_city,
        
        user.email, user.role_id, user_contact.phone, user_contact.country, user_contact.city, user_info.birthdate, user_info.rating, user_info.contract_end_current_time,
        user_info.profile_status, user_info.age, user_info.about_me, 
        user_info.location, user_info.relevant_training, user_info.years_experience, user_info.languages, 
        role.name AS role_name,
        user_place_to_work.name AS user_place_to_work,
        
        user_info.id_id, user_info.id_exp, user_info.length,
        user_info.service_start, user_info.wage, user_info.travel_cost, user_info.contract_id, user_info.contract_start, user_info.contract_end, user_info.card_number, user_info.card_exp,
        user_info.drivers_license,
        user_contact.phone, user_contact.street, user_contact.street_number, user_contact.street_extra, user_contact.postal, user_contact.city, user_contact.country,
        user_clothing.shirt AS sizes_shirt, user_clothing.costume AS sizes_costume, user_clothing.pants AS sizes_pants, user_clothing.shoes AS sizes_shoes,
        
        user_info.hourly_rate, hourly_rate.rate AS user_hourly_rate, hourly_rate.title AS user_hourly_rate_title
        
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
        WHERE user.user_id = $id;";

        if ($res = sql::$con->query($query)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $contract = $this->contract($data['contract_id']);

                if (!$data['contract_end']) $contract_end = 'Vast';
                else $contract_end = date('Y-m-d', strtotime($data['contract_end']));

                $info = [
                    'id' => $data['user_id'],
                    'uid' => $data['user_uid'],
                    'profile_status' => $data['profile_status'],
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'role_id' => $data['role_id'],
                    'role' => $data['role_name'],//$data['role_title'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'street' => $data['street'],
                    'street_number' => $data['street_number'],
                    'street_extra' => $data['street_extra'],
                    'postal' => $data['postal'],
                    'city' => $data['user_city'],
                    'country' => $data['country'],
                    'region' => $data['region'],
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
                    'drivers_license' => $data['drivers_license'],
                    'user_hourly_rate' => $data['user_hourly_rate'],
                    'user_hourly_rate_title' => $data['user_hourly_rate_title'],
                    'avatar' => $data['avatar'],
                    'count_user_weekday_availability_hours' => $this->count_user_weekday_availability_hours($this->get_user_weekday_availability($id)),
                    'clothing' => [
                        'shirt' => $data['sizes_shirt'],
                        'costume' => $data['sizes_costume'],
                        'pants' => $data['sizes_pants'],
                        'shoes' => $data['sizes_shoes']
                    ],
                    'place_to_work' => $data['user_place_to_work'],
                    'hourly_rate' => $data['hourly_rate'],
                    'age' => $data['age'],
                    'location' => $data['location'],
                    'relevant_training' => $data['relevant_training'],
                    'years_experience' => $data['years_experience'],
                    'about_me' => htmlspecialchars_decode($data['about_me'], ENT_QUOTES|ENT_DISALLOWED),
                    'user_languages' => unserialize($data['languages']),
                ];

            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }

        }

        return $info;

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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

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
                $res->close();
                sql::$con->store_result();
            }

        }

        return $availability;

    }

    public function files($user_id)
    {

        $user_uid = $this->get_uid($user_id);

        $files = [];

        $path = APP . 'file/' . $user_uid . '/';
        if(file_exists($path)){
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
        }

        return $files;

    }

    public function contract($id)
    {

        $id = (int)$id;
        $contract = 'Unknown';

        $query = "SELECT name FROM contract WHERE contract_id = $id";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $contract = $data['name'];

            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }

        }

        return $contract;

    }

    public function user_email_exists($email)
    {

        $query = "SELECT user_uid FROM user WHERE email = '$email';";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            if ($res->num_rows) {
                if(is_object($res)){
                    $res->close();
                    sql::$con->store_result();
                }
                return true;
            }else{
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

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

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }

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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

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

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }

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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

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
                $res->close();
                sql::$con->store_result();
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $roles[] = [
                    'id' => $data['role_id'],
                    'name' => $data['name'],
                    'img_url' => '/image/role/'.$data['name']
                ];

            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

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
                $res->close();
                sql::$con->store_result();
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $wage = $data['wage'];
                $hours += time_difference($data['time_start'], $data['time_end']);

            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $users[] = [
                    'uid' => $data['user_uid'],
                    'name' => $data['firstname'] . ' ' . $data['lastname'],
                    'url' => '/users/' . $data['user_id']
                ];

            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $rewiews[] = $data;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
        }

        return $rewiews;
    }

    /**
     * Edit exists rewiew
     *
     * @param integer $rewiew_id
     * @param array $rewiew_details
     * @return bool
     */
    public function edit_user_reviews($rewiew_id, $rewiew_details)
    {
        $rewiew_id = intval($rewiew_id);

        $user_id = 0;

        $query = "UPDATE `user_review` SET `author`='".$rewiew_details['rewiew_author']."',
        `company_name`='".$rewiew_details['rewiew_company_name']."',`company_site`='".$rewiew_details['rewiew_company_site']."',
        `review`='".$rewiew_details['rewiew_text']."',`rating`='".$rewiew_details['rewiew_rating']."'
        WHERE `id`='$rewiew_id'";

        $result = sql::$con->query($query);

        $query = "SELECT `user_id` FROM `user_review` WHERE `id`='".$rewiew_id."' LIMIT 1";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $user_id = $data['user_id'];

            }
        }

        if($user_id != 0){

            $this->update_user_rating($user_id);

        }



        return (bool) $result;

    }

    /**
     * Add new rewiew
     *
     * @param array $rewiew_details
     * @return bool
     */
    public function add_new_reviews($rewiew_details)
    {

        $query = "INSERT INTO `user_review`(`user_id`, `author`, `company_name`, `company_site`, `review`, `rating`) 
        VALUES ('".$rewiew_details['user_id']."','".$rewiew_details['rewiew_author']."','".$rewiew_details['rewiew_company_name']."'
        ,'".$rewiew_details['rewiew_company_site']."','".$rewiew_details['rewiew_text']."','".$rewiew_details['rewiew_rating']."')";

        $result = sql::$con->query($query);

        $this->update_user_rating($rewiew_details['user_id']);

        return (bool) $result;

    }

    /**
     * Delete rewiew
     *
     * @param array $rewiew_details
     * @return bool
     */
    public function delete_user_rewiews($rewiew_id)
    {
        $rewiew_id = intval($rewiew_id);

        $query = "SELECT `user_id` FROM `user_review` WHERE `id`='".$rewiew_id."' LIMIT 1";

        $user_id = 0;

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {

                $user_id = $data['user_id'];

            }
        }

        if($user_id != 0){
            $query = "DELETE FROM `user_review` WHERE `id`='$rewiew_id'";
            $result = sql::$con->query($query);

            $this->update_user_rating($user_id);
        }

        return (bool) $result;
    }

    /**
     * Add user education certificates
     * This method set relation between files and users
     * @param integer $user_id
     * @param string $user_uid
     * @param string $certificate_type
     * @param string $file_name
     * @param string $title
     * @return void
     */
    public function add_user_education_certificats($user_id, $user_uid, $certificate_type, $file_name, $title){
        $user_id = intval($user_id);
        $query = "INSERT INTO `user_education_certificats`(`user_id`, `uid`, `type`, `file_name`, `title`) VALUES ('$user_id','".$user_uid."','$certificate_type','$file_name', '$title');";

        return (bool) sql::$con->query($query);
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $certificates[] = $data;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $skills[] = $data;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
        }

        return $skills;
    }

    /**
     * Get all hourly rate list
     *
     * @return array
     */
    public function get_hourly_rates(){

        $hourly_rate_list = [];

        $query = "SELECT `id`, `rate`, `title` FROM `hourly_rate`";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $hourly_rate_list[] = $data;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
        }

        return $hourly_rate_list;
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $user_weekday_availability = $data;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
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
     * Update user days of week and num of hours availability
     *
     * @param int $user_id
     * @param array $data
     * @return bool
     */
    public function update_user_weekday_availability($user_id, $data){
//print_r($data); exit;
        $user_id = intval($user_id);

        $availability_monday = ( $data['availability_monday']      != '' ? 1 : 0 );
        $availability_tuesday = ( $data['availability_tuesday']    != '' ? 1 : 0 );
        $availability_wednesday = ( $data['availability_wednesday']!= '' ? 1 : 0 );
        $availability_thursday = ( $data['availability_thursday']  != '' ? 1 : 0 );
        $availability_friday = ( $data['availability_friday']      != '' ? 1 : 0 );
        $availability_saturday = ( $data['availability_saturday']  != '' ? 1 : 0 );
        $availability_sunday = ( $data['availability_sunday']      != '' ? 1 : 0 );
        $availability_num_of_hours = $data['availability_num_of_hours'];

        if((isset($data['availability_list_id'])) and (!empty($data['availability_list_id'])) and ($user_id > 0)){
            $query = "UPDATE `user_weekday_availability` SET `monday`='$availability_monday',`tuesday`='$availability_tuesday',
            `wednesday`='$availability_wednesday',`thursday`='$availability_thursday',`friday`='$availability_friday',
            `saturday`='$availability_saturday',`sunday`='$availability_sunday',`hours`='$availability_num_of_hours' 
            WHERE `id`='".$data['availability_list_id']."'";
        }else{
            $query = "INSERT INTO `user_weekday_availability`(`user_id`, `monday`, `tuesday`, `wednesday`, `thursday`, 
            `friday`, `saturday`, `sunday`, `hours`) 
            VALUES ('$user_id','$availability_monday','$availability_tuesday','$availability_wednesday',
            '$availability_thursday','$availability_friday','$availability_saturday','$availability_sunday',
            '$availability_num_of_hours')";
        }
        return (bool) sql::$con->query($query);
    }

    /**
     * Count hours of user availability in week
     *
     * @param array $availability_array
     * @return int
     */
    public function count_user_weekday_availability_hours(array $availability_array){
        $total_hours = 0;
        $hours = 0;
        $days_count = 0;
        foreach ($availability_array as $key=>&$value) {
            if($key == 'hours'){
                // select hours value
                $hours = $value;
            }elseif($key != 'id'){
                //select availability days
                if($value != 0){
                    ++$days_count;
                }
            }
        }
        $total_hours = $hours * $days_count;


        return $total_hours;

    }

    /**
     * Add new work experience info
     *
     * @param int $user_id
     * @param array $data
     * @return bool
     */
    public function add_new_record_of_previous_work_experience($user_id, $data){

        $user_id = intval($user_id);

        $contract_end_current_time = 0;

        if((isset($data['contract_end_current_time'])) and ($data['contract_end_current_time'] == 'on')){
            $contract_end_current_time = 1;
        }

        $whitelist = array('jpeg', 'jpg', 'gif', 'png');
        $upload_dir = APP . 'file/previous-work-experience/' . $data['uid'] . '/company-logo/';
        if(in_array(pathinfo($_FILES['company_logo']['name'], PATHINFO_EXTENSION), $whitelist)){
            if($uploaded_file = upload_files($upload_dir, $_FILES['company_logo'])){
//print_r($uploaded_file);
//exit;
                //'contract_end_current_time'=>$_POST['contract_end_current_time'],
                $query = "
                UPDATE `previous_work_experience` SET `stop_to_work`='".date('Y-m-d', time())."',`contract_end_current_time`='0' 
                WHERE `user_id`='$user_id' AND `contract_end_current_time`='1';

                INSERT INTO `previous_work_experience`(`user_id`, `uid`, `logo_file_name`, `title`, `description`, `start_to_work`, `stop_to_work`, `contract_end_current_time`) 
                VALUES ('".$user_id."','".$data['uid']."','".str_replace($upload_dir, '', $uploaded_file)."','".$data['title']."',
                '".$data['description']."','".$data['start_to_work']."','".$data['stop_to_work']."','".$contract_end_current_time."')";

                //return (bool) sql::$con->query($query);

                $result = false;
                if ($res = sql::$con->multi_query($query) === true){

                    while (@sql::$con->next_result()) {}// FREE MULTI QUERY

                    $result = (bool) $res;

                    if(is_object($res)){
                        $res->close();
                        sql::$con->store_result();
                    }
                }

                return $result;

            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * Add new work experience info
     *
     * @param int $user_id
     * @param array $data
     * @return bool
     */
    public function update_record_of_previous_work_experience($user_id, $data){

        $user_id = intval($user_id);

        $contract_end_current_time = 0;

        if((isset($data['contract_end_current_time'])) and ($data['contract_end_current_time'] == 'on')){
            $contract_end_current_time = 1;
        }

        $whitelist = array('jpeg', 'jpg', 'gif', 'png');
        $upload_dir = APP . 'file/previous-work-experience/' . $data['uid'] . '/company-logo/';
        if( ($data['new_company_logo'] != '') and in_array(pathinfo($data['new_company_logo'], PATHINFO_EXTENSION), $whitelist) ){

            delete_files($data['old_company_logo']);
            $uploaded_file = upload_files($upload_dir, $_FILES['new_company_logo']);
            $rewrite_filename = "`logo_file_name`='".str_replace($upload_dir, '', $uploaded_file)."', ";
        }else{
            $rewrite_filename = "";
        }

        $query = "UPDATE `previous_work_experience` SET `stop_to_work`='".date('Y-m-d', time())."',`contract_end_current_time`='0' 
        WHERE `user_id`='$user_id' AND `contract_end_current_time`='1';
        
        UPDATE `previous_work_experience` 
        SET ".$rewrite_filename."`title`='".$data['title']."', `description`='".$data['description']."', 
        `start_to_work`='".$data['start_to_work']."', `stop_to_work`='".$data['stop_to_work']."', 
        `contract_end_current_time`='".$contract_end_current_time."' 
        WHERE `id`='".$data['record_id']."'";

        //return (bool) sql::$con->query($query);
        $result = false;
        if ($res = sql::$con->multi_query($query) === true){

            while (@sql::$con->next_result()) {}// FREE MULTI QUERY

            $result = (bool) $res;

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
        }

        return $result;

    }

    /**
     * Delete work experience record
     *
     * @param int $user_id
     * @param array $data
     * @return bool
     */
    public function delete_record_of_previous_work_experience($user_id, $data){

        $user_id = intval($user_id);

        $upload_dir = APP . 'file/previous-work-experience/' . $data['uid'] . '/company-logo/';
        delete_files($data['old_company_logo']);

        $query = "DELETE FROM `previous_work_experience` WHERE `id`='".$data['record_id']."' AND `uid`='".$data['uid']."'";

        return (bool) sql::$con->query($query);
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $previous_work_experience[] = $data;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
        }

        return $previous_work_experience;
    }

    /**
     * Upload & cropped user portfolio
     *
     * @param int $user_id
     * @param int $width
     * @param int $height
     * @return bool
     */
    public function upload_portfolio_item($user_id, $width=null, $height=null){

        if(!extension_loaded('gd')){
            return false;
        }else{
            $gd_info = gd_info();
            if(!$gd_info['PNG Support']){
                // if not supported PNG
                return false;
            }
            if(!$gd_info['JPEG Support']){
                // if not supported JPEG
                return false;
            }
            if((!$gd_info['GIF Read Support']) or (!$gd_info['GIF Create Support'])){
                // if not supported GIF
                return false;
            }
        }

        $size = array('width'=>460, 'height'=>316);// cropped to this size

        $user_id = intval($user_id);

        $whitelist = array('jpeg', 'jpg', 'gif', 'png');
        $upload_dir = APP . 'file/user-portfolio/' . $this->get_uid($user_id);

        $sql_add_croped_image = "";
        $upload_files_array = multi_upload_files($upload_dir,$_FILES['upload_portfolio_item'], $whitelist);

        $upload_files_count = count($_FILES['upload_portfolio_item']['name']);
        for($i=0; $i<$upload_files_count; $i++){
            $croped_potfolio_image = '';
            if(in_array(pathinfo($_FILES['upload_portfolio_item']['name'][$i], PATHINFO_EXTENSION), $whitelist)){
                $upload_file_info = pathinfo($upload_files_array[$i]);

                if( ($upload_file_info['extension'] == 'jpeg') or ($upload_file_info['extension'] == 'jpg') ){
                    $image = imagecreatefromjpeg($upload_files_array[$i]);
                    $new_image = imagecrop($image, ['x' => 0, 'y' => 0, 'width' => $size['width'], 'height' => $size['height']]);
                    if($new_image !== false){
                        $croped_potfolio_image = $upload_file_info['dirname'].'/cropped-'.$upload_file_info['basename'];
                        imagejpeg($new_image, $croped_potfolio_image);
                        imagedestroy($new_image);
                        $sql_add_croped_image .= "('".$user_id."','".$this->get_uid($user_id)."','".$upload_file_info['basename']."','cropped-".$upload_file_info['basename']."'), ";
                    }
                    imagedestroy($image);
                }
                if($upload_file_info['extension'] == 'gif'){

                    $croped_potfolio_image = $upload_file_info['dirname'].'/cropped-'.$upload_file_info['basename'];
                    $original_image = imagecreatefromgif($upload_files_array[$i]);
                    $original_image_info = getimagesize($upload_files_array[$i]);


                    if( ($original_image_info[0] < $size['width']) or ($original_image_info[1] < $size['height']) ){// if original image width or height < cropped size
                        $image = imagecreate($size['width'], $size['height']);
                        imagealphablending($image, true);
                        imagesavealpha($image, true);

                        $half_canvas_x = $size['width'] / 2;
                        $half_canvas_y = $size['height'] / 2;

                        $half_image_x = $original_image_info[0] / 2;// middle point of axis X for original image
                        $half_image_y = $original_image_info[1] / 2;// middle point of axis Y for original image

                        $start_point_new_image_x = $half_canvas_x - $half_image_x;// start point for axis X for paste image in center
                        $start_point_new_image_y = $half_canvas_y - $half_image_y;// start point for axis Y for paste image in center

                        imagecopy($image, $original_image, $start_point_new_image_x, $start_point_new_image_y,  0,0, $size['width'], $size['height']);

                        imagecolorallocatealpha($image, 0, 0, 0, 127);

                        imagecolortransparent($image, 0x000000);

                        imagegif($image,$croped_potfolio_image);// save resized

                        imagedestroy($image);
                        imagedestroy($original_image);
                        $sql_add_croped_image .= "('".$user_id."','".$this->get_uid($user_id)."','".$upload_file_info['basename']."','cropped-".$upload_file_info['basename']."'), ";
                    }else{
                        $image = imagecreate($size['width'], $size['height']);
                        imagealphablending($image, false);
                        imagesavealpha($image, true);
                        imagecopyresampled($image, $original_image, 0, 0, 0, 0, $size['width'], $size['height'], $original_image_info[0], $original_image_info[1]);// resize image
                        imagegif($image,$croped_potfolio_image);// save resized
                        imagedestroy($image);
                        imagedestroy($original_image);
                        $sql_add_croped_image .= "('".$user_id."','".$this->get_uid($user_id)."','".$upload_file_info['basename']."','cropped-".$upload_file_info['basename']."'), ";
                    }

                }
                if($upload_file_info['extension'] == 'png'){

                    $croped_potfolio_image = $upload_file_info['dirname'].'/cropped-'.$upload_file_info['basename'];
                    $original_image = imagecreatefrompng($upload_files_array[$i]);
                    $original_image_info = getimagesize($upload_files_array[$i]);


                    if( ($original_image_info[0] < $size['width']) or ($original_image_info[1] < $size['height']) ){// if original image width or height < cropped size
                        $image = imagecreatetruecolor($size['width'], $size['height']);
                        imagealphablending($image, false);
                        imagesavealpha($image, true);
                        imagecolortransparent($image, 0);

                        $half_canvas_x = $size['width'] / 2;
                        $half_canvas_y = $size['height'] / 2;

                        $half_image_x = $original_image_info[0] / 2;// middle point of axis X for original image
                        $half_image_y = $original_image_info[1] / 2;// middle point of axis Y for original image

                        $start_point_new_image_x = $half_canvas_x - $half_image_x;// start point for axis X for paste image in center
                        $start_point_new_image_y = $half_canvas_y - $half_image_y;// start point for axis Y for paste image in center

                        imagecopy($image, $original_image, $start_point_new_image_x, $start_point_new_image_y,  0,0, $size['width'], $size['height']);

                        $transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);// opacity transparent color
                        imagefill($image, 0, 0, $transparent);// remove black canvas color

                        imagepng($image,$croped_potfolio_image);// save resized

                        imagedestroy($image);
                        imagedestroy($original_image);
                        $sql_add_croped_image .= "('".$user_id."','".$this->get_uid($user_id)."','".$upload_file_info['basename']."','cropped-".$upload_file_info['basename']."'), ";
                    }else{
                        $image = imagecreatetruecolor($size['width'], $size['height']);
                        imagealphablending($image, false);
                        imagesavealpha($image, true);
                        imagecopyresampled($image, $original_image, 0, 0, 0, 0, $size['width'], $size['height'], $original_image_info[0], $original_image_info[1]);// resize image
                        imagepng($image,$croped_potfolio_image);// save resized
                        imagedestroy($image);
                        imagedestroy($original_image);
                        $sql_add_croped_image .= "('".$user_id."','".$this->get_uid($user_id)."','".$upload_file_info['basename']."','cropped-".$upload_file_info['basename']."'), ";
                    }

                }
            }
        }

        if(trim($sql_add_croped_image) != ""){
            $query = "INSERT INTO `user_portfolio`(`user_id`, `uid`, `full_size`, `crop_size`) 
            VALUES ".rtrim($sql_add_croped_image, ', ');

            return sql::$con->query($query);
        }else{
            return false;
        }
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

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $portfolio_items[] = $data;
            }
            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
        }

        return $portfolio_items;
    }

    /**
     * Get all user portfolio items
     *
     * @param string $filename
     * @param int $user_id
     * @param int $item_id
     * @return bool
     */
    public function delete_portfolio_item($filename, $user_id, $item_id){

        $item_id = intval($item_id);
        $uid = $this->get_uid($user_id);

        delete_files(APP.'/file/user-portfolio/'.$uid.'/'.$filename);// delete original image
        delete_files(APP.'/file/user-portfolio/'.$uid.'/cropped-'.$filename);// delete cropped image

        $query = "DELETE FROM `user_portfolio` WHERE `id`='$item_id' AND `uid`='$uid' AND `full_size`='$filename'";

        return sql::$con->query($query);
    }

    /**
     * Add user video
     *
     * @param int $user_id
     * @param string|file $video
     * @return bool
     */
    public function add_user_video($user_id, $video){

        $user_id = intval($user_id);
        $uid = $this->get_uid($user_id);

        $query = "SELECT `id`, `source`, `uid`, `filename_or_link` FROM `user_video` WHERE `uid`='$uid';";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                $file_path = APP.'/file/video/'.$uid.'/'.$data['filename_or_link'];
                delete_files($file_path);
                sql::$con->query("DELETE FROM `user_video` WHERE `id`='".$data['id']."';");
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }

        }

        if(is_array($video)){
            // it is upload video
            $source = 'local';

            $filename = upload_files(APP.'/file/video/'.$uid.'/', $video);
            if($filename){
                $filename = pathinfo($filename)['basename'];
            }
        }else{
            // it is link to video
            $source = parse_url($video)['host'];
            $filename = $video;
        }

        $query = "INSERT INTO `user_video`(`source`, `uid`, `filename_or_link`) VALUES ('".$source."','".$uid."','".$filename."')";

        return sql::$con->query($query);
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
        $server_url = ( (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == true) ? 'https://' : 'http://' ).$_SERVER['HTTP_HOST'];

        $query = "SELECT `id`, `source`, `uid`, `filename_or_link` FROM `user_video` WHERE `uid`='$uid';";

        $user_videos = [];

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                if($data['source'] == 'local'){
                    $file_path = '/file/video/'.$uid.'/'.$data['filename_or_link'];
                    $data['filename_or_link'] = $server_url.$file_path;
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

    /**
     * Get all user portfolio items
     *
     * @param int $video_id
     * @return bool
     */
    public function delete_user_video($video_id){

        $video_id = intval($video_id);

        $query = "SELECT * FROM user_video WHERE `id`='$video_id';";

        //DELETE FROM `user_video` WHERE `id`='$video_id'

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            while ($data = $res->fetch_array(MYSQLI_ASSOC)) {
                if($data['source'] == 'local'){
                    $file_path = APP.'file/video/'.$data['uid'].'/'.$data['filename_or_link'];
                    if(delete_files($file_path)){
                        sql::$con->query("DELETE FROM `user_video` WHERE `id`='$video_id'");
                    }
                }
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }

        }

    }

    /**
     * Update persenol user rationg
     *
     * @param int $user_id
     * @return bool
     */
    public function update_user_rating($user_id){
//echo('user reting UPD<br>');
        $user_id = intval($user_id);
        $user_personal_rating = 0;
        $result = false;

        $query = "SELECT `rating` FROM `user_review` WHERE `user_id`='".$user_id."'";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {

            $num_of_rewiews = 0;
            $total_rewiews_rating = 0;
//echo($res->num_rows);
            while ( ($data = $res->fetch_array(MYSQLI_ASSOC)) ) {
//print_r($data);
//echo($num_of_rewiews.'<br>');
                $total_rewiews_rating += intval($data['rating']);

                $num_of_rewiews++;
            }

            if(is_object($res)){
                $res->close();
                sql::$con->store_result();
            }
//var_dump($num_of_rewiews);echo('<br>');
            if($num_of_rewiews != 0){

                $user_personal_rating = $total_rewiews_rating / $num_of_rewiews;

                $query = "UPDATE `user_info` SET `rating`='".$user_personal_rating."' WHERE `user_id`='".$user_id."'";
                $result = sql::$con->query($query);
            }

        }
//var_dump($result);
//exit();
        return (bool) $result;

    }

    /**
     * Get all languages
     *
     * @return array
     */
    public function get_all_languages(){

        $result = array();

        $query = "SELECT `id`, `name` FROM `languages`";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {
            while ( ($data = $res->fetch_array(MYSQLI_ASSOC)) ) {
                $result[$data['id']] = $data['name'];
            }
        }

        return $result;
    }

    /**
     * Update user languages
     *
     * @param integer $user_id
     * @param array $languages
     * @return bool
     */
    /*
    public function update_user_languages($user_id, $languages){

        $result = array();

        $query = "INSERT INTO `user_languages`(`user`, `language_id`) VALUES ([value-1],[value-2],[value-3])";

        if ($res = sql::$con->query($query, MYSQLI_STORE_RESULT)) {
            while ( ($data = $res->fetch_array(MYSQLI_ASSOC)) ) {
                $result[$data['id']] = $data['name'];
            }
        }

        return $result;
    }
    */

}

$user = new User;

?>
