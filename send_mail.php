<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes from Composer's autoload
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $full_name = htmlspecialchars($_POST['full_name']);
    $sender_email = htmlspecialchars($_POST['email']);
    $phoneno = htmlspecialchars($_POST['phoneno']);
    $subject= htmlspecialchars($_POST['Subject']);
    $message = htmlspecialchars($_POST['message']);

    // Your email address to receive form data
    $to_email = "krushna.khairnar11work@gmail.com";  // The email where you want to receive submissions

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'krushna.khairnar11work@gmail.com'; // Your email (sender's email)
        $mail->Password = 'wvif rdrf kjas jltl'; // Your email password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom($sender_email, $full_name);  // Set sender's email and name
        $mail->addAddress($to_email); // Your email to receive the form data
        $mail->addReplyTo($sender_email, $full_name); // Reply-To sender's email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Contact Form Submission from $full_name";
        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><b>Name:</b> $full_name</p>
            <p><b>Email:</b> $sender_email</p>
            <p><b>PhoneNo:</b> $phoneno</p>
            <p><b>Subject:</b> $subject</p>
            <p><b>Message:</b></p>
            <p>$message</p>
        ";
        $mail->AltBody = "Name: $full_name\nEmail: $sender_email\nMessage:\n$message";

        // Send email
        $mail->send();
        echo "<script>alert('Thank you for your message! I will respond shortly.');</script>";
        echo "<script>window.location.href = 'index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Failed to send your message. Mailer Error: {$mail->ErrorInfo}');</script>";
        echo "<script>window.location.href = 'index.html';</script>";
    }
}
?>
