<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';
require_login();

$teacher = current_teacher();

$fDate    = $_GET['date']    ?? '';
$fClass   = $_GET['class']   ?? '';
$fSubject = $_GET['subject'] ?? '';

// Distinct filter options, scoped to this teacher's own records.
$classStmt = $pdo->prepare('SELECT DISTINCT class_name FROM attendance_sessions WHERE teacher_id = ? ORDER BY class_name');
$classStmt->execute([$teacher['id']]);
$classOptions = $classStmt->fetchAll(PDO::FETCH_COLUMN);

$subjStmt = $pdo->prepare('SELECT DISTINCT subject FROM attendance_sessions WHERE teacher_id = ? ORDER BY subject');
$subjStmt->execute([$teacher['id']]);
$subjectOptions = $subjStmt->fetchAll(PDO::FETCH_COLUMN);

$sql = "SELECT s.*,
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

$pageTitle  = 'Attendance History';
$activePage = 'history';
require __DIR__ . '/includes/layout_top.php';

$exportQs = http_build_query(['date' => $fDate, 'class' => $fClass, 'subject' => $fSubject]);
?>

<section class="page active">
  <div class="card">
    <h3>📂 Attendance History</h3>

    <div style="display:flex;gap:10px;margin-bottom:20px;flex-wrap:wrap;">
      <a class="btn" style="width:auto;padding:10px 20px;background:linear-gradient(135deg,#4facfe,#00f2fe);display:inline-block;text-decoration:none;text-align:center;" href="export_csv.php?<?= h($exportQs) ?>">📥 Export to CSV</a>
      <form method="post" action="clear_records.php" data-confirm="⚠️ Delete ALL of your attendance records? This cannot be undone." style="display:inline;">
        <button type="submit" class="btn" style="width:auto;padding:10px 20px;background:linear-gradient(135deg,#eb3349,#f45c43);">🗑️ Clear All Records</button>
      </form>
    </div>

    <form id="historyFilters" method="get" action="history.php" class="search-bar">
      <input type="date" name="date" value="<?= h($fDate) ?>" />
      <select name="class">
        <option value="">All Classes</option>
        <?php foreach ($classOptions as $c): ?>
          <option value="<?= h($c) ?>" <?= $c === $fClass ? 'selected' : '' ?>><?= h($c) ?></option>
        <?php endforeach; ?>
      </select>
      <select name="subject">
        <option value="">All Subjects</option>
        <?php foreach ($subjectOptions as $s): ?>
          <option value="<?= h($s) ?>" <?= $s === $fSubject ? 'selected' : '' ?>><?= h($s) ?></option>
        <?php endforeach; ?>
      </select>
    </form>

    <div id="historyList">
      <?php if (empty($records)): ?>
        <p style="text-align:center;color:#999;padding:30px;">No records found 📭</p>
      <?php else: ?>
        <?php foreach ($records as $r): ?>
          <div class="record-card">
            <h4><?= h($r['class_name']) ?> — <?= h($r['subject']) ?></h4>
            <p>📅 <?= h(format_date_pretty($r['session_date'])) ?> &nbsp;|&nbsp; 🕒 <?= h($r['session_time']) ?></p>
            <p>
              <span class="badge code"><?= h($r['attendance_code']) ?></span>
              <span class="badge present">Present: <?= (int) $r['present_count'] ?></span>
              <span class="badge absent">Absent: <?= (int) $r['absent_count'] ?></span>
              <span class="badge" style="background:#e2e3e5;color:#383d41;">Total: <?= (int) $r['total_students'] ?></span>
            </p>
            <form method="post" action="delete_record.php" data-confirm="Delete this attendance record?" style="margin-top:8px;">
              <input type="hidden" name="id" value="<?= (int) $r['id'] ?>">
              <button type="submit" class="btn" style="width:auto;padding:6px 14px;font-size:0.8rem;background:#e74c3c;">Delete</button>
            </form>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/layout_bottom.php'; ?>
