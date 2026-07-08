<?php
/**
 * includes/layout_top.php
 * Expects $pageTitle, $activePage, and $teacher (from current_teacher()) to already be set.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title><?= h($pageTitle ?? 'Faculty Portal') ?> — Faculty AMS</title>
<link rel="stylesheet" href="assets/css/app.css" />
</head>
<body>

<div class="app active">
  <div class="overlay" id="overlay"></div>

  <aside class="sidebar" id="sidebar">
    <div class="logo">
      <h2>📚 Faculty AMS</h2>
      <small>Attendance System</small>
    </div>
    <nav>
      <a href="dashboard.php" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>"><span class="icon">🏠</span> Dashboard</a>
      <a href="classes.php" class="<?= $activePage === 'classes' ? 'active' : '' ?>"><span class="icon">📅</span> My Classes</a>
      <a href="mark_attendance.php" class="<?= $activePage === 'mark' ? 'active' : '' ?>"><span class="icon">✅</span> Mark Attendance</a>
      <a href="history.php" class="<?= $activePage === 'history' ? 'active' : '' ?>"><span class="icon">📂</span> Attendance History</a>
      <a href="logout.php"><span class="icon">🚪</span> Logout</a>
    </nav>
  </aside>

  <main class="main">
    <div class="topbar">
      <button class="menu-toggle" id="menuToggle">☰</button>
      <h2 id="pageTitle"><?= h($pageTitle ?? '') ?></h2>
      <div id="topbarUser" style="font-size:0.9rem;color:#555;">👤 <?= h($teacher['name']) ?> (<?= h($teacher['id']) ?>)</div>
    </div>
