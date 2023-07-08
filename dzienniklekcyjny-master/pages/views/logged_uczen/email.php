<?php
require '../../../vendor/autoload.php'; // Załaduj bibliotekę PHPMailer

require '../../../vendor/PHPMailer-master/src/PHPMailer.php';
require '../../../vendor/PHPMailer-master/src/Exception.php';
require '../../../vendor/PHPMailer-master/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Pobierz adres e-mail odbiorcy z bazy danych na podstawie jego ID
$recipientEmail = '';

if (isset($_POST['submit'])) {
    $recipient = $_POST['recipient'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (!empty($recipient) && !empty($subject) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sapuserfree@gmail.com'; // Podaj swoją nazwę użytkownika Gmail
            $mail->Password = 'dbjrqrxxmawfshzk'; // Podaj swoje hasło do konta Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('sapuserfree@gmail.com'); // Podaj swój adres e-mail
            $mail->addAddress($recipient);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            echo "<p>E-mail został wysłany.</p>";
        } catch (Exception $e) {
            echo "<p>Wysłanie e-maila nie powiodło się. Błąd: {$mail->ErrorInfo}</p>";
        }
    } else {
        echo "<p>Proszę wypełnić wszystkie pola formularza.</p>";
    }
}
?>

<!-- Formularz wysyłania e-maila -->
<form method="POST" action="">
    <div class="card-body">
        <div class="form-group">
            <label for="recipient">Odbiorca:</label>
            <input type="email" class="form-control" id="recipient" name="recipient" value="<?php echo $recipientEmail; ?>" required>
        </div>
        <div class="form-group">
            <label for="subject">Temat:</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="form-group">
            <label for="message">Wiadomość:</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Wyślij e-mail</button>
    </div>
</form>