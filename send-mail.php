<?php

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
    exit;
}

$name = htmlspecialchars($_POST['name'] ?? 'Newsletter Subscriber');
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$message = htmlspecialchars($_POST['message'] ?? 'New newsletter signup');

if (!$email) {
    echo json_encode(["success" => false, "message" => "Invalid email"]);
    exit;
}

$to = "hello@badijtech.com.ng";
$subject = "New Manaja Submission";

$body = "
Name: $name\n
Email: $email\n
Message:\n$message
";

$headers = "From: Manaja <noreply@manaja.com>\r\n";
$headers .= "Reply-To: $email\r\n";

if (mail($to, $subject, $body, $headers)) {
    echo json_encode(["success" => true, "message" => "Message sent successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to send message"]);
}
