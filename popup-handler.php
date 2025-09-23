<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

hh_session_start();

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
    exit;
}

$redirectTarget = $_POST['redirect'] ?? '/';
if (!is_string($redirectTarget) || $redirectTarget === '') {
    $redirectTarget = '/';
}
if ($redirectTarget[0] !== '/') {
    $redirectTarget = '/';
}

$name    = trim((string)($_POST['name'] ?? ''));
$email   = trim((string)($_POST['email'] ?? ''));
$country = trim((string)($_POST['country'] ?? ''));
$phone   = trim((string)($_POST['phone'] ?? ''));
$token   = (string)($_POST['g-recaptcha-response'] ?? '');

$_SESSION['popup_form_old'] = [
    'name'    => $name,
    'email'   => $email,
    'country' => $country,
    'phone'   => $phone,
];

$redirectWithError = static function (string $message) use ($redirectTarget): void {
    $_SESSION['popup_form_error'] = $message;
    header('Location: ' . $redirectTarget);
    exit;
};

if ($name === '' || $email === '' || $country === '' || $phone === '') {
    $redirectWithError('Please complete all required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $redirectWithError('Please enter a valid email address.');
}

if ($token === '') {
    $redirectWithError('Please confirm you are not a robot.');
}

$secretKey = hh_recaptcha_secret_key();
if ($secretKey === '' || $secretKey === 'your-secret-key-here') {
    error_log('Popup form: reCAPTCHA secret key is not configured.');
    $redirectWithError('Captcha verification is temporarily unavailable. Please try again later.');
}

$recaptchaVerified = false;
$postData = http_build_query([
    'secret'   => $secretKey,
    'response' => $token,
    'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
]);

$context = stream_context_create([
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => $postData,
        'timeout' => 10,
    ],
]);

$response = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);

if ($response === false && function_exists('curl_init')) {
    $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
    if ($ch !== false) {
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $postData,
            CURLOPT_TIMEOUT        => 10,
        ]);
        $curlResponse = curl_exec($ch);
        if ($curlResponse !== false) {
            $response = $curlResponse;
        }
        curl_close($ch);
    }
}

if ($response !== false) {
    $decodedResponse = json_decode((string)$response, true);
    $recaptchaVerified = is_array($decodedResponse) && ($decodedResponse['success'] ?? false) === true;
}

if (!$recaptchaVerified) {
    $redirectWithError('Captcha verification failed. Please try again.');
}

try {
    $pdo = hh_db();
    $stmt = $pdo->prepare(
        'INSERT INTO popup_form (name, email, phone, country, ip_address, user_agent, created_at)
         VALUES (:name, :email, :phone, :country, :ip_address, :user_agent, NOW())'
    );
    $stmt->execute([
        ':name'       => $name,
        ':email'      => $email,
        ':phone'      => $phone,
        ':country'    => $country,
        ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
    ]);
} catch (Throwable $exception) {
    error_log('Popup form: database error - ' . $exception->getMessage());
    $redirectWithError('We were unable to submit your request. Please try again later.');
}

unset($_SESSION['popup_form_old'], $_SESSION['popup_form_error']);

header('Location: thankyou.php');
exit;
