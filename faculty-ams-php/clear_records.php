<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';
require_login();

$teacher = current_teacher();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ON DELETE CASCADE on attendance_marks takes care of the per-student rows.
    $stmt = $pdo->prepare('DELETE FROM attendance_sessions WHERE teacher_id = ?');
    $stmt->execute([$teacher['id']]);
}

header('Location: history.php');
exit;
