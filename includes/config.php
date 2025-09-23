<?php
declare(strict_types=1);

if (!defined('HH_CONFIG_INITIALIZED')) {
    define('HH_CONFIG_INITIALIZED', true);

    define('HH_DB_HOST', getenv('DB_HOST') ?: 'localhost');
    define('HH_DB_PORT', getenv('DB_PORT') ?: '3306');
    define('HH_DB_NAME', getenv('DB_NAME') ?: 'hmonitor_portal');
    define('HH_DB_USER', getenv('DB_USER') ?: 'root');
    define('HH_DB_PASS', getenv('DB_PASS') ?: '');

    define('HH_RECAPTCHA_SITE_KEY', getenv('RECAPTCHA_SITE_KEY') ?: '6Lerl80rAAAAAJBNH6-EKog7afnQ-xMbXmByr-X9');
    define('HH_RECAPTCHA_SECRET_KEY', getenv('RECAPTCHA_SECRET_KEY') ?: '6Lerl80rAAAAAKtfsJsnElOx2KydWRzrqf2Y3u76');
}

if (!function_exists('hh_db')) {
    function hh_db(): PDO
    {
        static $pdo;

        if ($pdo instanceof PDO) {
            return $pdo;
        }

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            HH_DB_HOST,
            HH_DB_PORT,
            HH_DB_NAME
        );

        $pdo = new PDO($dsn, HH_DB_USER, HH_DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        return $pdo;
    }
}

if (!function_exists('hh_recaptcha_site_key')) {
    function hh_recaptcha_site_key(): string
    {
        return HH_RECAPTCHA_SITE_KEY;
    }
}

if (!function_exists('hh_recaptcha_secret_key')) {
    function hh_recaptcha_secret_key(): string
    {
        return HH_RECAPTCHA_SECRET_KEY;
    }
}

if (!function_exists('hh_session_start')) {
    function hh_session_start(): void
    {
        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            session_start();
        }
    }
}
