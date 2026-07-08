<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

// Already logged in? Skip straight to the dashboard.
if (!empty($_SESSION['teacher_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id   = strtoupper(trim($_POST['teacherId'] ?? ''));
    $pass = $_POST['passcode'] ?? '';

    if ($id === '' || $pass === '') {
        $error = 'Please fill in both fields.';
    } elseif (strlen($pass) < 4) {
        $error = 'Password looks too short.';
    } else {
        $stmt = $pdo->prepare('SELECT id, name, department, password_hash FROM teachers WHERE id = ?');
        $stmt->execute([$id]);
        $teacher = $stmt->fetch();

        if (!$teacher) {
            $error = '❌ Invalid Teacher ID.';
        } elseif (!password_verify($pass, $teacher['password_hash'])) {
            $error = '❌ Incorrect passcode.';
        } else {
            session_regenerate_id(true);
            $_SESSION['teacher_id']         = $teacher['id'];
            $_SESSION['teacher_name']       = $teacher['name'];
            $_SESSION['teacher_department'] = $teacher['department'];
            header('Location: dashboard.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Faculty Attendance Management System</title>
<link rel="stylesheet" href="assets/css/app.css" />
</head>
<body>

<div class="login-wrapper">
  <div class="login-card">
    <h1>🎓 Faculty Portal</h1>
    <p class="sub">Attendance Management System</p>
    <form id="loginForm" method="post" action="faculty-login.php">
      <label for="teacherId">Teacher ID</label>
      <input type="text" id="teacherId" name="teacherId" placeholder="e.g. T001" value="<?= h($_POST['teacherId'] ?? '') ?>" required />

      <label for="passcode">Passcode</label>
      <div class="field" style="position:relative;">
        <input type="password" id="passcode" name="passcode" placeholder="Enter passcode" required style="width:100%;padding-right:40px;" />
        <button type="button" id="togglePass" style="position:absolute;right:10px;top:12px;background:none;border:none;cursor:pointer;font-size:1.2rem;">👁️</button>
      </div>
      <button type="submit" class="btn">Login</button>
      <?php if ($error): ?>
        <p id="loginError" class="error"><?= h($error) ?></p>
      <?php endif; ?>
    </form>
    <p class="hint">Demo: T001/T001, T002/T002, T003/T003</p>
    <p class="hint">Demo IDs: T001, T002, T003 …</p>
  </div>
</div>

<script>
  document.getElementById('togglePass').addEventListener('click', function () {
    const input = document.getElementById('passcode');
    input.type = input.type === 'password' ? 'text' : 'password';
  });
</script>
</body>
</html>
