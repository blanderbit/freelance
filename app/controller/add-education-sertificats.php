<?php

if ($user->is_signed_in()) {

    /**
     * Uppload diplomas & certifications
     *
     * @return void
     */
    function upload_education_sertificats(){

        global $user;

        $whitelist = array('jpeg', 'jpg', 'gif', 'png', 'pdf');
        $upload_dir = APP . 'education-certificats/'.$_POST['education-certificats-type'].'/' . $_POST['user_uid'] . '/';
        $uploaded_files = multi_upload_files($upload_dir, $_FILES['education-certificats'], $whitelist);
        foreach ($uploaded_files as $file) {
            if($file){
                $user->add_user_education_certificats($_POST['user_id'], $_POST['user_uid'], $_POST['education-certificats-type'], pathinfo($file, PATHINFO_BASENAME), $_POST['education-certificate-title']);// create record in database
            }
        }

        if(isset($_SERVER['HTTP_REFERER'])){
            $redirect_to = $_SERVER['HTTP_REFERER'];
        }else{
            if(isset($_POST['user_id'])){
                $redirect_to = '/users/'.$_POST['user_id'];
            }else{
                $redirect_to = '/';
            }
        }
        header('Location: '.$redirect_to);
    }

    upload_education_sertificats();

}

?>
