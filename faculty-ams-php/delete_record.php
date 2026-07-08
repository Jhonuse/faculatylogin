<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';
require_login();

$teacher = current_teacher();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);
    // Ownership check baked into the WHERE clause — a teacher can only delete their own records.
    $stmt = $pdo->prepare('DELETE FROM attendance_sessions WHERE id = ? AND teacher_id = ?');
    $stmt->execute([$id, $teacher['id']]);
}

header('Location: history.php');
exit;
