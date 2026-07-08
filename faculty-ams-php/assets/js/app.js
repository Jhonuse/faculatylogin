/**
 * assets/js/app.js
 * Client-side behaviour for the logged-in Faculty AMS pages.
 * All data (teachers, timetable, attendance) now lives in MySQL and is
 * rendered/saved by PHP — this file only handles UI interactions.
 */
document.addEventListener('DOMContentLoaded', () => {

  /* ---------- Mobile sidebar toggle ---------- */
  const menuToggle = document.getElementById('menuToggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  function closeSidebar() {
    sidebar && sidebar.classList.remove('open');
    overlay && overlay.classList.remove('active');
  }
  if (menuToggle && sidebar && overlay) {
    menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('open');
      overlay.classList.toggle('active');
    });
    overlay.addEventListener('click', closeSidebar);
  }

  /* ---------- Live clock on the dashboard ---------- */
  const dDate = document.getElementById('dDate');
  const dTime = document.getElementById('dTime');
  if (dDate && dTime) {
    const tick = () => {
      const now = new Date();
      dDate.textContent = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' });
      dTime.textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    };
    tick();
    setInterval(tick, 1000);
  }

  /* ---------- Mark Attendance: keep Present/Absent checkboxes mutually exclusive ---------- */
  document.querySelectorAll('.present').forEach(cb => {
    cb.addEventListener('change', () => {
      if (!cb.checked) return;
      const other = document.querySelector(`.absent[data-roll="${cb.dataset.roll}"]`);
      if (other) other.checked = false;
    });
  });
  document.querySelectorAll('.absent').forEach(cb => {
    cb.addEventListener('change', () => {
      if (!cb.checked) return;
      const other = document.querySelector(`.present[data-roll="${cb.dataset.roll}"]`);
      if (other) other.checked = false;
    });
  });

  const selectAllPresent = document.getElementById('selectAllPresent');
  const selectAllAbsent = document.getElementById('selectAllAbsent');
  if (selectAllPresent) {
    selectAllPresent.addEventListener('change', () => {
      const on = selectAllPresent.checked;
      document.querySelectorAll('.present').forEach(c => c.checked = on);
      if (on) document.querySelectorAll('.absent').forEach(c => c.checked = false);
      if (selectAllAbsent) selectAllAbsent.checked = false;
    });
  }
  if (selectAllAbsent) {
    selectAllAbsent.addEventListener('change', () => {
      const on = selectAllAbsent.checked;
      document.querySelectorAll('.absent').forEach(c => c.checked = on);
      if (on) document.querySelectorAll('.present').forEach(c => c.checked = false);
      if (selectAllPresent) selectAllPresent.checked = false;
    });
  }

  /* ---------- Mark Attendance: jump to selected class ---------- */
  const classSelect = document.getElementById('classSelect');
  if (classSelect) {
    classSelect.addEventListener('change', () => {
      if (classSelect.value) window.location.href = classSelect.value;
    });
  }

  /* ---------- History: auto-submit filter form on change ---------- */
  document.querySelectorAll('#historyFilters select, #historyFilters input').forEach(el => {
    el.addEventListener('change', () => el.closest('form').submit());
  });

  /* ---------- Confirm before destructive actions ---------- */
  document.querySelectorAll('[data-confirm]').forEach(el => {
    el.addEventListener('submit', (e) => {
      if (!confirm(el.dataset.confirm)) e.preventDefault();
    });
  });
});
