<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 13/04/2018
 * Time: 18:07
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

session_start();

if(isset($_GET["email"]) && isset($_GET["hash"]))
{
    $email = $_GET["email"];
    $hash = $_GET["hash"];
} else
{
    echo "no email or hash sent";
}

$recovery_url = "https://zeno.computing.dundee.ac.uk/2017-projects/seacadet/password_recovery.php?email=".$email."&hash=".$hash;
$msg = "Please access the following link to recover your password \n" . $recovery_url;
$headers = 'From: javisuki96@hotmail.com';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp-mail.outlook.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'seacadets_password_recovery@hotmail.com';                 // SMTP username
    $mail->Password = 'seacadets1q2w3e4r';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('seacadets_password_recovery@hotmail.com', 'Mailer');
    //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress($email);               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Password Recovery';
    $mail->Body    = 'Please access the following link to recover your password<br>'. $recovery_url . '<br>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    $_SESSION['msg'] = "Email successfully sent";

    $redirect_uri = "/scweb/login.php";
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

    //echo 'Message has been sent';
} catch (Exception $e) {
    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

    $_SESSION['msg'] = "ERROR! Email was not sent";

    $redirect_uri = "/scweb/login.php";
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();

}