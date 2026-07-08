<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';
require_login();

$teacher = current_teacher();

$fDate    = $_GET['date']    ?? '';
$fClass   = $_GET['class']   ?? '';
$fSubject = $_GET['subject'] ?? '';

$sql = "SELECT s.*,
          GROUP_CONCAT(CASE WHEN m.status = 'present' THEN m.roll_no END ORDER BY m.roll_no SEPARATOR '; ') AS present_rolls,
          GROUP_CONCAT(CASE WHEN m.status = 'absent'  THEN m.roll_no END ORDER BY m.roll_no SEPARATOR '; ') AS absent_rolls,
          SUM(CASE WHEN m.status = 'present' THEN 1 ELSE 0 END) AS present_count,
          SUM(CASE WHEN m.status = 'absent'  THEN 1 ELSE 0 END) AS absent_count
        FROM attendance_sessions s
        LEFT JOIN attendance_marks m ON m.session_id = s.id
        WHERE s.teacher_id = :tid";
$params = ['tid' => $teacher['id']];

if ($fDate !== '')    { $sql .= ' AND s.session_date = :date';   $params['date']    = $fDate; }
if ($fClass !== '')   { $sql .= ' AND s.class_name = :class';    $params['class']   = $fClass; }
if ($fSubject !== '') { $sql .= ' AND s.subject = :subject';     $params['subject'] = $fSubject; }

$sql .= ' GROUP BY s.id ORDER BY s.id DESC';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$records = $stmt->fetchAll();

if (empty($records)) {
    header('Location: history.php');
    exit;
}

$filename = 'Attendance_' . $teacher['id'] . '_' . date('Y-m-d') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$out = fopen('php://output', 'w');
fputcsv($out, ['Date', 'Time', 'Class', 'Subject', 'Attendance Code', 'Total Students', 'Present', 'Absent', 'Student Roll Numbers (Present)', 'Student Roll Numbers (Absent)']);

foreach ($records as $r) {
    fputcsv($out, [
        $r['session_date'],
        $r['session_time'],
        $r['class_name'],
        $r['subject'],
        $r['attendance_code'],
        $r['total_students'],
        (int) $r['present_count'],
        (int) $r['absent_count'],
        $r['present_rolls'] ?? '',
        $r['absent_rolls'] ?? '',
    ]);
}
fclose($out);
exit;
