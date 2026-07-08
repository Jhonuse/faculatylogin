<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panimalar Engineering College</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Source+Sans+3:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
  <style>

:root {
  --navy: #0B2A4A;
  --navy-dark: #071B33;
  --navy-tint: #12395F;
  --maroon: #7A1F2B;
  --maroon-tint: #98283A;
  --gold: #C9A227;
  --gold-tint: #E0BE55;
  --cream: #F7F5EF;
  --cream-deep: #EFEADB;
  --ink: #1E2430;
  --slate: #5B6472;
  --line: #DDD6C4;
  --white: #FFFFFF;

  --font-display: 'Playfair Display', Georgia, serif;
  --font-body: 'Source Sans 3', -apple-system, Segoe UI, sans-serif;
  --font-mono: 'IBM Plex Mono', 'Courier New', monospace;

  --radius: 4px;
  --shadow-card: 0 1px 2px rgba(11,42,74,0.06), 0 8px 24px rgba(11,42,74,0.08);
  --shadow-lift: 0 20px 40px rgba(11,42,74,0.18);
  --max: 1180px;
}

/* ---------- Reset ---------- */
* { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
  margin: 0;
  font-family: var(--font-body);
  color: var(--ink);
  background: var(--cream);
  line-height: 1.6;
  -webkit-font-smoothing: antialiased;
}
img { max-width: 100%; display: block; }
a { color: inherit; text-decoration: none; }
ul { list-style: none; margin: 0; padding: 0; }
h1, h2, h3, h4 { font-family: var(--font-display); margin: 0 0 .5em; color: var(--navy-dark); font-weight: 700; }
p { margin: 0 0 1em; color: var(--slate); }
:focus-visible { outline: 3px solid var(--gold); outline-offset: 2px; }
.wrap { max-width: var(--max); margin: 0 auto; padding: 0 24px; }

@media (prefers-reduced-motion: reduce) {
  * { animation-duration: 0.001ms !important; animation-iteration-count: 1 !important; transition-duration: 0.001ms !important; scroll-behavior: auto !important; }
}

/* ---------- Buttons ---------- */
.btn {
  display: inline-flex; align-items: center; justify-content: center; gap: 8px;
  font-family: var(--font-body); font-weight: 600; font-size: .92rem;
  padding: 11px 22px; border-radius: var(--radius); border: 1.5px solid transparent;
  cursor: pointer; transition: transform .18s ease, box-shadow .18s ease, background .18s ease, color .18s ease;
  letter-spacing: .01em;
}
.btn:hover { transform: translateY(-2px); }
.btn--primary { background: var(--gold); color: var(--navy-dark); }
.btn--primary:hover { background: var(--gold-tint); box-shadow: var(--shadow-lift); }
.btn--outline { background: transparent; border-color: var(--white); color: var(--white); }
.btn--outline:hover { background: var(--white); color: var(--navy-dark); }
.btn--ghost { background: transparent; border-color: rgba(11,42,74,.25); color: var(--navy); padding: 8px 16px; font-size: .85rem; }
.btn--ghost:hover { background: var(--navy); color: var(--white); border-color: var(--navy); }
.btn--gold { background: var(--maroon); color: var(--white); padding: 8px 16px; font-size: .85rem; border-color: var(--maroon); }
.btn--gold:hover { background: var(--gold); color: var(--navy-dark); border-color: var(--gold); }
.btn--block { width: 100%; }

/* =========================================================
   TOP UTILITY BAR + HEADER
   ========================================================= */
.topbar { background: var(--navy-dark); color: rgba(255,255,255,.75); font-size: .8rem; }
.topbar__inner { display: flex; justify-content: space-between; align-items: center; height: 34px; }
.topbar__contact span { margin-right: 18px; }
.topbar__links a { margin-left: 16px; color: rgba(255,255,255,.75); }
.topbar__links a:hover { color: var(--gold-tint); }

.site-header { background: var(--white); padding-top: 20px;padding-bottom: 20px; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 10px rgba(11,42,74,.05); }
.site-header__inner { display: flex; align-items: center; justify-content: space-between; height: 84px; }

