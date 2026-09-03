<?php

use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . "/database.php";

header('Content-Type: application/json; charset=utf-8');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(['ok' => false, 'message' => 'Method not allowed.']);
    exit;
}

$fields = ['first_name', 'last_name', 'email', 'subject', 'message'];

$input = [];
foreach ($fields as $field) {
    $value = (string) ($_POST[$field] ?? '');

    // drop anything that isnt utf-8
    if (!mb_check_encoding($value, 'UTF-8')) {
        $value = '';
    }

    // strip control characters
    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value);

    $input[$field] = trim($value);
}

// normalise line endings
$input['message'] = preg_replace('/\R/u', "\n", $input['message']);

// collaps multiple whitespace to one space
foreach (['first_name', 'last_name', 'email', 'subject'] as $field) {
    $input[$field] = preg_replace('/\s+/u', ' ', $input[$field]);
}

$errors = [];

// reject anything longer than the length of the column

if ($input['first_name'] === '') {
    $errors['first_name'] = 'Please enter your first name.';
} elseif (mb_strlen($input['first_name']) > 100) {
    $errors['first_name'] = 'Your first name must be 100 characters or fewer.';
}

if ($input['last_name'] === '') {
    $errors['last_name'] = 'Please enter your last name.';
} elseif (mb_strlen($input['last_name']) > 100) {
    $errors['last_name'] = 'Your last name must be 100 characters or fewer.';
}

if ($input['email'] === '') {
    $errors['email'] = 'Please enter your email address.';
} elseif (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
} elseif (mb_strlen($input['email']) > 254) {
    $errors['email'] = 'Your email address must be 254 characters or fewer.';
}

if (mb_strlen($input['subject']) > 150) {
    $errors['subject'] = 'Your subject must be 150 characters or fewer.';
}

if (mb_strlen($input['message']) > 5000) {
    $errors['message'] = 'Your message must be 5000 characters or fewer.';
}

if ($errors) {
    http_response_code(422);
    echo json_encode([
        'ok' => false,
        'errors' => $errors,
        // every problem at once rather than just the first one
        'message' => implode("\n", $errors),
    ]);
    exit;
}

try {
    $sql = "INSERT INTO contact_submissions (first_name, last_name, email, subject, message)
            VALUES (:first_name, :last_name, :email, :subject, :message)";

    $pdo->prepare($sql)->execute([
        'first_name' => $input['first_name'],
        'last_name'  => $input['last_name'],
        'email'      => $input['email'],
        // store null rather than ''
        'subject'    => $input['subject'] !== '' ? $input['subject'] : null,
        'message'    => $input['message'] !== '' ? $input['message'] : null,
    ]);
} catch (PDOException $e) {
    error_log('Contact insert failed: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'ok' => false,
        'message' => $debug ? $e->getMessage() : 'Sorry, something went wrong. Please try again.',
    ]);
    exit;
}

$submissionId = $pdo->lastInsertId();

try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = $_ENV['SMTP_HOST'];
    $mail->Port       = (int) $_ENV['SMTP_PORT'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['SMTP_USER'];
    $mail->Password   = $_ENV['SMTP_PASS'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Timeout    = 10; // timeout so it doesnt hang
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom($_ENV['SMTP_FROM'], 'Portfolio Contact Form');
    $mail->addAddress($_ENV['SMTP_TO']);

    // reply should actually reply to the sender, maybe
    $mail->addReplyTo($input['email'], $input['first_name'] . ' ' . $input['last_name']);

    $subject = $input['subject'] !== '' ? $input['subject'] : '(no subject)';

    $mail->Subject = 'Portfolio contact form: ' . $subject;
    $mail->Body    = "New submission (#{$submissionId})\n\n"
                   . "Name:    {$input['first_name']} {$input['last_name']}\n"
                   . "Email:   {$input['email']}\n"
                   . "Subject: {$subject}\n\n"
                   . "Message:\n"
                   . ($input['message'] !== '' ? $input['message'] : '(none)') . "\n";

    $mail->send();
} catch (\Throwable $e) {
    error_log('Contact email failed: ' . $e->getMessage());
}

echo json_encode(['ok' => true, 'message' => 'Message sent!']);
