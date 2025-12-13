<?php
// sendMessage.php

// Replace with your email address
$to = "biswasasit14@gmail.com";

// Collect form data safely
$name    = htmlspecialchars(trim($_POST["name"] ?? ""));
$email   = htmlspecialchars(trim($_POST["email"] ?? ""));
$subject = htmlspecialchars(trim($_POST["subject"] ?? ""));
$message = htmlspecialchars(trim($_POST["message"] ?? ""));

// Basic validation
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    die("Please fill in all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Build the email
$email_subject = "Contact Form: " . $subject;
$email_body    = "You have received a new message from the contact form.\n\n" .
                 "Name: $name\n" .
                 "Email: $email\n" .
                 "Subject: $subject\n\n" .
                 "Message:\n$message\n";

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// Send the email
if (mail($to, $email_subject, $email_body, $headers)) {
    echo "success";
} else {
    echo "fail";
}
?>
