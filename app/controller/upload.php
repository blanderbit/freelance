<?php

if ($user->is_signed_in()) {

$user_uid = $_POST['user_uid'];

  if (isset($_FILES) && strlen($user_uid) > 0) {

    $megabyte = 1048576;
    $target_dir = APP . 'file/' . $user_uid . '/';
    $success = true;

    if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

    $extension = pathinfo(basename($_FILES['file']['name']), PATHINFO_EXTENSION);

    $target_file = $target_dir . str_replace(' ', '-', $_FILES['file']['name']);

    /*if (getimagesize($_FILES['file']['tmp_name']) !== false) $success = true;
    else $success = false;*/

    if ($_FILES['file']['size'] > 20 * $megabyte) $success = false;

    //if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg' && $extension != 'gif' && $extension != 'pdf' && $extension != 'ai') $success = false;

    if ($success) move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

  }

}

?>
