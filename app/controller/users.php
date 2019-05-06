<?php

if ($user->is_signed_in()) {

    require_once(__DIR__.'/../../app/model/geo_location.php');

    $page_title = 'Werknemers';

    $scripts = [];
    $styles = [];

    if (path(2)) {

        $this_user['id'] = path(2);

        if (isset($_POST['user_uid'])) {
            $form_data = [
                'profile_status' => $_POST['profile_status'],
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'birthdate' => $_POST['birthdate'],
                'age' => $_POST['age'],
                'location' => $_POST['location'],
                'years_experience' => $_POST['years_experience'],
                'relevant_training' => $_POST['relevant_training'],
                'role_id' => $_POST['role'],
                'drivers_license' => $_POST['drivers_license'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'phone' => $_POST['phone'],
                'street' => $_POST['street'],
                'street_number' => $_POST['street_number'],
                'street_extra' => $_POST['street_extra'],
                'postal' => $_POST['postal'],
                'region' => $_POST['region'],
                'city' => $_POST['city'],
                'country' => $_POST['country'],
                'nationality' => $_POST['nationality'],
                'birth_city' => $_POST['birth_city'],
                'birth_country' => $_POST['birth_country'],
                'id_id' => $_POST['identification'],
                'id_exp' => $_POST['id_exp'],
                'csn' => $_POST['csn'],
                'length' => $_POST['length'],
                'service_start' => $_POST['service_start'],
                'wage' => $_POST['wage'],
                'travel_cost' => $_POST['travel_cost'],
                'contract_start' => $_POST['contract_start'],
                'contract_end' => $_POST['contract_end'],
                'card_number' => $_POST['card_number'],
                'card_exp' => $_POST['card_exp'],
                'sizes_shirt' => $_POST['sizes_shirt'],
                'sizes_pants' => $_POST['sizes_pants'],
                'sizes_costume' => $_POST['sizes_costume'],
                'sizes_shoes' => $_POST['sizes_shoes'],
                'place_to_work' => $_POST['place_to_work'],
                'skills' => $_POST['skills'],
                'hourly_rate' => $_POST['hourly_rate'],
                'user_avatar' => $_FILES['user_avatar'],
                'old_user_avatar' => $_POST['old_user_avatar'],
                'about_me' => $_POST['about_me'],
                'user_languages' => $_POST['languages'],
            ];

            if ($user->update($this_user['id'], $form_data)) header("Refresh:0");

        }

        /*********************************** REWIEWS BEGIN*/
        if (isset($_POST['edit_rewiew'])) {
            $form_data = [
                'rewiew_author' => $_POST['rewiew_author'],
                'rewiew_company_name' => $_POST['rewiew_company_name'],
                'rewiew_company_site' => $_POST['rewiew_company_site'],
                'rewiew_rating' => $_POST['rewiew_rating'],
                'rewiew_text' => $_POST['rewiew_text'],
            ];

            $user->edit_user_reviews($_POST['rewiew_id'], $form_data);
        }

        if (isset($_POST['delete_rewiew'])) {
            if(isset($_POST['rewiew_id'])){
                $user->delete_user_rewiews($_POST['rewiew_id']);
            }
        }

        if (isset($_POST['new_rewiew'])) {
            $form_data = [
                'user_id' => $_POST['user_id'],
                'rewiew_author' => $_POST['rewiew_author'],
                'rewiew_company_name' => $_POST['rewiew_company_name'],
                'rewiew_company_site' => $_POST['rewiew_company_site'],
                'rewiew_rating' => $_POST['rewiew_rating'],
                'rewiew_text' => $_POST['rewiew_text'],
            ];

            $user->add_new_reviews($form_data);
        }
        /************************************* REWIEWS END*/

        /****************************** AVAILABILITY BEGIN*/
        if (isset($_POST['change_availability'])) {
            $form_data = [
                'availability_monday' => $_POST['availability_monday'],
                'availability_tuesday' => $_POST['availability_tuesday'],
                'availability_wednesday' => $_POST['availability_wednesday'],
                'availability_thursday' => $_POST['availability_thursday'],
                'availability_friday' => $_POST['availability_friday'],
                'availability_saturday' => $_POST['availability_saturday'],
                'availability_sunday' => $_POST['availability_sunday'],
                'availability_list_id' => $_POST['availability_list_id'],
                'availability_num_of_hours' => $_POST['availability_num_of_hours'],
            ];

            $user->update_user_weekday_availability($this_user['id'], $form_data);
        }
        /******************************** AVAILABILITY END*/

        /****************** PREVIOUS WORK EXPIRIENCE BEGIN*/
        if (isset($_POST['new_record_of_previous_work_experience'])) {
            $form_data = [
                'uid' => $_POST['uid'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'start_to_work' => $_POST['start_to_work'],
                'stop_to_work' => $_POST['stop_to_work'],
                'contract_end_current_time' => $_POST['contract_end_current_time']
            ];

            $user->add_new_record_of_previous_work_experience($this_user['id'], $form_data);
        }

        if (isset($_POST['update_record_of_previous_work_experience'])) {
            $form_data = [
                'old_company_logo' => $_POST['old_company_logo'],
                'new_company_logo' => $_FILES['new_company_logo']['name'],
                'record_id' => $_POST['record_id'],
                'uid' => $_POST['uid'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'start_to_work' => $_POST['start_to_work'],
                'stop_to_work' => $_POST['stop_to_work'],
                'contract_end_current_time' => $_POST['contract_end_current_time']
            ];

            $user->update_record_of_previous_work_experience($this_user['id'], $form_data);
        }

        if (isset($_POST['delete_record_of_previous_work_experience'])) {
            $form_data = [
                'old_company_logo' => $_POST['old_company_logo'],
                'record_id' => $_POST['record_id'],
                'uid' => $_POST['uid']
            ];

            $user->delete_record_of_previous_work_experience($this_user['id'], $form_data);
        }
        /******************** PREVIOUS WORK EXPIRIENCE END*/

        /********************************* PORTFOLIO BEGIN*/
        if(isset($_POST['upload_portfolio_items'])){

            $user->upload_portfolio_item($this_user['id']);

        }

        if(isset($_POST['delete_portfolio_item'])){

            $user->delete_portfolio_item($_POST['filename'], $_POST['user_id'], $_POST['delete_portfolio_item']);

        }
        /*********************************** PORTFOLIO END*/

        /************************************* VIDEO BEGIN*/
        if(isset($_POST['add_user_video'])){

            if($_FILES['upload_user_video']['name'] != ''){
                $video = $_FILES['upload_user_video'];
            }else{
                $video = $_POST['link_to_video'];
            }

            $user->add_user_video($this_user['id'], $video);

        }

        if(isset($_POST['delete_user_video'])){

            $user->delete_user_video($_POST['delete_user_video']);

        }
        /*************************************** VIDEO END*/
//
        $this_user = $user->info($this_user['id']);

        $shifts_upcoming = $user->shifts($this_user['id'], 'UPCOMING');
        $shifts_completed = $user->shifts($this_user['id'], 'COMPLETED');
        $shifts_late = $user->shifts_late($this_user['id']);
        $hourly_rates = $user->get_hourly_rates();

        $this_user['user_rewiews'] = $user->get_user_reviews($this_user['id']);
        $this_user['user_education_certificats'] = $user->get_user_education_certificats($this_user['id']);
        $this_user['places_to_work'] = $user->places_to_work();
        $this_user['tasks'] = $user->tasks($this_user['id']);
        $this_user['paychecks'] = $user->paychecks($this_user['id']);
        $this_user['files'] = $user->files($this_user['id']);
        $this_user['availability'] = $user->availability($this_user['id']);
        $this_user['user_weekday_availability'] = $user->get_user_weekday_availability($this_user['id']);
        $this_user['skills'] = $user->skills($this_user['id']);
        $this_user['previous_work_experience'] = $user->get_previous_work_experience($this_user['id']);
        $this_user['portfolio'] = $user->get_portfolio_item($this_user['id']);
        $this_user['videos'] = $user->get_user_video($this_user['id']);
        $this_user['regions'] = $geo_location->get_region(139);
        $this_user['cities'] = $geo_location->get_city(139);
        $this_user['languages_list'] = $user->get_all_languages();//$geo_location->get_city(139);

        include(VIEW . 'user/profile.php');

        unset($form_data, $this_user, $shifts_upcoming, $shifts_completed, $shifts_late, $hourly_rates);

    } else {

        include(VIEW . 'users.php');

    }

} else {

    header('Location: /sign-in');

}

?>
