<?php

require __DIR__ . "/database.php";

header('Content-Type: application/json; charset=utf-8');

// the form is posted by fetch, so anything else is a mistake rather than a visitor
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(['ok' => false, 'message' => 'Method not allowed.']);
    exit;
}

$fields = ['first_name', 'last_name', 'email', 'subject', 'message'];

$input = [];
foreach ($fields as $field) {
    $input[$field] = trim($_POST[$field] ?? '');
}

$errors = [];

// the lengths match the columns, mysql rejects anything longer rather than trimming it

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

if ($errors) {
    http_response_code(422);
    echo json_encode([
        'ok' => false,
        'errors' => $errors,
        'message' => reset($errors),
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
        // the two optional columns are nullable, so store null rather than ''
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

echo json_encode(['ok' => true, 'message' => 'Message sent!']);
