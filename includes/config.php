<?php
declare(strict_types=1);

if (!defined('HH_CONFIG_INITIALIZED')) {
    define('HH_CONFIG_INITIALIZED', true);

    // ---- DB (live defaults; env vars still supported) ----
    define('HH_DB_HOST', getenv('DB_HOST') ?: 'localhost');
    define('HH_DB_PORT', getenv('DB_PORT') ?: '3306');
    define('HH_DB_NAME', getenv('DB_NAME') ?: 'u431421769_monitor_hunt');
    define('HH_DB_USER', getenv('DB_USER') ?: 'root');
    define('HH_DB_PASS', getenv('DB_PASS') ?: '');

    // ---- reCAPTCHA (unchanged) ----
    define('HH_RECAPTCHA_SITE_KEY', getenv('RECAPTCHA_SITE_KEY') ?: '6LfsT9IrAAAAALx6HawW63nF2e1c9nLRJwXNDxTM');
    define('HH_RECAPTCHA_SECRET_KEY', getenv('RECAPTCHA_SECRET_KEY') ?: '6LfsT9IrAAAAAHdqpDxlj9-1rnq-p1e3vIE3Cohn');
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
            // Keep native prepares OFF for LIMIT/OFFSET binding issues:
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

if (!function_exists('hh_slugify')) {
    function hh_slugify(?string $value): string
    {
        if (!is_string($value)) {
            return '';
        }

        $value = trim(html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8'));

        if ($value === '') {
            return '';
        }

        $value = preg_replace('/[^\p{L}\p{N}]+/u', '-', $value);
        if ($value === null) {
            $value = '';
        }

        $value = preg_replace('/-+/u', '-', $value);
        if ($value === null) {
            $value = '';
        }

        $value = trim($value, '-');

        return strtolower($value);
    }
}

if (!function_exists('hh_property_slug_from_data')) {
    function hh_property_slug_from_data(array $property): string
    {
        $candidates = [
            $property['project_name'] ?? null,
            $property['property_name'] ?? null,
            $property['property_title'] ?? null,
            $property['title'] ?? null,
        ];

        foreach ($candidates as $candidate) {
            $slug = hh_slugify(is_string($candidate) ? $candidate : null);
            if ($slug !== '') {
                return $slug;
            }
        }

        if (isset($property['id']) && is_numeric($property['id'])) {
            return 'property-' . (int)$property['id'];
        }

        return 'property';
    }
}
