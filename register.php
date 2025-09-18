<?php
require 'db.php';
require 'vendor/autoload.php'; // PHPMailer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic validation
    if (empty($name) || empty($email) || empty($password)) {
        $message = "<p style='color:red;'>All fields are required.</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<p style='color:red;'>Invalid email format.</p>";
    } else {
        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "<p style='color:red;'>Email already registered.</p>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(16));

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, status, verification_token) VALUES (?, ?, ?, 'Not Verified', ?)");
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $token);

            if ($stmt->execute()) {
                // Build verification link
                $verificationLink = "http://localhost/project1/verify.php?token=" . $token;

                // Send verification email via Mailtrap
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host       = 'sandbox.smtp.mailtrap.io'; // Mailtrap sandbox
                    $mail->SMTPAuth   = true;
                    $mail->Username   = '9e49b7a66a23ab';    // Replace with Mailtrap username
                    $mail->Password   = '4326e3600afbd3';    // Replace with Mailtrap password
                    $mail->Port       = 2525;                        // Sandbox port
                    $mail->SMTPSecure = 'tls';

                    $mail->setFrom('noreply@project.com', 'CRUD Project');
                    $mail->addAddress($email, $name);

                    $mail->isHTML(true);
                    $mail->Subject = 'Verify your email';
                    $mail->Body    = "Hi $name,<br><br>
                        Please verify your email by clicking this link:<br>
                        <a href='$verificationLink'>Verify Email</a>";

                    $mail->send();
                    $message = "<p style='color:green;'>Registered successfully! Check Mailtrap inbox for verification link.</p>";
                } catch (Exception $e) {
                    $message = "<p style='color:red;'>Email could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
                }
            } else {
                $message = "<p style='color:red;'>Error: " . $stmt->error . "</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>Register User</h1>
    <a href="index.php">Home</a> | <a href="read.php">View Users</a>
    <br><br>

    <?php if (!empty($message)) echo $message; ?>

    <form method="POST">
        <label>
            Name:<br>
            <input type="text" name="name" required>
        </label>
        <br><br>

        <label>
            Email:<br>
            <input type="email" name="email" required>
        </label>
        <br><br>

        <label>
            Password:<br>
            <input type="password" name="password" required>
        </label>
        <br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
