<?php
if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(500);
    exit();
}

// Sanitize input
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Your email address
$to = "HRAnalytics.ca@gmail.com";

// Subject of the email
$subject = "$m_subject:  $name";

// Email body
$body = "You have received a new message from your website contact form.\n\n";
$body .= "Here are the details:\n\n";
$body .= "Name: $name\n\n";
$body .= "Email: $email\n\n";
$body .= "Subject: $m_subject\n\n";
$body .= "Message:\n$message\n";

// Email headers
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// Send email and check for success
if (mail($to, $subject, $body, $headers)) {
    http_response_code(200);
    echo "Message sent successfully!";
} else {
    http_response_code(500);
    echo "Oops! Something went wrong, and we couldn't send your message.";
}
?>
