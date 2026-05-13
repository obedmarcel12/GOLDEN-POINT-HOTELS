<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = htmlspecialchars(trim($_POST["full_name"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $phone = htmlspecialchars(trim($_POST["phone"] ?? ""));
    $roomId = htmlspecialchars(trim($_POST["room_id"] ?? ""));
    $roomName = htmlspecialchars(trim($_POST["room_name"] ?? ""));
    $roomPrice = htmlspecialchars(trim($_POST["room_price"] ?? ""));
    $checkin = htmlspecialchars(trim($_POST["checkin"] ?? ""));
    $checkout = htmlspecialchars(trim($_POST["checkout"] ?? ""));
    $guests = htmlspecialchars(trim($_POST["guests"] ?? ""));
    $nights = htmlspecialchars(trim($_POST["nights"] ?? ""));
    $totalPrice = htmlspecialchars(trim($_POST["total_price"] ?? ""));
    $specialRequest = htmlspecialchars(trim($_POST["special_request"] ?? ""));

    if (
        empty($fullName) ||
        empty($email) ||
        empty($phone) ||
        empty($roomName) ||
        empty($checkin) ||
        empty($checkout) ||
        empty($guests)
    ) {
        echo "<script>
            alert('Please fill all required booking fields.');
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
    $emailSubject = "New Room Booking Request - Golden Point Hotel";

    $emailBody = "
New booking request from Golden Point Hotel website:

Guest Information
Full Name: $fullName
Email: $email
Phone: $phone

Booking Details
Room ID: $roomId
Room Name: $roomName
Room Price: ₦$roomPrice per night
Check-in: $checkin
Check-out: $checkout
Guests: $guests
Nights: $nights
Total Price: ₦$totalPrice

Special Request:
$specialRequest
";

    $headers = "From: Golden Point Website <no-reply@goldenpointhotel.com>\r\n";
    $headers .= "Reply-To: $fullName <$email>\r\n";

    if (mail($to, $emailSubject, $emailBody, $headers)) {
        echo "<script>
            alert('Thank you. Your booking request has been sent successfully. Golden Point Hotel and Suites will contact you shortly.');
            window.location.href = 'booking.html';
        </script>";
    } else {
        echo "<script>
            alert('Sorry, your booking could not be sent. Please try again or contact us directly.');
            window.history.back();
        </script>";
    }
} else {
    header("Location: booking.html");
    exit;
}
?>
