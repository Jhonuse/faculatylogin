<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: mark_attendance.php');
    exit;
}

$teacher = current_teacher();

$class   = trim($_POST['class']   ?? '');
$subject = trim($_POST['subject'] ?? '');
$time    = trim($_POST['time']    ?? '');
$code    = trim($_POST['code']    ?? '');
$present = array_values(array_unique($_POST['present'] ?? []));
$absent  = array_values(array_unique($_POST['absent']  ?? []));

if ($class === '' || $subject === '' || $time === '' || $code === '') {
    header('Location: mark_attendance.php');
    exit;
}

// A roll number can't be both present and absent — present wins, matching the
// mutually-exclusive checkboxes in the UI.
$absent = array_values(array_diff($absent, $present));

$stmt = $pdo->prepare('SELECT COUNT(*) FROM students WHERE class_name = ?');
$stmt->execute([$class]);
$totalStudents = (int) $stmt->fetchColumn();

$pdo->beginTransaction();
try {
    $stmt = $pdo->prepare(
        'INSERT INTO attendance_sessions (teacher_id, class_name, subject, session_time, attendance_code, session_date, total_students)
         VALUES (?, ?, ?, ?, ?, CURDATE(), ?)'
    );
    $stmt->execute([$teacher['id'], $class, $subject, $time, $code, $totalStudents]);
    $sessionId = (int) $pdo->lastInsertId();

    $stmt = $pdo->prepare('INSERT INTO attendance_marks (session_id, roll_no, status) VALUES (?, ?, ?)');
    foreach ($present as $roll) {
        $stmt->execute([$sessionId, $roll, 'present']);
    }
    foreach ($absent as $roll) {
        $stmt->execute([$sessionId, $roll, 'absent']);
    }

    $pdo->commit();
} catch (Throwable $e) {
    $pdo->rollBack();
    http_response_code(500);
    die('Failed to save attendance: ' . h($e->getMessage()));
}

$qs = http_build_query([
    'saved'   => 1,
    'code'    => $code,
    'present' => count($present),
    'total'   => $totalStudents,
]);
header('Location: mark_attendance.php?' . $qs);
exit;
