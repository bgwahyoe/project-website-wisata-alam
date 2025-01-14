<?php
// Pastikan hanya permintaan POST yang diproses
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form dan sanitasi
    $to = "wahyuyassin@gmail.com";
    $from = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars(strip_tags($_REQUEST['name']));
    $subject = htmlspecialchars(strip_tags($_REQUEST['subject']));
    $cmessage = htmlspecialchars(strip_tags($_REQUEST['message']));

    // Validasi input
    if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    if (empty($name) || empty($subject) || empty($cmessage)) {
        die("All fields are required");
    }

    // Header email
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Subjek email
    $email_subject = "You have a message from your Bitmap Photography";

    // Konten email
    $body = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Express Mail</title>
    </head>
    <body>
        <table style='width: 100%;'>
            <thead style='text-align: center;'>
                <tr>
                    <td style='border:none;' colspan='2'>
                        <a href='#'><img src='img/logo.png' alt='Logo'></a><br><br>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style='border:none;'><strong>Name:</strong> {$name}</td>
                    <td style='border:none;'><strong>Email:</strong> {$from}</td>
                </tr>
                <tr>
                    <td style='border:none;'><strong>Subject:</strong> {$subject}</td>
                </tr>
                <tr>
                    <td colspan='2' style='border:none;'>{$cmessage}</td>
                </tr>
            </tbody>
        </table>
    </body>
    </html>";

    // Kirim email
    if (mail($to, $email_subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
} else {
    // Jika bukan metode POST, tampilkan pesan error
    echo "Invalid request method.";
}
?>
