<?php

class File {

  public function delete($file) {

    $file = APP . 'file/' . $file;

    if (file_exists($file)) {

      unlink($file);
      return true;

    }

  }

}

$file = new File;

?>
