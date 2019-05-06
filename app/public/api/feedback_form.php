<?php
require_once('../../app.php');
//header("Access-Control-Allow-Origin: *");
//require_once(__DIR__.'/../../app/model/config.php');
//require_once(__DIR__.'/../../app/model/functions.php');
require_once(MODEL.'/mail_sender.php');

enable_cors();

//$formData = json_encode($_REQUEST);
//$decodedFormData = json_decode($formData, true);
//$decodedFormData = json_decode($_REQUEST, true);
$frontSent = file_get_contents('php://input');
$decodedFormData = json_decode($frontSent, true);

$name = sql::$con->real_escape_string($decodedFormData['name']);
$email = sql::$con->real_escape_string($decodedFormData['email']);
$phone = sql::$con->real_escape_string($decodedFormData['phone']);
$question = sql::$con->real_escape_string($decodedFormData['question']);

$query = "INSERT INTO feedback_form (name, email, phone, question) VALUES ('$name', '$email', '$phone', '$question')";
sql::$con->query($query);
/*
if(sql::$con->query($query)){
    $result = 'ok';
}else{
    $result = 'error';
}
*/



$result = null;
$mail_sender = new mail_sender();
$admin_email = 'awesomejobs@causeffect.nl';

/*
 * Subject & message for user e-mail message
 * */
$user_email = $_POST['email'];
$sender_for_user = $admin_email;
$user_subject = 'causeffect';
$user_message = 'Hoi '.$_POST['name_and_surname'].' — Bedankt voor je aanmelding bij Causeffect On-demand . Wij versturen je contactverzoek naar onze community manager en wij zullen ervoor zorgen dat hij zo snel mogelijk contact met je opneemt.';

/*
 * Subject & message for admin e-mail message
 * */
$admin_email = $admin_email;
$sender_for_admin = $_POST['email'];
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

header('Content-type: application/json');
echo json_encode($result);
