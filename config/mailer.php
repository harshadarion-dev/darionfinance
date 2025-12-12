<?php
// /config/mailer.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/../vendor/phpmailer/src/PHPMailer.php";
require_once __DIR__ . "/../vendor/phpmailer/src/SMTP.php";
require_once __DIR__ . "/../vendor/phpmailer/src/Exception.php";

class Mailer
{
    private $username;
    private $password;
    private $host;
    private $port;
    private $secure;

    public function __construct()
    {
        // === CONFIGURE YOUR SMTP CREDENTIALS HERE ===
        $this->username = "harsha.darion@gmail.com";        // CHANGE
        $this->password = "vardhangadiyamula@91";     // CHANGE (Gmail app password)
        $this->host     = "smtp.gmail.com";             // change for other providers
        $this->port     = 587;
        $this->secure   = "tls";                        // or 'ssl' + port 465
        // ============================================
    }

    // Backwards-compatible boolean sender
    public function sendMail(string $to, string $subject, string $body): bool
    {
        $res = $this->sendMailWithResult($to, $subject, $body);
        return $res['ok'];
    }

    // New method that returns detailed result
    public function sendMailWithResult(string $to, string $subject, string $body): array
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $this->host;
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->username;
            $mail->Password   = $this->password;
            $mail->SMTPSecure = $this->secure;
            $mail->Port       = $this->port;
            $mail->setFrom($this->username, "Darion Finance");
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return ['ok' => true, 'error' => ''];

        } catch (Exception $e) {
            $err = $mail->ErrorInfo ?: $e->getMessage();
            $this->logError($err);
            return ['ok' => false, 'error' => $err];
        }
    }

    private function logError(string $err)
    {
        $logDir = __DIR__ . "/../logs";
        if (!is_dir($logDir)) mkdir($logDir, 0777, true);
        $file = $logDir . "/mail_error.log";
        $msg = date("Y-m-d H:i:s") . " - " . $err . PHP_EOL;
        file_put_contents($file, $msg, FILE_APPEND);
    }
}
