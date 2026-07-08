<?php
/** Escape a string for safe HTML output. */
function h(?string $s): string
{
    return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}

/** Generates a short random attendance code, e.g. ATT-4821. */
function generate_attendance_code(): string
{
    return 'ATT-' . random_int(1000, 9999);
}

/** Full weekday name for a given date (defaults to today), matching ENUM values in `timetable`. */
function day_name(?string $date = null): string
{
    $ts = $date ? strtotime($date) : time();
    return date('l', $ts);
}

/** Nicely formatted date, e.g. "Wednesday, Jul 8, 2026". */
function format_date_pretty(string $date): string
{
    return date('l, M j, Y', strtotime($date));
}
