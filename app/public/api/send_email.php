<?php
include('../../app.php');
require_once(MODEL.'/config.php');
require_once(MODEL.'/functions.php');
require_once(MODEL.'/mail_sender.php');

enable_cors();
/*
$frontSent = file_get_contents('php://input');
$decodedFormData = json_decode($frontSent, true);
*/
/*
 * $decodedFormData
 * */
$result = null;
$mail_sender = new mail_sender();
$admin_email = 'awesomejobs@causeffect.nl';

/**
 * Mail send for footer
 * https://new.causeffect.nl/
 */
if(isset($_POST['footer_form'])){
    /*
     * FIELDS
     * user_email
     * user_name
     *
     * FLAGS
     * footer_form
     *
     * */


    /*
     * Subject & message for user e-mail message
     * */
    $user_email = $_POST['user_email'];
    $sender_for_user = $admin_email;
    $user_subject = 'causeffect';
    $user_message = 'Hoi'.$_POST['user_name'].' — Bedankt voor je aanmelding bij Causeffect On-demand . Wij versturen je contactverzoek naar onze community manager en wij zullen ervoor zorgen dat hij  zo snel mogelijk contact met je opneemt.';

    /*
     * Subject & message for admin e-mail message
     * */
    $admin_email = $admin_email;
    $sender_for_admin = $_POST['user_email'];
    $admin_subject = 'Meld je aan voor een gratis consult! ';
    $admin_message = 'Bedrijfsnaam: '.$_POST['user_name']."\r\n".' E-mailadres:'.$_POST['user_email'];

    $file_field_name = null;

    if($mail_sender->send($user_email, $sender_for_user, $user_subject, $user_message, $file_field_name)){
        if($mail_sender->send($admin_email, $sender_for_admin, $admin_subject, $admin_message, $file_field_name)){
            $result = 'ok';
        }else{
            $result = 'error';
        }
    }else{
        $result = 'error';
    }
}

/**
 * Mail send for form in specialist page
 * https://new.causeffect.nl/orderSpecialist/116
 */
if(isset($_POST['profile_form'])){

    /*
     * FIELDS
     * user_email
     * user_name
     * specialist_name
     *
     * FLAGS
     * profile_form
     *
     * */

    /*
     * Subject & message for user e-mail message
     * */
    $user_email = $_POST['email'];
    $sender_for_user = $admin_email;
    $user_subject = 'causeffect';
    $user_message = 'Hoi '.$_POST['contact'].' — Bedankt voor je boeking bij Causeffect On Demand. Wij versturen je boekingsverzoek momenteel naar '.$_POST['contact'].' en wij zullen ervoor zorgen dat alles zo snel mogelijk geregeld wordt.
    '."\r\n".'
    Wij nemen binnen 24 uur contact met je op. Mocht je toch nog vragen hebben kan je gerust contact met ons opnemen.
    '."\r\n".'
    085 13 03 493'."\r\n".'
    awesomejobs@causeffect.nl
    ';

    /*
     * Subject & message for admin e-mail message
     * */
    $admin_email = $admin_email;
    $sender_for_admin = $_POST['email'];
    $admin_subject = 'Bevestig specialist';
    $admin_message = 'Company name: '.$_POST['company_name'].
        'Bedrijfsnaam: '.$_POST['company_name']."\r\n".
        'Contactpersoon: '.$_POST['contact']."\r\n".
        'E-mailadres: '.$_POST['email']."\r\n".
        'Telefoonnummer: '.$_POST['phone_number']."\r\n".
        'Adres + huisnummer: '.$_POST['address_and_house_number']."\r\n".
        'Postcode + plaats: '.$_POST['city_and_postcode']."\r\n".
        'KVK nummer: '.$_POST['kvk_number']."\r\n";

    $file_field_name = null;

    if($mail_sender->send($user_email, $sender_for_user, $user_subject, $user_message, $file_field_name)){
        if($mail_sender->send($admin_email, $sender_for_admin, $admin_subject, $admin_message, $file_field_name)){
            $result = 'ok';
        }else{
            $result = 'error';
        }
    }else{
        $result = 'error';
    }
}

/**
 * Mail send for form in register as specialist
 * https://new.causeffect.nl/specialist
 */
if(isset($_POST['register_as_specialist'])){

    /*
     * FIELDS
     * user_email
     * user_name
     * specialist_name
     *
     * FLAGS
     * profile_form
     *
     * */


    /*
     * Subject & message for user e-mail message
     * */
    $user_email = $_POST['email'];
    $sender_for_user = $admin_email;
    $user_subject = 'causeffect';
    $user_message = 'Hoi '.$_POST['name_and_surname'].' — Bedankt voor je aanmelding bij Causeffect On-demand . Wij versturen je contactverzoek naar onze community manager en wij zullen ervoor zorgen dat hij zo snel mogelijk contact met je opneemt.
    ';

    /*
     * Subject & message for admin e-mail message
     * */
    $admin_email = $admin_email;
    $sender_for_admin = $_POST['email'];
    $admin_subject = 'Meld je aan als specialist!';
    $admin_message = 'Voor- en achternaam: '.$_POST['name_and_surname']."\r\n".
        'E-mailadres: '.$_POST['email']."\r\n".
        'Telefoonnummer: '.$_POST['phone_number']."\r\n".
        'Website: '.$_POST['web_site']."\r\n";

    $file_field_name = array('user_cv', 'user_portfolio');

    if($mail_sender->send($user_email, $sender_for_user, $user_subject, $user_message, $file_field_name)){
        if($mail_sender->send($admin_email, $sender_for_admin, $admin_subject, $admin_message, $file_field_name)){
            $result = 'ok';
        }else{
            $result = 'error';
        }
    }else{
        $result = 'error';
    }
}

/**
 * Mail send for form in contact page
 * https://new.causeffect.nl/contact
 */
if(isset($_POST['contact_page'])){

    /*
     * FIELDS
     * user_email
     * user_name
     * specialist_name
     *
     * FLAGS
     * contact_page
     *
     * */


    /*
     * Subject & message for user e-mail message
     * */
    $user_email = $_POST['user_email'];
    $sender_for_user = $admin_email;
    $user_subject = 'causeffect';
    $user_message = 'Hoi '.$_POST['user_name'].' — Bedankt voor je aanmelding bij Causeffect On-demand . Wij versturen je contactverzoek naar onze community manager en wij zullen ervoor zorgen dat hij zo snel mogelijk contact met je opneemt.';

    /*
     * Subject & message for admin e-mail message
     * */
    $admin_email = $admin_email;
    $sender_for_admin = $_POST['user_email'];
    $admin_subject = 'Neem contact met ons op!';
    $admin_message = 'Voor- en achternaam: '.$_POST['name_and_surname']."\r\n".
        'E-mailadres: '.$_POST['email']."\r\n".
        'Telefoonnummer: '.$_POST['phone_number']."\r\n".
        'Uw vraag: '.$_POST['question']."\r\n";

    $file_field_name = null;

    if($mail_sender->send($user_email, $sender_for_user, $user_subject, $user_message, $file_field_name)){
        if($mail_sender->send($admin_email, $sender_for_admin, $admin_subject, $admin_message, $file_field_name)){
            $result = 'ok';
        }else{
            $result = 'error';
        }
    }else{
        $result = 'error';
    }
}


header('Content-type: application/json');
echo json_encode($result);