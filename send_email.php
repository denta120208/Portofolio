<?php
// Sertakan file PHPMailer
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';
require __DIR__ . '/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Buat objek PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Pengaturan server SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'belajarit73@gmail.com'; // Ganti dengan email Gmail Anda
        $mail->Password = 'kleopasr3n.'; // Ganti dengan password Gmail Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Penerima email
        $mail->setFrom($email, $name); // Email pengirim dari form
        $mail->addAddress('ardentapradan@gmail.com'); // Alamat tujuan

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = "New Message: " . $subject;
        $mail->Body    = "You have received a new message.<br><br>" .
                         "Name: $name<br>" .
                         "Email: $email<br>" .
                         "Mobile: $mobile<br><br>" .
                         "Message:<br>$message";

        // Kirim email
        $mail->send();
        echo 'Message has been sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
