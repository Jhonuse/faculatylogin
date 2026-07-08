# Faculty AMS — PHP + MySQL version

This converts the original single-file HTML/localStorage prototype
(`faculty-login.html`) into a real PHP application backed by MySQL, plus
`index.html` → `index.php`.

## What changed

| Before (HTML/JS) | After (PHP/MySQL) |
|---|---|
| `teachers` array, plaintext passwords | `teachers` table, `password_hash()` / `password_verify()` |
| `timetable` array | `timetable` table |
| `students` object | `students` table |
| `localStorage.getItem("attendance")` | `attendance_sessions` + `attendance_marks` tables |
| `currentUser` JS variable | PHP `$_SESSION` |
| One big HTML file with hidden `.page` divs | Separate PHP pages: `dashboard.php`, `classes.php`, `mark_attendance.php`, `history.php` |
| "Clear All Records" button (localStorage.setItem) | `clear_records.php` — `DELETE FROM attendance_sessions WHERE teacher_id = ?` |
| "View Raw Data" / debug buttons | Removed (was inspecting localStorage, no longer relevant) |

## File layout

```
config.php              DB connection (edit this first)
index.php               Landing page (was index.html)
faculty-login.php       Login form + auth check
logout.php              Destroys the session
dashboard.php           Today's timetable + current class
classes.php             Full weekly timetable
mark_attendance.php     Pick a class, check students present/absent
save_attendance.php     Writes the attendance record to MySQL
history.php             Filterable list, per-record delete, clear-all
delete_record.php       Deletes one record (owner-checked)
clear_records.php       Deletes ALL of the logged-in teacher's records
export_csv.php          Streams a CSV download from MySQL
db/schema.sql           CREATE TABLE statements
db/seed.php             One-time CLI loader for teachers/timetable/students
includes/               auth.php, functions.php, layout_top.php, layout_bottom.php
assets/css/app.css      Styles for the login + faculty portal pages
assets/css/style.css    Styles for the public site (index.php), unchanged
assets/js/app.js        UI behaviour for the faculty portal
assets/js/main.js       UI behaviour for index.php, unchanged
```

## Setup

1. **Create the database and tables:**
   ```bash
   mysql -u root -p < db/schema.sql
   ```

2. **Edit `config.php`** with your MySQL host/user/password.

3. **Seed the demo data** (teachers, timetable, students) — this must be run
   with PHP itself so it can hash the demo passwords:
   ```bash
   php db/seed.php
   ```

4. **Serve the app** (e.g. `php -S localhost:8000` from this folder, or drop
   it into your Apache/Nginx + PHP-FPM webroot), then visit
   `faculty-login.php`.

5. **Demo login:** any Teacher ID from the roster (e.g. `T001`) with the
   password equal to that same ID (e.g. `T001`) — same as the original
   app's demo credentials, just now stored as bcrypt hashes.

## Notes / things worth fixing next

- The original `students` data is all keyed to class **"IV-A"**, while the
  timetable uses **"CS-A" / "CS-B" / "CS-C"**. That mismatch existed in the
  source file already (Mark Attendance would show an empty roster). Edit
  `db/seed.php` or the `students` table so `class_name` matches your real
  timetable classes.
- `student-login.php` and `dean-login.php` are linked from `index.php` but
  weren't part of the uploaded files, so they aren't included here — only
  `faculty-login.php` was converted.
- Passwords are hashed with `password_hash()`/bcrypt. Consider requiring
  teachers to set their own password rather than using "ID = password".
- All database access uses PDO prepared statements, so it's protected
  against SQL injection out of the box.
