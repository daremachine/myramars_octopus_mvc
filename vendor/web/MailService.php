<?php declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    private $mail = null;

    public function __construct()
    {
        $mail = new PHPMailer(true);
        if(WebSettings::$MAIL_DEBUGMODE) {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  // Enable verbose debug output
        }
        
        $mail->isSMTP();                                            // Send using SMTP
        $mail->CharSet = 'UTF-8';                                   // charset to CZE
        $mail->Host       = WebSettings::$MAIL_HOST;                // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = WebSettings::$MAIL_USERNAME;            // SMTP username
        $mail->Password   = WebSettings::$MAIL_PASSWORD;            // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = WebSettings::$MAIL_PORT;                // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $this->mail = $mail;
    }

    public function sendContactMail($form): bool
    {
        try {
            //Recipients
            $this->mail->setFrom(WebSettings::$MAIL_FROM, 'Web');
            $this->mail->addAddress(WebSettings::$MAIL_FROM);     // Add a recipient
            // $mail->addCC('cc@example.com');

            // Content
            $this->mail->isHTML(true);                            // Set email format to HTML
            $this->mail->Subject = "{$form->name} {$form->phone} - Má dotaz";
            $this->mail->Body    = "Kdo: {$form->name} {$form->phone}<br><br>{$form->note}";

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}