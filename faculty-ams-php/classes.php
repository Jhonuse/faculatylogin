<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';
require_login();

$teacher = current_teacher();

$stmt = $pdo->prepare(
    "SELECT * FROM timetable WHERE teacher_id = ?
     ORDER BY FIELD(day_of_week,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'), start_time"
);
$stmt->execute([$teacher['id']]);
$rows = $stmt->fetchAll();

// Group by day for rowspan rendering, matching the original layout.
$byDay = [];
foreach ($rows as $r) {
    $byDay[$r['day_of_week']][] = $r;
}

$pageTitle  = 'My Classes';
$activePage = 'classes';
require __DIR__ . '/includes/layout_top.php';
?>

<section class="page active">
  <div class="card">
    <h3>📅 Full Weekly Timetable</h3>
    <div style="overflow-x:auto;">
      <table>
        <thead><tr><th>Day</th><th>Time</th><th>Class</th><th>Subject</th></tr></thead>
        <tbody>
        <?php if (empty($byDay)): ?>
          <tr><td colspan="4" style="text-align:center;color:#999;padding:30px;">No classes assigned yet.</td></tr>
        <?php else: ?>
          <?php foreach ($byDay as $day => $dayClasses): ?>
            <?php foreach ($dayClasses as $i => $c): ?>
              <tr>
                <?php if ($i === 0): ?>
                  <td rowspan="<?= count($dayClasses) ?>" style="font-weight:600;vertical-align:top;"><?= h($day) ?></td>
                <?php endif; ?>
                <td><?= h(substr($c['start_time'], 0, 5) . '-' . substr($c['end_time'], 0, 5)) ?></td>
                <td><?= h($c['class_name']) ?></td>
                <td><?= h($c['subject']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/layout_bottom.php'; ?>
