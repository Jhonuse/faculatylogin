<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';
require_login();

$teacher = current_teacher();
$today   = day_name();
$nowTime = date('H:i:s');

$stmt = $pdo->prepare(
    'SELECT * FROM timetable WHERE teacher_id = ? AND day_of_week = ? ORDER BY start_time'
);
$stmt->execute([$teacher['id'], $today]);
$todayClasses = $stmt->fetchAll();

$current = null;
foreach ($todayClasses as $c) {
    if ($nowTime >= $c['start_time'] && $nowTime < $c['end_time']) {
        $current = $c;
        break;
    }
}

$pageTitle  = 'Dashboard';
$activePage = 'dashboard';
require __DIR__ . '/includes/layout_top.php';
?>

<section class="page active">
  <div class="info-grid">
    <div class="info-box"><div class="label">Teacher Name</div><div class="value"><?= h($teacher['name']) ?></div></div>
    <div class="info-box alt1"><div class="label">Teacher ID</div><div class="value"><?= h($teacher['id']) ?></div></div>
    <div class="info-box alt2"><div class="label">Date</div><div class="value" id="dDate">-</div></div>
    <div class="info-box alt3"><div class="label">Time</div><div class="value" id="dTime">-</div></div>
  </div>

  <div class="card">
    <h3>📍 Current Class</h3>
    <?php if ($current): ?>
      <div class="current-class-banner">
        <div class="info">
          <h3><?= h($current['class_name']) ?> — <?= h($current['subject']) ?></h3>
          <p>🕒 <?= h(substr($current['start_time'], 0, 5) . '-' . substr($current['end_time'], 0, 5)) ?> | 📅 <?= h($current['day_of_week']) ?></p>
        </div>
        <a class="btn-mark" href="mark_attendance.php?class=<?= urlencode($current['class_name']) ?>&subject=<?= urlencode($current['subject']) ?>&time=<?= urlencode(substr($current['start_time'], 0, 5) . '-' . substr($current['end_time'], 0, 5)) ?>">✅ Mark Attendance</a>
      </div>
    <?php else: ?>
      <div class="no-class">📭 No class is currently in session.<br><small>Check your timetable for upcoming classes.</small></div>
    <?php endif; ?>
  </div>

  <div class="card">
    <h3>📅 Today's Timetable</h3>
    <div style="overflow-x:auto;">
      <table>
        <?php if (empty($todayClasses)): ?>
          <tr><td style="text-align:center;color:#999;padding:30px;">No classes scheduled today 🎉</td></tr>
        <?php else: ?>
          <thead><tr><th>Time</th><th>Class</th><th>Subject</th></tr></thead>
          <tbody>
          <?php foreach ($todayClasses as $c):
              $isCurrent = $current && $current['id'] === $c['id']; ?>
            <tr class="<?= $isCurrent ? 'current-row' : '' ?>">
              <td><?= h(substr($c['start_time'], 0, 5) . '-' . substr($c['end_time'], 0, 5)) ?></td>
              <td><?= h($c['class_name']) ?></td>
              <td><?= h($c['subject']) ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        <?php endif; ?>
      </table>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/layout_bottom.php'; ?>
