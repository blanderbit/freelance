<?php

if ($user->is_signed_in()) {

    $page_title = 'Place to work';

    $scripts = [];//'calendar.js'
    $styles = [];

    if((isset($_POST['place-to-work'])) and (!empty($_POST['place-to-work']))){
        //
    }

    //include(VIEW . 'calendar.php');

} else {

    header('Location: /sign-in');

}

?>
