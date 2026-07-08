<?php
/**
 * includes/auth.php
 * Session bootstrap + login guard. Replaces the JS `currentUser` variable
 * and localStorage-based "session" with a real PHP session.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/** Redirect to the login page if nobody is logged in. Call at the top of every protected page. */
function require_login(): void
{
    if (empty($_SESSION['teacher_id'])) {
        header('Location: faculty-login.php');
        exit;
    }
}

/** Returns the logged-in teacher's data from the session as an array. */
function current_teacher(): array
{
    return [
        'id'         => $_SESSION['teacher_id'] ?? null,
        'name'       => $_SESSION['teacher_name'] ?? null,
        'department' => $_SESSION['teacher_department'] ?? null,
    ];
}
