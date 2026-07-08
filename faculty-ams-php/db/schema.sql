-- Faculty Attendance Management System — MySQL schema
-- Import with: mysql -u root -p < schema.sql

CREATE DATABASE IF NOT EXISTS faculty_ams
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE faculty_ams;

-- ---------------------------------------------------------------
-- Teachers (replaces the hardcoded `teachers` JS array)
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS teachers (
  id            VARCHAR(20)  PRIMARY KEY,
  name          VARCHAR(150) NOT NULL,
  department    VARCHAR(100) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------
-- Weekly timetable (replaces the hardcoded `timetable` JS array)
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS timetable (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  teacher_id   VARCHAR(20) NOT NULL,
  day_of_week  ENUM('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  start_time   TIME NOT NULL,
  end_time     TIME NOT NULL,
  class_name   VARCHAR(20)  NOT NULL,
  subject      VARCHAR(100) NOT NULL,
  FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE CASCADE,
  INDEX idx_teacher_day (teacher_id, day_of_week)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------
-- Students (replaces the hardcoded `students` JS object)
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS students (
  roll_no    VARCHAR(30) PRIMARY KEY,
  name       VARCHAR(150) NOT NULL,
  class_name VARCHAR(20)  NOT NULL,
  INDEX idx_class (class_name)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------
-- One row per "Mark Attendance" action (replaces one entry in the
-- localStorage "attendance" array)
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS attendance_sessions (
  id               INT AUTO_INCREMENT PRIMARY KEY,
  teacher_id       VARCHAR(20)  NOT NULL,
  class_name       VARCHAR(20)  NOT NULL,
  subject          VARCHAR(100) NOT NULL,
  session_time     VARCHAR(20)  NOT NULL,   -- e.g. "09:00-10:00"
  attendance_code  VARCHAR(20)  NOT NULL,
  session_date     DATE         NOT NULL,
  total_students   INT          NOT NULL DEFAULT 0,
  created_at       TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE CASCADE,
  INDEX idx_teacher_date (teacher_id, session_date)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------
-- Per-student present/absent marks for a session
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS attendance_marks (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  session_id  INT NOT NULL,
  roll_no     VARCHAR(30) NOT NULL,
  status      ENUM('present','absent') NOT NULL,
  FOREIGN KEY (session_id) REFERENCES attendance_sessions(id) ON DELETE CASCADE,
  UNIQUE KEY uniq_session_roll (session_id, roll_no)
) ENGINE=InnoDB;
