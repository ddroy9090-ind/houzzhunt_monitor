<?php
declare(strict_types=1);

if (!defined('HH_CONFIG_INITIALIZED')) {
    define('HH_CONFIG_INITIALIZED', true);

    define('HH_DB_HOST', getenv('DB_HOST') ?: 'localhost');
    define('HH_DB_PORT', getenv('DB_PORT') ?: '3306');
    define('HH_DB_NAME', getenv('DB_NAME') ?: 'hmonitor_portal');
    define('HH_DB_USER', getenv('DB_USER') ?: 'root');
    define('HH_DB_PASS', getenv('DB_PASS') ?: '');

    define('HH_RECAPTCHA_SITE_KEY', getenv('RECAPTCHA_SITE_KEY') ?: 'your-site-key-here');
    define('HH_RECAPTCHA_SECRET_KEY', getenv('RECAPTCHA_SECRET_KEY') ?: 'your-secret-key-here');
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
