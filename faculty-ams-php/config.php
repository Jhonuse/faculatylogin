<?php
/**
 * config.php
 * Central database connection settings for the Faculty AMS portal.
 * Edit the four constants below to match your MySQL server.
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'faculty_ams');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // Do not leak connection details in production; shown here for setup convenience.
    die('Database connection failed: ' . $e->getMessage());
}
