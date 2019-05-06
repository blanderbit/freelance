<?php

class Export {

  public function array2csv($rows, $titles = 0) {

     if (count($rows) == 0) {

       return null;

     }

     ob_start();

     $df = fopen('php://output', 'w');

     if (is_array($titles)) fputcsv($df, $titles, ';', ' ');

     foreach ($rows as $row) {

        fputcsv($df, $row, ';', ' ');

     }

     fclose($df);

     return ob_get_clean();

  }

  public function download_send_headers($filename) {

    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");

  }

}

$export = new Export;

?>
