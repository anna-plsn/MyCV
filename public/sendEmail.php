<?php
use PHPMailer\PHPMailer\PHPMailer;
include "../config/config.php";

if (isset($_POST['name']) && isset($_POST['email']) &&isset($_POST['message'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();
    $mail->SMTPDebug = 1;
    $mail -> isSMTP();
    $mail -> Host = "smtp.gmail.com";
    $mail -> SMTPAuth = true;
    $mail -> Username = 'anneta.plaksina.2001@gmail.com';
    $mail -> Password = $config['password'];
    $mail -> SMTPSecure = 'ssl';

    $mail -> isHTML(true);
    $mail -> setFrom($email,$name);
    $mail -> addAddress("anneta.plaksina.2001@gmail.com");
    $mail -> Subject = ("$email");
    $mail->Body = ("$message");

    if ($mail->send()){
        $status ="success";
        $response = "Email is sent!";
    }
    else{
        $status = "failed";
        $response = "wrong".$mail->ErrorInfo;
    }
    exit(json_encode(array('status' => $status, "response" => $response)));
}
?>
