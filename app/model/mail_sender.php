<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class mail_sender {

    /**
     * @var string $admin_email
     */
    protected $admin_email = 'awesomejobs@causeffect.nl';

    protected $sender_email = 'robert@causeffect.nl';

    /**
     * @var string $eol End of line for email message
     */
    protected $eol = "\r\n";

    public function __construct(){
    }

    /**
     * Method for send message to e-mail
     *
     * @param array $recipient
     * @param string $sender
     * @param string $subject
     * @param string $message
     * @param string $attachment_name
     * @return bool
     */
    public function send($recipient, $sender, $subject, $message, $attachment_name=null){

        if($attachment_name != null){
            $path = $_FILES[$attachment_name[0]]['tmp_name'];
            $file_name = $_FILES[$attachment_name[0]]['name'];

            $path1 = $_FILES[$attachment_name[1]]['tmp_name'];
            $file_name1 = $_FILES[$attachment_name[1]]['name'];

            $boundary = "--".md5(uniqid(time()));// unique boundary

            $headers    = "MIME-Version: 1.0;".$this->eol;
            $headers   .= "Content-Type: multipart/mixed; boundary=\"$boundary\"".$this->eol;
            $headers   .= "From: ".$sender.$this->eol;
            $headers   .= 'Reply-To: '.$sender.$this->eol;

            $multipart  = "--$boundary".$this->eol;
            $multipart .= "Content-Type: text/html; charset=windows-1251".$this->eol;
            $multipart .= "Content-Transfer-Encoding: base64".$this->eol;
            $multipart .= $this->eol; // раздел между заголовками и телом html-части
            $multipart .= chunk_split(base64_encode(nl2br(htmlspecialchars($message, ENT_QUOTES|ENT_SUBSTITUTE))));

            if((file_exists($path)) or (file_exists($path1))){
                if($path) {
                    $fp = fopen($path, 'rb');
                    $attachment = fread($fp, filesize($path));
                    fclose($fp);
                    unlink($path);

                    $multipart .=  $this->eol."--$boundary".$this->eol;
                    $multipart .= "Content-Type: application/octet-stream; name=\"$file_name\"".$this->eol;
                    $multipart .= "Content-Transfer-Encoding: base64".$this->eol;
                    $multipart .= "Content-Disposition: attachment; filename=\"$file_name\"".$this->eol;
                    $multipart .= $this->eol; // раздел между заголовками и телом прикрепленного файла
                    $multipart .= chunk_split(base64_encode($attachment));
                }


                //$path1 = $_FILES[$attachment_name[1]]['tmp_name'];
                //$file_name1 = $_FILES[$attachment_name[1]]['name'];

                if($path1){
                    $fp1 = fopen($path1, 'rb');
                    $attachment1 = fread($fp1, filesize($path1));
                    fclose($fp1);
                    unlink($path1);

                    $multipart .= $this->eol . "--$boundary" . $this->eol;
                    $multipart .= "Content-Type: application/octet-stream; name=\"$file_name1\"" . $this->eol;
                    $multipart .= "Content-Transfer-Encoding: base64" . $this->eol;
                    $multipart .= "Content-Disposition: attachment; filename=\"$file_name1\"" . $this->eol;
                    $multipart .= $this->eol; // раздел между заголовками и телом прикрепленного файла
                    $multipart .= chunk_split(base64_encode($attachment1));
                }

                $multipart .= $this->eol."--$boundary--".$this->eol;

            }else{
                $headers   = 'From: '.$sender.$this->eol;
                $headers  .= 'Reply-To: '.$sender.$this->eol;
                $multipart = nl2br(htmlspecialchars($message, ENT_QUOTES|ENT_SUBSTITUTE));// message
            }



        }else{
            //$headers    = "MIME-Version: 1.0;".$this->eol;
            //$headers   .= "Content-Type: multipart/mixed;".$this->eol;
            //$headers   .= "From: ".$this->sender_email;
            $headers   = 'From: '.$this->sender_email.$this->eol;
            $headers  .= 'Reply-To: '.$this->sender_email.$this->eol;
            $multipart = nl2br(htmlspecialchars($message, ENT_QUOTES|ENT_SUBSTITUTE));// message
        }
/*
        echo('<pre>'.$recipient.'</pre><hr>');
        echo('<pre>'.$subject.'</pre><hr>');
        echo('<pre>'.$multipart.'</pre><hr>');
        echo('<pre>'.$headers.'</pre><hr>');
*/
//flush();
        //foreach ((array) $recipients as &$recipient) {
            //echo('<br>Send message to '.$recipient.' ');
            return mail($recipient, $subject, $multipart, $headers);
        //}

    }

    public function __destruct(){
        unset($this->admin_email, $this->sender_email, $this->eol);
    }
}