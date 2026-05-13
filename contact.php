<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = htmlspecialchars(trim($_POST["full_name"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $phone = htmlspecialchars(trim($_POST["phone"] ?? ""));
    $subject = htmlspecialchars(trim($_POST["subject"] ?? ""));
    $message = htmlspecialchars(trim($_POST["message"] ?? ""));

    if (empty($fullName) || empty($email) || empty($subject) || empty($message)) {
        echo "<script>
            alert('Please fill all required fields.');
            window.history.back();
        </script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('Please enter a valid email address.');
            window.history.back();
        </script>";
        exit;
    }

    $to = "reservation@goldenpointhotel.com";
    $emailSubject = "New Website Contact: " . $subject;

    $emailBody = "
New message from Golden Point Hotel website:

Full Name: $fullName
Email: $email
Phone: $phone
Subject: $subject

Message:
$message
";

    $headers = "From: Golden Point Website <no-reply@goldenpointhotel.com>\r\n";
    $headers .= "Reply-To: $fullName <$email>\r\n";

    if (mail($to, $emailSubject, $emailBody, $headers)) {
        echo "<script>
            alert('Thank you for contacting Golden Point Hotel and Suites. We will get back to you shortly.');
            window.location.href = 'contact.html';
        </script>";
    } else {
        echo "<script>
            alert('Sorry, your message could not be sent. Please try again later.');
            window.history.back();
        </script>";
    }
} else {
    header("Location: contact.html");
    exit;
}
?>
