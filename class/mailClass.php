<?php

class mailClass extends MysqliDb
{

    protected $db;

    public function __construct($db)
    {
        $this->dbConn = $db;
    }


    public function posaljiMail($email,$imePosiljaoca,$naslovmaila,$message)
    {

        require_once DCROOT.'/PHPMailer-master/PHPMailerAutoload.php';

        if (!$email) {
            echo 'Nema email od posiljaoca.';
            die;
        }

        $imePosiljaoca = (!$imePosiljaoca) ? 'Ime Pošiljaoca' : $imePosiljaoca;

        require('../obradi/postavkaZaSlanjeMaila.php');
        $mail->addAddress($email, $imePosiljaoca);     // Add a recipient
        //$mail->addReplyTo($email, $korpaime.' '.$korpaprezime);
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('itclusterserbia@gmail.com');
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        $mail->Subject = $naslovmaila;
        $mail->Body = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            $sajt['testsajt'] = 'Nije poslat mail';
            $sajt['error'] = false;

        } else {
            $sajt['testsajt'] = 'Poslat mail';
            $sajt['error'] = true;
        }
        return $sajt;

    }



}