.brand { display: flex; align-items: center; gap: 14px; }
.brand__crest {
  width: 52px; height: 52px; border-radius: 50%;
  background:circle at 35% 30%;
  border: 2px ;
  color: var(--gold-tint); font-family: var(--font-mono); font-weight: 700; font-size: .8rem;
  display: flex; align-items: center; justify-content: center; letter-spacing: .03em;
  box-shadow: inset 0 0 0 3px rgba(255,255,255,.06);
}
.brand__text { display: flex; flex-direction: column; line-height: 1.25; }
.brand__text strong { font-family: var(--font-display); font-size: 1.15rem; color: var(--navy-dark); }
.brand__text small { color: var(--slate); font-size: .74rem; letter-spacing: .04em; text-transform: uppercase; }

.main-nav { display: flex; align-items: center; gap: 30px; }
.main-nav ul { display: flex; gap: 26px; }
.main-nav a { font-weight: 600; font-size: .92rem; color: var(--navy); position: relative; padding: 6px 0; }
.main-nav a::after { content:""; position:absolute; left:0; bottom:0; width:0; height:2px; background:var(--gold); transition:width .2s ease; }
.main-nav a:hover::after, .main-nav a.is-active::after { width: 100%; }
.nav-portals { display: flex; gap: 10px; padding-left: 22px; border-left: 1px solid var(--line); }

.nav-toggle { display: none; flex-direction: column; gap: 5px; background: none; border: 0; cursor: pointer; padding: 8px; }
.nav-toggle span { width: 26px; height: 2px; background: var(--navy); display: block; transition: transform .2s ease, opacity .2s ease; }

/* =========================================================
   HERO
   ========================================================= */
.hero {
  position: relative;
  overflow: hidden;
  background-image: url("https://cdn.corenexis.com/f/PPYlKsndKNL.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  color: var(--white); padding: 84px;
  row-gap:10px;
}
.hero::before {
  content: ""; position: absolute; inset: 0;
  background-image: radial-gradient(rgba(201,162,39,.14) 1.5px, transparent 1.5px);
  background-size: 26px 26px; opacity: .5; pointer-events: none;
}
.hero__inner { display: grid; grid-template-columns: 1.15fr .85fr; gap: 40px; align-items: left; position:relative;  }
.hero__eyebrow {
  display:inline-flex; align-items:left; gap:8px;text-align:left;
  font-family: var(--font-mono); font-size: .74rem; letter-spacing: .12em; text-transform: uppercase;
  color: var(--gold-tint); border: 1px solid rgba(201,162,39,.4); padding: 6px 14px; border-radius: 999px;
  margin-bottom: 1px;
}


.hero h1{
  text-align:left;
  display:inline-flex;
  gap:10px;
}
.hero h1 { font-size: clamp(2.1rem, 4vw, 3.4rem); color: var(--white); line-height: 1.12; margin-bottom: 18px; text-align: left; }
.hero h1 em { font-style: normal; color: var(--gold-tint);  text-align: left;}
.hero p.lead { color: rgba(255,255,255,.78); font-size: 1.08rem; max-width: 540px; margin-bottom: 30px; }
.hero__cta { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 46px; }

.hero__seal { position: relative; display: flex; align-items: left; justify-content: center; }


@keyframes sealSpin { from { transform: rotate(0deg);} to { transform: rotate(360deg);} }
.seal-medallion__core { animation: counterSpin 60s linear infinite; }
@keyframes counterSpin { from { transform: rotate(0deg);} to { transform: rotate(-360deg);} }

/* stat strip */
.stat-strip { background: var(--navy-dark); border-top: 1px solid rgba(255,255,255,.08); position: relative; z-index: 1; transform:translateY(59%); }
.stat-strip__grid { display: grid; grid-template-columns: repeat(4, 1fr); }
.stat-strip__item { text-align: center; padding: 26px 10px; border-right: 1px solid rgba(255,255,255,.08); }
.stat-strip__item:last-child { border-right: none; }
.stat-strip__num { font-family: var(--font-mono); font-size: 2rem; font-weight: 700; color: var(--gold-tint); }
.stat-strip__label { font-size: .78rem; color: rgba(255,255,255,.65); text-transform: uppercase; letter-spacing: .08em; margin-top: 4px; }

/* =========================================================
   SECTION SCAFFOLD
   ========================================================= */
.section { padding: 84px 0; }
.section--tight { padding: 64px 0; }
.section--alt { background: var(--white); }
.section-head { max-width: 640px; margin: 0 auto 48px; text-align: center; }
.section-head .eyebrow { font-family: var(--font-mono); font-size: .74rem; letter-spacing: .14em; text-transform: uppercase; color: var(--maroon); display: block; margin-bottom: 10px; }
.section-head h2 { font-size: clamp(1.6rem, 3vw, 2.3rem); }
.section-head p { margin-top: 10px; }
.rule { width: 64px; height: 3px; background: var(--gold); margin: 18px auto 0; }

/* ---------- About ---------- */
.about-grid { display: grid; grid-template-columns: .9fr 1.1fr; gap: 56px; align-items: center; }
.about-photo {
  aspect-ratio: 4/3; border-radius: var(--radius); background: linear-gradient(135deg, var(--navy), var(--navy-tint));
  position: relative; overflow: hidden; box-shadow: var(--shadow-card);
}
.about-photo::after {
  content: "EST. 2010"; position: absolute; bottom: 18px; left: 18px; color: rgba(255,255,255,.85);
  font-family: var(--font-mono); font-size: .8rem; letter-spacing: .1em; border: 1px solid rgba(255,255,255,.4); padding: 6px 12px; border-radius: 3px;
}
.about-copy h3 { font-size: 1.6rem; }
.about-list { margin-top: 22px; display: grid; gap: 14px; }
.about-list li { display: flex; gap: 12px; align-items: flex-start; color: var(--ink); font-weight: 600; font-size: .95rem; }
.about-list li::before { content: "✓"; color: var(--maroon); font-weight: 700; }

/* ---------- Departments ---------- */
.dept-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 22px; }
.dept-card {
  background: var(--white); border: 1px solid var(--line); border-radius: var(--radius);
  padding: 26px 22px; box-shadow: var(--shadow-card); transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  position: relative; overflow: hidden;
}
.dept-card::before { content:""; position:absolute; top:0; left:0; right:0; height:3px; background: var(--gold); transform: scaleX(0); transform-origin: left; transition: transform .25s ease; }
.dept-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lift); border-color: transparent; }
.dept-card:hover::before { transform: scaleX(1); }
.dept-card .code { font-family: var(--font-mono); color: var(--maroon); font-size: .78rem; letter-spacing: .08em; }
.dept-card h4 { margin: 8px 0 8px; font-size: 1.05rem; }
.dept-card p { font-size: .88rem; margin-bottom: 0; }

