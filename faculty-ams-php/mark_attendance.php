<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';
require_login();

$teacher = current_teacher();
$today   = day_name();

// Today's classes, for the fallback dropdown.
$stmt = $pdo->prepare('SELECT * FROM timetable WHERE teacher_id = ? AND day_of_week = ? ORDER BY start_time');
$stmt->execute([$teacher['id'], $today]);
$todayClasses = $stmt->fetchAll();

$class   = $_GET['class']   ?? '';
$subject = $_GET['subject'] ?? '';
$time    = $_GET['time']    ?? '';

$students = [];
$code     = '';
if ($class !== '' && $subject !== '' && $time !== '') {
    $stmt = $pdo->prepare('SELECT roll_no, name FROM students WHERE class_name = ? ORDER BY name');
    $stmt->execute([$class]);
    $students = $stmt->fetchAll();
    $code = generate_attendance_code();
}

$saved = isset($_GET['saved']);

$pageTitle  = 'Mark Attendance';
$activePage = 'mark';
require __DIR__ . '/includes/layout_top.php';
?>

<section class="page active">
  <div class="card">
    <h3>✅ Mark Attendance</h3>

    <?php if ($saved): ?>
      <p style="color:#27ae60;font-weight:600;">
        ✅ Attendance saved successfully. Code: <?= h($_GET['code'] ?? '') ?>,
        Present: <?= (int) ($_GET['present'] ?? 0) ?>/<?= (int) ($_GET['total'] ?? 0) ?>
      </p>

    <?php elseif ($class === ''): ?>
      <p style="color:#777;">Please select a class from the Dashboard or choose below:</p>
      <select id="classSelect" style="padding:10px;border-radius:8px;border:2px solid #e0e0e0;margin-top:10px;width:100%;max-width:400px;">
        <option value="">-- Select Class --</option>
        <?php foreach ($todayClasses as $c):
            $t = substr($c['start_time'], 0, 5) . '-' . substr($c['end_time'], 0, 5);
            $url = 'mark_attendance.php?class=' . urlencode($c['class_name']) . '&subject=' . urlencode($c['subject']) . '&time=' . urlencode($t);
        ?>
          <option value="<?= h($url) ?>"><?= h($t) ?> • <?= h($c['class_name']) ?> • <?= h($c['subject']) ?></option>
        <?php endforeach; ?>
      </select>

    <?php elseif (empty($students)): ?>
      <p style="color:#e74c3c;">No students found for class "<?= h($class) ?>". Check the <code>students</code> table.</p>

    <?php else: ?>
      <div class="attendance-code">🔑 Attendance Code: <span><?= h($code) ?></span></div>
      <p style="margin-bottom:10px;"><strong>Class:</strong> <?= h($class) ?> &nbsp;|&nbsp; <strong>Subject:</strong> <?= h($subject) ?> &nbsp;|&nbsp; <strong>Time:</strong> <?= h($time) ?></p>

      <form method="post" action="save_attendance.php">
        <input type="hidden" name="class" value="<?= h($class) ?>">
        <input type="hidden" name="subject" value="<?= h($subject) ?>">
        <input type="hidden" name="time" value="<?= h($time) ?>">
        <input type="hidden" name="code" value="<?= h($code) ?>">

        <div class="select-all-row">
          <label><input type="checkbox" id="selectAllPresent"> Select All Present</label>
          <label><input type="checkbox" id="selectAllAbsent"> Select All Absent</label>
        </div>

        <div style="overflow-x:auto;">
          <table class="attendance-table">
            <thead><tr><th>Roll No</th><th>Student Name</th><th>Present</th><th>Absent</th></tr></thead>
            <tbody>
            <?php foreach ($students as $s): ?>
              <tr>
                <td><?= h($s['roll_no']) ?></td>
                <td><?= h($s['name']) ?></td>
                <td><input type="checkbox" class="present" data-roll="<?= h($s['roll_no']) ?>" name="present[]" value="<?= h($s['roll_no']) ?>"></td>
                <td><input type="checkbox" class="absent"  data-roll="<?= h($s['roll_no']) ?>" name="absent[]"  value="<?= h($s['roll_no']) ?>"></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <button type="submit" class="btn btn-save">💾 Save Attendance</button>
      </form>
    <?php endif; ?>
  </div>
</section>

<?php require __DIR__ . '/includes/layout_bottom.php'; ?>
