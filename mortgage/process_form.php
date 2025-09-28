<?php
// process_form.php

// --- turn OFF onscreen errors in prod; log instead ---
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', '/tmp/hh_mortgage_form.log');

function fail($msg, $code = 400) {
    http_response_code($code);
    error_log("[mortgage_leads] $msg");
    exit($msg);
}

// 1) Load DB constants
$cfg = __DIR__ . '/../includes/config.php';
if (!file_exists($cfg)) {
    // try sibling includes/ if mortgage is at domain root
    $alt = __DIR__ . '/includes/config.php';
    if (file_exists($alt)) $cfg = $alt;
}
if (!file_exists($cfg)) {
    fail('Config file not found (includes/config.php).', 500);
}
require_once $cfg;

// 2) Only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('Invalid request method.', 405);
}

// 3) Get fields
$name     = trim($_POST['name']     ?? '');
$email    = trim($_POST['email']    ?? '');
$phone    = trim($_POST['phone']    ?? '');
$phone2   = trim($_POST['phone2']   ?? '');  // <-- new optional field
$location = trim($_POST['location'] ?? '');
$token    = $_POST['g-recaptcha-response'] ?? '';

if ($name === '' || $email === '' || $phone === '' || $location === '') {
    fail('All fields are required (name, email, phone, location).', 422);
}
if ($token === '') {
    fail('Please verify the reCAPTCHA.', 400);
}

// 4) Verify reCAPTCHA (v2 checkbox)
$RECAPTCHA_SECRET = '6LfsT9IrAAAAAHdqpDxlj9-1rnq-p1e3vIE3Cohn';
$verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
$postData = http_build_query([
    'secret'   => $RECAPTCHA_SECRET,
    'response' => $token,
    'remoteip' => $_SERVER['REMOTE_ADDR'] ?? null,
]);

$captchaOk = false;
try {
    if (function_exists('curl_init')) {
        $ch = curl_init($verifyUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $postData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
        ]);
        $resp = curl_exec($ch);
        if ($resp === false) {
            error_log('cURL error: '. curl_error($ch));
        }
        curl_close($ch);
    } else {
        // fallback
        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => $postData,
                'timeout' => 15,
            ]
        ]);
        $resp = @file_get_contents($verifyUrl, false, $context);
    }

    $captcha = json_decode($resp ?? '', true);
    if (!empty($captcha['success'])) $captchaOk = true;

} catch (Throwable $e) {
    error_log('reCAPTCHA verify exception: '.$e->getMessage());
}

if (!$captchaOk) {
    fail('reCAPTCHA failed. Please try again.', 400);
}

// 5) Insert into DB (with phone2 support)
try {
    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        HH_DB_HOST, HH_DB_PORT, HH_DB_NAME
    );
    $pdo = new PDO($dsn, HH_DB_USER, HH_DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Detect if 'phone2' column exists
    $hasPhone2 = false;
    try {
        $colStmt = $pdo->query("SHOW COLUMNS FROM mortgage_leads LIKE 'phone2'");
        $hasPhone2 = (bool) $colStmt->fetch();
    } catch (Throwable $e) {
        error_log("Column check error: ".$e->getMessage());
    }

    if ($hasPhone2) {
        // Insert into phone2 column if present
        $sql = 'INSERT INTO mortgage_leads (name, email, phone, phone2, location)
                VALUES (:name, :email, :phone, :phone2, :location)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':phone'    => $phone,
            ':phone2'   => $phone2,
            ':location' => $location,
        ]);
    } else {
        // Fallback: store both numbers combined in 'phone'
        $combinedPhone = $phone2 !== '' ? ($phone . ' / ' . $phone2) : $phone;
        $sql = 'INSERT INTO mortgage_leads (name, email, phone, location)
                VALUES (:name, :email, :phone, :location)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':phone'    => $combinedPhone,
            ':location' => $location,
        ]);
    }

} catch (Throwable $e) {
    error_log('DB exception: '.$e->getMessage());
    fail('Database error.', 500);
}

// 6) Redirect to thank you page (form resets after redirect)
header('Location: thankyou.php');
exit;
