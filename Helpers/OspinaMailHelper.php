<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Load composer autoloader
require 'vendor/autoload.php';

class OspinaMailHelper
{
    private string $fromEmail;
    private string $fromName;
    private string $toEmail;
    private string $subject;
    private $body;
    private PHPMailer $phpMailer;

    /**
     * @param String $toEmail
     * @param String $subject
     * @param $body
     * @param String $fromEmail
     * @param String $fromName
     * @throws Exception
     */
    public function __construct(string $toEmail, string $subject, $body, string $fromEmail = 'servicios@unibague.edu.co', string $fromName = 'Centro de servicios')
    {

        $this->phpMailer = new PHPMailer(); //Generate instance
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
        $this->toEmail = $toEmail;
        $this->subject = $subject;
        $this->body = $body;

        $this->ConfigMailSettings(); //Config auth and mail settings
        $this->configRecipients(); //Config recipients
        $this->setMailBody();
        $this->phpMailer->send();
        echo 'Message has been sent';


    }

    private function ConfigMailSettings(): void
    {
        //Server settings
        $this->phpMailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->phpMailer->isSMTP();                                            //Send using SMTP
        $this->phpMailer->Host = 'smtp.pepipost.com';                     //Set the SMTP server to send through
        $this->phpMailer->SMTPAuth = true;                                   //Enable SMTP authentication
        $this->phpMailer->Username = 'unibagueg3';                     //SMTP username
        $this->phpMailer->Password = '1PepiUnibagueSmtp**';                               //SMTP password
        $this->phpMailer->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    }

    /**
     * @throws Exception
     */
    private function configRecipients(): void
    {
        //Recipients
        $this->phpMailer->setFrom($this->fromEmail, $this->fromName);
        $this->phpMailer->addAddress($this->toEmail);               //Name is optional
    }

    /**
     * @throws Exception
     */
    private function setMailBody()
    {
        //Content
        $this->phpMailer->isHTML(true);                                  //Set email format to HTML
        $this->phpMailer->CharSet = 'UTF-8';
        $this->phpMailer->Subject = $this->subject;
        $this->phpMailer->Body = $this->body;
        $this->phpMailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

    }

}