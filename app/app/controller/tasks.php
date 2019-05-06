<?php

$page_title = 'Taken';

if ($user->is_signed_in()) {

  include(MODEL . 'task.php');

  $task_list = $task->list_all();

  include(VIEW . 'tasks.php');

} else {

  header('Location: /sign-in');

}

?>