/* ---------- Admissions timeline ---------- */
.timeline { position: relative; margin-top: 10px; padding-left: 26px; border-left: 2px solid var(--line); }
.timeline__item { position: relative; padding: 0 0 34px 26px; }
.timeline__item::before {
  content: ""; position: absolute; left: -35px; top: 2px; width: 14px; height: 14px; border-radius: 50%;
  background: var(--white); border: 3px solid var(--maroon);
}
.timeline__item h4 { font-size: 1.02rem; margin-bottom: 4px; }
.timeline__step { font-family: var(--font-mono); font-size: .74rem; color: var(--slate); text-transform: uppercase; letter-spacing: .08em; }

/* ---------- Notice board ---------- */
.noticeboard {
  background: var(--cream-deep); border: 1px solid var(--line); border-radius: 6px; padding: 6px;
}
.noticeboard__inner { background: repeating-linear-gradient(135deg, #EDE7D6, #EDE7D6 10px, #E7E0CC 10px, #E7E0CC 20px); border-radius: 4px; padding: 26px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.pin-note {
  background: var(--white); padding: 18px 18px 16px; box-shadow: 0 6px 14px rgba(0,0,0,.12); position: relative;
  transform: rotate(-1.2deg);
}
.pin-note:nth-child(2) { transform: rotate(1deg); }
.pin-note:nth-child(3) { transform: rotate(-.6deg); }
.pin-note::before {
  content: ""; position: absolute; top: -8px; left: 50%; transform: translateX(-50%);
  width: 14px; height: 14px; border-radius: 50%; background: var(--maroon); box-shadow: 0 2px 3px rgba(0,0,0,.35);
}
.pin-note .date { font-family: var(--font-mono); font-size: .72rem; color: var(--maroon); text-transform: uppercase; letter-spacing: .06em; }
.pin-note h4 { font-size: .95rem; margin: 6px 0; }
.pin-note p { font-size: .85rem; margin: 0; }

/* =========================================================
   LOGIN PORTAL — SIGNATURE SECTION (ID cards)
   ========================================================= */
.portals { background: var(--navy-dark); position: relative; overflow: hidden; }
.portals::before {
  content: ""; position: absolute; inset: 0;
  background-image: radial-gradient(rgba(201,162,39,.1) 1.5px, transparent 1.5px);
  background-size: 24px 24px;
}
.portals .section-head h2 { color: var(--white); }
.portals .section-head p { color: rgba(255,255,255,.65); }
.portals .section-head .eyebrow { color: var(--gold-tint); }

.id-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; position: relative; z-index: 1; }
.id-card {
  background: var(--white); border-radius: 10px; overflow: hidden; box-shadow: var(--shadow-lift);
  transform: perspective(800px) rotateX(0deg); transition: transform .3s ease, box-shadow .3s ease;
}
.id-card:hover { transform: perspective(800px) rotateX(3deg) translateY(-6px); }
.id-card__ribbon { padding: 16px 20px; color: var(--white); display: flex; justify-content: space-between; align-items: center; }
.id-card--student .id-card__ribbon { background: var(--navy); }
.id-card--faculty .id-card__ribbon { background: var(--maroon); }
.id-card--dean .id-card__ribbon { background: linear-gradient(120deg, var(--gold), var(--gold-tint)); color: var(--navy-dark); }
.id-card__ribbon strong { font-family: var(--font-mono); font-size: .78rem; letter-spacing: .1em; text-transform: uppercase; }
.id-card__body { padding: 26px 22px 22px; }
.id-card__avatar {
  width: 58px; height: 58px; border-radius: 50%; margin-bottom: 14px;
  background: linear-gradient(135deg, var(--navy-tint), var(--navy));
  display: flex; align-items: center; justify-content: center; color: var(--gold-tint); font-family: var(--font-mono); font-weight: 700;
  border: 2px solid var(--cream-deep);
}
.id-card h3 { font-size: 1.1rem; margin-bottom: 6px; }
.id-card p { font-size: .87rem; margin-bottom: 18px; }
.id-card__strip { height: 8px; background: repeating-linear-gradient(45deg, #1a1a1a, #1a1a1a 6px, #333 6px, #333 12px); margin: 0 -22px 18px; opacity: .85; }

/* =========================================================
   AUTH PAGES (login screens)
   ========================================================= */
.auth-shell {
  min-height: calc(100vh - 84px - 34px);
  display: flex; align-items: center; justify-content: center;
  background: linear-gradient(160deg, var(--navy-dark), var(--navy) 60%, var(--navy-tint));
  padding: 60px 20px; position: relative; overflow: hidden;
}
.auth-shell::before {
  content: ""; position: absolute; inset: 0;
  background-image: radial-gradient(rgba(201,162,39,.12) 1.5px, transparent 1.5px);
  background-size: 26px 26px;
}
.auth-card {
  background: var(--white); width: 100%; max-width: 420px; border-radius: 10px; overflow: hidden;
  box-shadow: var(--shadow-lift); position: relative; z-index: 1;
}
.auth-card__top { padding: 30px 30px 20px; text-align: center; border-bottom: 1px solid var(--line); }
.auth-card__top .brand__crest { margin: 0 auto 14px; }
.auth-card__top h1 { font-size: 1.3rem; margin-bottom: 4px; }
.auth-card__top p { font-size: .85rem; margin-bottom: 0; }
.auth-card__body { padding: 26px 30px 30px; }

.field { margin-bottom: 18px; }
.field label { display: block; font-size: .82rem; font-weight: 700; color: var(--navy-dark); margin-bottom: 6px; letter-spacing: .01em; }
.field input, .field select {
  width: 100%; padding: 11px 13px; border: 1.5px solid var(--line); border-radius: 5px;
  font-family: var(--font-body); font-size: .95rem; background: var(--cream); transition: border-color .18s ease, background .18s ease;
}
.field input:focus, .field select:focus { border-color: var(--navy); background: var(--white); outline: none; }
.field-row { display: flex; justify-content: space-between; align-items: center; font-size: .82rem; margin-bottom: 20px; }
.field-row a { color: var(--maroon); font-weight: 600; }
.field-row label { display: flex; align-items: center; gap: 6px; color: var(--slate); }

.alert { padding: 12px 14px; border-radius: 5px; font-size: .85rem; margin-bottom: 18px; }
.alert--error { background: #FBE9E7; color: #8B2F1F; border: 1px solid #F1B8AE; }
.alert--success { background: #E8F3E8; color: #285C2C; border: 1px solid #B7DCB9; }
.alert--info { background: #EAF1F8; color: #1D3F63; border: 1px solid #BBD3E9; }

.auth-card__foot { text-align: center; padding: 16px 30px 28px; font-size: .84rem; color: var(--slate); }
.auth-card__foot a { color: var(--navy); font-weight: 700; }
.demo-hint { margin-top: 14px; background: var(--cream-deep); border: 1px dashed var(--line); border-radius: 5px; padding: 10px 12px; font-family: var(--font-mono); font-size: .74rem; color: var(--slate); text-align: left; }

/* =========================================================
   DASHBOARD SHELL
   ========================================================= */
.dash { display: grid; grid-template-columns: 260px 1fr; min-height: 100vh; }
.dash__sidebar { background: var(--navy-dark); color: rgba(255,255,255,.85); padding: 26px 20px; }
.dash__brand { display: flex; align-items: center; gap: 12px; padding-bottom: 22px; margin-bottom: 22px; border-bottom: 1px solid rgba(255,255,255,.1); }
.dash__brand strong { font-family: var(--font-display); font-size: 1.02rem; color: var(--white); display: block; }
.dash__brand small { font-size: .7rem; color: rgba(255,255,255,.5); text-transform: uppercase; letter-spacing: .08em; }
.dash-nav a { display: flex; align-items: center; gap: 10px; padding: 11px 12px; border-radius: 6px; font-size: .9rem; font-weight: 600; color: rgba(255,255,255,.75); margin-bottom: 4px; transition: background .18s ease, color .18s ease; }
.dash-nav a:hover, .dash-nav a.is-active { background: rgba(201,162,39,.15); color: var(--gold-tint); }
.dash__logout { margin-top: 26px; padding-top: 18px; border-top: 1px solid rgba(255,255,255,.1); }

.dash__main { padding: 32px 40px; background: var(--cream); }
.dash__header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
.dash__header h1 { font-size: 1.5rem; margin-bottom: 4px; }
.dash__header p { margin: 0; }
.dash__avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--navy); color: var(--gold-tint); display: flex; align-items: center; justify-content: center; font-family: var(--font-mono); font-weight: 700; border: 2px solid var(--gold); }

.card-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
.metric-card { background: var(--white); border: 1px solid var(--line); border-radius: 8px; padding: 20px; box-shadow: var(--shadow-card); }
.metric-card .num { font-family: var(--font-mono); font-size: 1.7rem; font-weight: 700; color: var(--navy-dark); }
.metric-card .label { font-size: .78rem; color: var(--slate); text-transform: uppercase; letter-spacing: .06em; margin-top: 4px; }

.panel { background: var(--white); border: 1px solid var(--line); border-radius: 8px; padding: 24px; box-shadow: var(--shadow-card); margin-bottom: 24px; }
.panel h3 { font-size: 1.05rem; margin-bottom: 16px; }
table.data-table { width: 100%; border-collapse: collapse; font-size: .9rem; }
table.data-table th { text-align: left; padding: 10px 12px; background: var(--cream); color: var(--navy-dark); font-family: var(--font-mono); font-size: .74rem; text-transform: uppercase; letter-spacing: .05em; }
table.data-table td { padding: 10px 12px; border-top: 1px solid var(--line); color: var(--ink); }
.badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: .74rem; font-weight: 700; }
.badge--good { background: #E8F3E8; color: #285C2C; }
.badge--warn { background: #FBF2DC; color: #8A6412; }
.badge--bad { background: #FBE9E7; color: #8B2F1F; }

/* =========================================================
   FOOTER
   ========================================================= */
.site-footer { background: var(--navy-dark); color: rgba(255,255,255,.7); padding: 60px 0 0; }
.footer__grid { display: grid; grid-template-columns: 1.4fr 1fr 1fr 1.2fr; gap: 40px; padding-bottom: 40px; }
.footer__col .brand__crest { margin-bottom: 14px; }
.footer__col p, .footer__col address { color: rgba(255,255,255,.6); font-size: .88rem; font-style: normal; }
.footer__col h4 { color: var(--white); font-size: .95rem; margin-bottom: 14px; }
.footer__col ul li { margin-bottom: 9px; }
.footer__col ul a { color: rgba(255,255,255,.65); font-size: .88rem; }
.footer__col ul a:hover { color: var(--gold-tint); }
.footer__bottom { display: flex; justify-content: space-between; padding: 18px 24px; border-top: 1px solid rgba(255,255,255,.1); font-size: .78rem; }

/* =========================================================
   RESPONSIVE
   ========================================================= */
@media (max-width: 980px) {
  .hero__inner { grid-template-columns: 1fr; text-align: center; }
  .hero__cta { justify-content: center; }
  .hero__seal { order: -1; margin-bottom: 20px; }
  .seal-medallion { width: 220px; height: 220px; }
  .seal-medallion__core { width: 150px; height: 150px; }
  .about-grid { grid-template-columns: 1fr; }
  .dept-grid { grid-template-columns: repeat(2, 1fr); }
  .id-grid { grid-template-columns: 1fr; max-width: 420px; margin: 0 auto; }
  .noticeboard__inner { grid-template-columns: 1fr; }
  .footer__grid { grid-template-columns: 1fr 1fr; }
  .dash { grid-template-columns: 1fr; }
  .dash__sidebar { display: none; }
  .card-row { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 720px) {
  .topbar__contact span:last-child { display: none; }
  .nav-toggle { display: flex; }
  .main-nav {
    position: fixed; top: 118px; left: 0; right: 0; bottom: 0; background: var(--white);
    flex-direction: column; align-items: flex-start; padding: 26px 24px; gap: 20px;
    transform: translateY(-8px); opacity: 0; pointer-events: none; transition: opacity .2s ease, transform .2s ease;
    overflow-y: auto;
  }
  .main-nav.is-open { opacity: 1; pointer-events: auto; transform: translateY(0); }
  .main-nav ul { flex-direction: column; gap: 16px; width: 100%; }
  .nav-portals { border-left: none; padding-left: 0; flex-direction: column; width: 100%; padding-top: 16px; border-top: 1px solid var(--line); }
  .stat-strip__grid { grid-template-columns: repeat(2, 1fr); }
  .stat-strip__item:nth-child(2) { border-right: none; }
  .dept-grid { grid-template-columns: 1fr; }
  .card-row { grid-template-columns: 1fr; }
  .dash__main { padding: 24px 18px; }
}

/* ---------- Scroll reveal ---------- */
.reveal { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; }
.reveal.is-visible { opacity: 1; transform: translateY(0); }
  </head>
</style>
<body>

<header class="site-header">
  <div class="wrap site-header__inner">
    <a href="index.php" class="brand">
      <span class="brand__crest" aria-hidden="true"><img src="https://cdn.corenexis.com/f/AcOsKbjd9NR.png"></span>
      <span class="brand__text">
        <strong>Panimalar Engineering College</strong>
        <small>An Autonomous Institution &middot; Estd. 2000</small>
      </span>
    </a>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
    <nav class="main-nav" id="mainNav">
      <ul>
        <li><a href="#home" class="is-active">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#departments">Departments</a></li>
        <li><a href="#admissions">Admissions</a></li>
        <li><a href="#notices">Notices</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <div class="nav-portals">
        <a href="student-login.php" class="btn btn--ghost">Student</a>
        <a href="faculty-login.php" class="btn btn--ghost">Faculty</a>
        <a href="dean-login.php" class="btn btn--ghost">HOD</a>
      </div>
    </nav>
  </div>
</header>

<!-- ================= HERO ================= -->
<section class="hero" id="home">
  <div class="wrap hero__inner">
    <div class="hero__copy">
      <span class="hero__eyebrow">NAAC A+ &middot; Autonomous Institution &middot; Affiliated to Anna University</span>
      <h1>Engineering minds that build <em>tomorrow's</em> India.</h1>
      <p class="lead">Panimalar Engineering College trains engineers, technologists and researchers through
      rigorous academics, active industry partnerships and a campus built for hands-on learning.</p>
      <div class="hero__cta">
        <a href="#admissions" class="btn btn--primary">Apply for Admission 2026</a>
        <a href="#portals" class="btn btn--outline">Access Your Portal</a>
      </div>
    </div>
    <div class="hero__seal">
      <div class="seal-medallion">
        <div class="seal-medallion__core">
          
         
        </div>
      </div>
    </div>
  </div>

  <div class="stat-strip">
    <div class="wrap stat-strip__grid">
      <div class="stat-strip__item">
        <div class="stat-strip__num" data-count="14000" data-suffix="+">0</div>
        <div class="stat-strip__label">Alumni Worldwide</div>
      </div>
      <div class="stat-strip__item">
        <div class="stat-strip__num" data-count="18">0</div>
        <div class="stat-strip__label">Departments</div>
      </div>
      <div class="stat-strip__item">
        <div class="stat-strip__num" data-count="350" data-suffix="+">0</div>
        <div class="stat-strip__label">Faculty Members</div>
      </div>
      <div class="stat-strip__item">
        <div class="stat-strip__num" data-count="94" data-suffix="%">0</div>
        <div class="stat-strip__label">Placement Rate</div>
      </div>
    </div>
  </div>
</section>

<!-- ================= ABOUT ================= -->
<section class="section section--alt" id="about">
  <div class="wrap about-grid">
    <div class="about-photo reveal"></div>
    <div class="about-copy reveal">
      <span class="eyebrow" style="font-family:var(--font-mono);font-size:.74rem;letter-spacing:.14em;text-transform:uppercase;color:var(--maroon);">About the College</span>
      <h3>A campus built on discipline, research and industry-ready skill.</h3>
      <p>Since 2010, Panimalar Engineering College has grown into one of Chennai's leading autonomous
      engineering institutions, offering undergraduate and postgraduate programmes across core and
      emerging technologies, backed by modern laboratories and an experienced faculty body.</p>
      <ul class="about-list">
        <li>NAAC A+ Accredited &amp; NBA Tier-I Approved Programmes</li>
        <li>Dedicated Placement &amp; Training Cell with 200+ Recruiters</li>
        <li>Active MoUs with Industry and Research Institutions</li>
        <li>Fully Residential Campus with Modern Infrastructure</li>
      </ul>
    </div>
  </div>
</section>

<!-- ================= DEPARTMENTS ================= -->
<section class="section" id="departments">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Academics</span>
      <h2>Departments &amp; Programmes</h2>
      <p>Undergraduate and postgraduate degrees across core, computing and emerging engineering disciplines.</p>
      <div class="rule"></div>
    </div>
    <div class="dept-grid">
      <div class="dept-card reveal"><span class="code">CSE</span><h4>Computer Science &amp; Engineering</h4><p>AI, systems and software engineering with strong industry tie-ups.</p></div>
      <div class="dept-card reveal"><span class="code">ECE</span><h4>Electronics &amp; Communication</h4><p>VLSI, embedded systems and communication technologies.</p></div>
      <div class="dept-card reveal"><span class="code">EEE</span><h4>Electrical &amp; Electronics</h4><p>Power systems, control and electrical machine design.</p></div>
      <div class="dept-card reveal"><span class="code">MECH</span><h4>Mechanical Engineering</h4><p>Design, manufacturing, thermal and robotics specialisations.</p></div>
      <div class="dept-card reveal"><span class="code">CIVIL</span><h4>Civil Engineering</h4><p>Structural, environmental and construction engineering.</p></div>
      <div class="dept-card reveal"><span class="code">IT</span><h4>Information Technology</h4><p>Data engineering, networks and enterprise applications.</p></div>
      <div class="dept-card reveal"><span class="code">AI&amp;DS</span><h4>AI &amp; Data Science</h4><p>Machine learning, analytics and data-driven systems.</p></div>
      <div class="dept-card reveal"><span class="code">CSBS</span><h4>Computer Science &amp; Business Systems</h4><p>Technology and business fundamentals combined.</p></div>
    </div>
  </div>
</section>

<!-- ================= ADMISSIONS ================= -->
<section class="section section--alt" id="admissions">
  <div class="wrap" style="display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:start;">
    <div class="reveal">
      <span class="eyebrow" style="font-family:var(--font-mono);font-size:.74rem;letter-spacing:.14em;text-transform:uppercase;color:var(--maroon);">Admissions 2026-27</span>
      <h2>How admission works</h2>
      <p>Applications are accepted through TNEA counselling for undergraduate programmes and direct
      autonomous admission for select postgraduate and lateral-entry seats.</p>
      <a href="#contact" class="btn btn--primary" style="margin-top:10px;">Download Prospectus</a>
    </div>
    <div class="timeline reveal">
      <div class="timeline__item"><span class="timeline__step">Step 01</span><h4>Online Application</h4><p>Register with academic and personal details on the admissions portal.</p></div>
      <div class="timeline__item"><span class="timeline__step">Step 02</span><h4>Document Verification</h4><p>Submit mark sheets, transfer certificate and community certificate for verification.</p></div>
      <div class="timeline__item"><span class="timeline__step">Step 03</span><h4>Counselling &amp; Seat Allotment</h4><p>Attend counselling and confirm your allotted department and seat.</p></div>
      <div class="timeline__item"><span class="timeline__step">Step 04</span><h4>Fee Payment &amp; Enrolment</h4><p>Pay fees and complete enrolment to receive your student credentials.</p></div>
    </div>
  </div>
</section>

<!-- ================= NOTICES ================= -->
<section class="section" id="notices">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Stay Updated</span>
      <h2>Notice Board</h2>
      <p>Recent announcements from the academic and examination office.</p>
      <div class="rule"></div>
    </div>
    <div class="noticeboard reveal">
      <div class="noticeboard__inner">
        <div class="pin-note"><span class="date">02 Jul 2026</span><h4>Odd Semester Timetable Released</h4><p>Department-wise timetables for 2026-27 odd semester are now available on the student portal.</p></div>
        <div class="pin-note"><span class="date">28 Jun 2026</span><h4>Faculty Development Programme</h4><p>One-week FDP on Advanced AI Systems begins 14 July, registration open on the faculty portal.</p></div>
        <div class="pin-note"><span class="date">20 Jun 2026</span><h4>Placement Drive — Infosys &amp; TCS</h4><p>Pre-placement talks scheduled for final year students; check eligibility on the notice section.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- ================= LOGIN PORTALS ================= -->
<section class="section portals" id="portals">
  <div class="wrap">
    <div class="section-head reveal">
      <span class="eyebrow">Digital Campus</span>
      <h2>One College, Three Portals</h2>
      <p>Students, faculty and the Dean's office each get a dedicated, secure login to manage academics.</p>
      <div class="rule"></div>
    </div>
    <div class="id-grid">
      <div class="id-card reveal id-card--student">
        <div class="id-card__ribbon"><strong>Student ID</strong><span>&#9679;</span></div>
        <div class="id-card__body">
          <div class="id-card__avatar">STU</div>
          <h3>Student Login</h3>
          <p>View attendance, internal marks, timetable and semester results.</p>
          <div class="id-card__strip"></div>
          <a href="student-login.php" class="btn btn--ghost btn--block">Enter Student Portal</a>
        </div>
      </div>
      <div class="id-card reveal id-card--faculty">
        <div class="id-card__ribbon"><strong>Faculty ID</strong><span>&#9679;</span></div>
        <div class="id-card__body">
          <div class="id-card__avatar">FAC</div>
          <h3>Faculty Login</h3>
          <p>Manage class attendance, upload marks and track advisee performance.</p>
          <div class="id-card__strip"></div>
          <a href="faculty-login.php" class="btn btn--ghost btn--block">Enter Faculty Portal</a>
        </div>
      </div>
      <div class="id-card reveal id-card--dean">
        <div class="id-card__ribbon"><strong>Dean ID</strong><span>&#9679;</span></div>
        <div class="id-card__body">
          <div class="id-card__avatar">DEAN</div>
          <h3>Dean Login</h3>
          <p>Institution-wide oversight of departments, faculty and academic performance.</p>
          <div class="id-card__strip"></div>
          <a href="dean-login.php" class="btn btn--ghost btn--block">Enter Dean Portal</a>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="site-footer" id="contact">
  <div class="wrap footer__grid">
    <div class="footer__col">
      <span class="brand__crest" aria-hidden="true">PEC</span>
      <p>Panimalar Engineering College is an autonomous, NAAC A+ accredited institution committed to
      engineering education, research and holistic student development.</p>
    </div>
    <div class="footer__col">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="#about">About the College</a></li>
        <li><a href="#departments">Departments</a></li>
        <li><a href="#admissions">Admissions</a></li>
        <li><a href="#notices">Notice Board</a></li>
      </ul>
    </div>
    <div class="footer__col">
      <h4>Portals</h4>
      <ul>
        <li><a href="student-login.php">Student Login</a></li>
        <li><a href="faculty-login.php">Faculty Login</a></li>
        <li><a href="dean-login.php">Dean Login</a></li>
      </ul>
    </div>
    <div class="footer__col">
      <h4>Reach Us</h4>
      <address>
        Bangalore Trunk Road, Varadharajapuram, Poonamallee, Chennai - 600 123<br>
        Phone: +91 44-2680 1999<br>
        Email: info@panimalar.ac.in
      </address>
    </div>
  </div>
  <div class="footer__bottom wrap">
    <p>&copy; 2026 Panimalar Engineering College. All rights reserved.</p>
    <p>Designed for demonstration purposes.</p>
  </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
