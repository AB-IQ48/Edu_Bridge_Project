<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EduBridge — Verified Education Consultancy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --ink: #0d1117;
      --ink-soft: #1e2530;
      --cream: #f5f0e8;
      --cream-dark: #ede7d9;
      --gold: #c8a84b;
      --gold-light: #e8d49a;
      --sage: #4a7c6b;
      --sage-light: #7ab3a0;
      --white: #ffffff;
      --muted: #6b7280;
      --danger: #dc2626;
      --font-serif: 'Fraunces', Georgia, serif;
      --font-sans: 'DM Sans', sans-serif;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: var(--font-sans);
      background: var(--cream);
      color: var(--ink);
      overflow-x: hidden;
    }

    /* ── HEADER ── */
    header {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      padding: 20px 0;
      transition: background 0.3s, box-shadow 0.3s;
    }
    header.scrolled {
      background: rgba(245,240,232,0.95);
      backdrop-filter: blur(12px);
      box-shadow: 0 1px 0 rgba(0,0,0,0.08);
    }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 32px; }
    .header-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .logo {
      font-family: var(--font-serif);
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--ink);
      text-decoration: none;
      letter-spacing: -0.02em;
    }
    .logo span { color: var(--sage); }
    nav { display: flex; align-items: center; gap: 36px; }
    nav a {
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--ink);
      text-decoration: none;
      letter-spacing: 0.01em;
      transition: color 0.2s;
    }
    nav a:hover { color: var(--sage); }
    .nav-cta {
      background: var(--ink);
      color: var(--white) !important;
      padding: 10px 22px;
      border-radius: 2px;
      font-size: 0.8rem !important;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      transition: background 0.2s !important;
    }
    .nav-cta:hover { background: var(--sage) !important; color: var(--white) !important; }

    /* ── HERO ── */
    .hero {
      min-height: 100vh;
      display: grid;
      grid-template-columns: 1fr 1fr;
      position: relative;
      overflow: hidden;
    }
    .hero-left {
      background: var(--ink);
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 140px 64px 80px;
      position: relative;
      overflow: hidden;
    }
    .hero-left::before {
      content: '';
      position: absolute;
      top: -100px; right: -100px;
      width: 400px; height: 400px;
      background: radial-gradient(circle, rgba(74,124,107,0.3) 0%, transparent 70%);
      pointer-events: none;
    }
    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(200,168,75,0.15);
      border: 1px solid rgba(200,168,75,0.3);
      color: var(--gold);
      font-size: 0.72rem;
      font-weight: 500;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 6px 14px;
      border-radius: 2px;
      margin-bottom: 40px;
      width: fit-content;
    }
    .hero-badge::before {
      content: '';
      width: 6px; height: 6px;
      background: var(--gold);
      border-radius: 50%;
      animation: pulse 2s infinite;
    }
    @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.4;transform:scale(0.8)} }
    .hero-h1 {
      font-family: var(--font-serif);
      font-size: clamp(3rem, 5vw, 4.5rem);
      font-weight: 300;
      color: var(--white);
      line-height: 1.1;
      letter-spacing: -0.03em;
      margin-bottom: 32px;
    }
    .hero-h1 em {
      font-style: italic;
      color: var(--gold-light);
    }
    .hero-sub {
      color: rgba(255,255,255,0.55);
      font-size: 1rem;
      line-height: 1.7;
      max-width: 380px;
      margin-bottom: 48px;
    }
    .hero-actions { display: flex; gap: 16px; flex-wrap: wrap; }
    .btn-primary-hero {
      background: var(--gold);
      color: var(--ink);
      text-decoration: none;
      padding: 14px 32px;
      font-size: 0.85rem;
      font-weight: 500;
      letter-spacing: 0.04em;
      border-radius: 2px;
      transition: background 0.2s, transform 0.2s;
    }
    .btn-primary-hero:hover { background: var(--gold-light); transform: translateY(-1px); }
    .btn-ghost-hero {
      border: 1px solid rgba(255,255,255,0.25);
      color: rgba(255,255,255,0.75);
      text-decoration: none;
      padding: 14px 32px;
      font-size: 0.85rem;
      font-weight: 500;
      letter-spacing: 0.04em;
      border-radius: 2px;
      transition: border-color 0.2s, color 0.2s;
    }
    .btn-ghost-hero:hover { border-color: rgba(255,255,255,0.6); color: var(--white); }
    .hero-right {
      background: var(--cream-dark);
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 140px 64px 80px;
      position: relative;
    }
    .trust-score-card {
      background: var(--white);
      border: 1px solid rgba(0,0,0,0.08);
      border-radius: 4px;
      padding: 32px;
      margin-bottom: 32px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.06);
      animation: floatUp 0.8s ease 0.3s both;
    }
    @keyframes floatUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
    .trust-label {
      font-size: 0.72rem;
      font-weight: 500;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 16px;
    }
    .trust-score-row { display: flex; align-items: center; gap: 20px; margin-bottom: 20px; }
    .score-circle {
      width: 72px; height: 72px;
      border-radius: 50%;
      background: conic-gradient(var(--sage) 0deg 306deg, #e5e7eb 306deg);
      display: flex; align-items: center; justify-content: center;
      position: relative;
    }
    .score-circle::after {
      content: '';
      position: absolute;
      width: 54px; height: 54px;
      background: var(--white);
      border-radius: 50%;
    }
    .score-num {
      position: relative;
      z-index: 1;
      font-family: var(--font-serif);
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--ink);
    }
    .score-meta h4 { font-size: 1rem; font-weight: 500; margin-bottom: 4px; }
    .score-meta p { font-size: 0.8rem; color: var(--muted); }
    .score-bars { display: flex; flex-direction: column; gap: 10px; }
    .score-bar-row { display: flex; align-items: center; gap: 10px; }
    .score-bar-label { font-size: 0.75rem; color: var(--muted); width: 110px; flex-shrink: 0; }
    .score-bar-track { flex: 1; height: 4px; background: #e5e7eb; border-radius: 2px; overflow: hidden; }
    .score-bar-fill { height: 100%; border-radius: 2px; background: var(--sage); transition: width 1s ease; }
    .score-bar-val { font-size: 0.75rem; font-weight: 500; color: var(--ink); width: 28px; text-align: right; }
    .hero-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .stat-tile {
      background: var(--white);
      border: 1px solid rgba(0,0,0,0.08);
      border-radius: 4px;
      padding: 20px;
      animation: floatUp 0.8s ease both;
    }
    .stat-tile:nth-child(2){animation-delay:0.1s}
    .stat-tile:nth-child(3){animation-delay:0.2s}
    .stat-tile:nth-child(4){animation-delay:0.3s}
    .stat-num {
      font-family: var(--font-serif);
      font-size: 2rem;
      font-weight: 600;
      color: var(--ink);
      line-height: 1;
      margin-bottom: 6px;
    }
    .stat-desc { font-size: 0.78rem; color: var(--muted); line-height: 1.4; }

    /* ── SECTION BASE ── */
    section { padding: 100px 0; }
    .section-eyebrow {
      display: flex; align-items: center; gap: 12px;
      margin-bottom: 24px;
    }
    .eyebrow-num {
      font-family: var(--font-serif);
      font-size: 0.75rem;
      color: var(--muted);
      font-style: italic;
    }
    .eyebrow-line { flex: 0 0 40px; height: 1px; background: var(--muted); }
    .eyebrow-tag {
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--muted);
      font-weight: 500;
    }
    .section-title {
      font-family: var(--font-serif);
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 400;
      line-height: 1.15;
      letter-spacing: -0.02em;
      margin-bottom: 20px;
    }
    .section-sub { font-size: 1.05rem; color: var(--muted); line-height: 1.7; max-width: 520px; }

    /* ── HOW IT WORKS ── */
    .how-it-works { background: var(--white); }
    .steps-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 1px; background: rgba(0,0,0,0.08); margin-top: 64px; }
    .step {
      background: var(--white);
      padding: 40px 32px;
      transition: background 0.2s;
    }
    .step:hover { background: var(--cream); }
    .step-num {
      font-family: var(--font-serif);
      font-size: 3rem;
      font-weight: 300;
      color: rgba(0,0,0,0.08);
      line-height: 1;
      margin-bottom: 24px;
    }
    .step-icon {
      width: 48px; height: 48px;
      background: var(--sage);
      border-radius: 2px;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 20px;
    }
    .step-icon svg { width: 22px; height: 22px; color: var(--white); fill: none; stroke: currentColor; stroke-width: 2; }
    .step h3 { font-size: 1.05rem; font-weight: 500; margin-bottom: 12px; }
    .step p { font-size: 0.875rem; color: var(--muted); line-height: 1.6; }

    /* ── VERIFICATION ── */
    .verification { background: var(--ink); }
    .verification .section-title { color: var(--white); }
    .verification .section-sub { color: rgba(255,255,255,0.5); }
    .verification .eyebrow-tag { color: rgba(255,255,255,0.4); }
    .verification .eyebrow-line { background: rgba(255,255,255,0.3); }
    .verification .eyebrow-num { color: rgba(255,255,255,0.3); }
    .veri-grid {
      display: grid; grid-template-columns: 1fr 1fr;
      gap: 48px; margin-top: 64px; align-items: center;
    }
    .veri-checks { display: flex; flex-direction: column; gap: 0; }
    .veri-check {
      display: flex; align-items: flex-start; gap: 20px;
      padding: 28px 0;
      border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    .veri-check:first-child { padding-top: 0; }
    .check-badge {
      flex-shrink: 0;
      width: 36px; height: 36px;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.75rem;
      font-weight: 600;
    }
    .check-badge.verified { background: rgba(74,124,107,0.2); color: var(--sage-light); }
    .check-badge.pending { background: rgba(200,168,75,0.15); color: var(--gold); }
    .check-badge.failed { background: rgba(220,38,38,0.15); color: #f87171; }
    .veri-check h4 { font-size: 0.95rem; font-weight: 500; color: var(--white); margin-bottom: 6px; }
    .veri-check p { font-size: 0.82rem; color: rgba(255,255,255,0.45); line-height: 1.5; }
    .veri-visual {
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 4px;
      padding: 40px;
    }
    .veri-visual-title {
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: rgba(255,255,255,0.4);
      margin-bottom: 28px;
    }
    .counsellor-card-demo {
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 4px;
      padding: 24px;
      margin-bottom: 16px;
    }
    .counsellor-head { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; }
    .counsellor-avatar {
      width: 48px; height: 48px;
      background: var(--sage);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-family: var(--font-serif);
      font-size: 1.1rem;
      color: var(--white);
      font-weight: 600;
    }
    .counsellor-name { font-size: 0.95rem; color: var(--white); font-weight: 500; }
    .counsellor-org { font-size: 0.78rem; color: rgba(255,255,255,0.45); }
    .badge-verified-full {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(74,124,107,0.2);
      border: 1px solid rgba(74,124,107,0.4);
      color: var(--sage-light);
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      padding: 4px 10px;
      border-radius: 20px;
    }
    .counsellor-metrics { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px; }
    .metric { text-align: center; }
    .metric-val { font-family: var(--font-serif); font-size: 1.2rem; color: var(--white); font-weight: 600; }
    .metric-key { font-size: 0.7rem; color: rgba(255,255,255,0.4); margin-top: 2px; }

    /* ── VISA READINESS ── */
    .visa-readiness { background: var(--cream-dark); }
    .visa-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; margin-top: 64px; align-items: start; }
    .visa-factors { display: flex; flex-direction: column; gap: 20px; }
    .factor-card {
      background: var(--white);
      border: 1px solid rgba(0,0,0,0.08);
      border-radius: 4px;
      padding: 24px;
    }
    .factor-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
    .factor-name { font-size: 0.9rem; font-weight: 500; }
    .factor-score { font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; }
    .factor-score.high { color: var(--sage); }
    .factor-score.mid { color: var(--gold); }
    .factor-score.low { color: var(--danger); }
    .factor-bar { height: 6px; background: #e5e7eb; border-radius: 3px; overflow: hidden; }
    .factor-bar-fill { height: 100%; border-radius: 3px; transition: width 1.2s ease; }
    .fill-high { background: var(--sage); }
    .fill-mid { background: var(--gold); }
    .fill-low { background: var(--danger); }
    .factor-note { font-size: 0.75rem; color: var(--muted); margin-top: 8px; }
    .visa-info { position: sticky; top: 120px; }
    .visa-total {
      background: var(--ink);
      border-radius: 4px;
      padding: 40px;
      margin-bottom: 24px;
      text-align: center;
    }
    .visa-score-big {
      font-family: var(--font-serif);
      font-size: 5rem;
      font-weight: 300;
      color: var(--white);
      line-height: 1;
      margin-bottom: 8px;
    }
    .visa-score-label { color: rgba(255,255,255,0.5); font-size: 0.875rem; margin-bottom: 24px; }
    .visa-verdict {
      display: inline-block;
      background: rgba(74,124,107,0.2);
      border: 1px solid rgba(74,124,107,0.4);
      color: var(--sage-light);
      padding: 8px 20px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
      letter-spacing: 0.04em;
    }
    .visa-tips { display: flex; flex-direction: column; gap: 12px; }
    .tip {
      display: flex; align-items: flex-start; gap: 12px;
      background: var(--white);
      border: 1px solid rgba(0,0,0,0.08);
      border-radius: 4px;
      padding: 16px;
    }
    .tip-icon { color: var(--sage); flex-shrink: 0; margin-top: 1px; }
    .tip p { font-size: 0.82rem; color: var(--muted); line-height: 1.5; }

    /* ── TRUST ── */
    .trust-section { background: var(--white); }
    .trust-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2px; background: rgba(0,0,0,0.06); margin-top: 64px; }
    .trust-item {
      background: var(--white);
      padding: 48px 40px;
      transition: background 0.2s;
    }
    .trust-item:hover { background: var(--cream); }
    .trust-item-num {
      font-family: var(--font-serif);
      font-size: 2.5rem;
      font-weight: 300;
      color: var(--sage);
      margin-bottom: 12px;
    }
    .trust-item h3 { font-size: 1.05rem; font-weight: 500; margin-bottom: 12px; }
    .trust-item p { font-size: 0.875rem; color: var(--muted); line-height: 1.6; }

    /* ── FOR WHO ── */
    .for-who { background: var(--cream-dark); }
    .roles-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2px; background: rgba(0,0,0,0.06); margin-top: 64px; }
    .role-card {
      background: var(--cream-dark);
      padding: 56px 48px;
      transition: background 0.2s;
      cursor: default;
    }
    .role-card:hover { background: var(--white); }
    .role-label {
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--muted);
      font-weight: 500;
      margin-bottom: 20px;
    }
    .role-title {
      font-family: var(--font-serif);
      font-size: 1.6rem;
      font-weight: 400;
      margin-bottom: 20px;
    }
    .role-desc { font-size: 0.9rem; color: var(--muted); line-height: 1.7; margin-bottom: 32px; }
    .role-features { display: flex; flex-direction: column; gap: 10px; }
    .role-feature {
      display: flex; align-items: center; gap: 10px;
      font-size: 0.85rem; color: var(--ink);
    }
    .role-feature::before {
      content: '';
      width: 6px; height: 6px;
      background: var(--sage);
      border-radius: 50%;
      flex-shrink: 0;
    }
    .role-cta {
      display: inline-block;
      margin-top: 32px;
      font-size: 0.82rem;
      font-weight: 500;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      color: var(--sage);
      text-decoration: none;
      border-bottom: 1px solid var(--sage);
      padding-bottom: 2px;
      transition: color 0.2s, border-color 0.2s;
    }
    .role-cta:hover { color: var(--ink); border-color: var(--ink); }

    /* ── TESTIMONIALS ── */
    .testimonials { background: var(--ink); padding: 100px 0; }
    .testimonials .section-title { color: var(--white); }
    .testimonials .section-sub { color: rgba(255,255,255,0.5); }
    .testimonials .eyebrow-tag { color: rgba(255,255,255,0.4); }
    .testimonials .eyebrow-line { background: rgba(255,255,255,0.3); }
    .testimonials .eyebrow-num { color: rgba(255,255,255,0.3); }
    .testi-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-top: 56px; }
    .testi-card {
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 4px;
      padding: 32px;
    }
    .testi-stars { display: flex; gap: 3px; margin-bottom: 20px; }
    .testi-stars span { color: var(--gold); font-size: 0.85rem; }
    .testi-text {
      font-family: var(--font-serif);
      font-style: italic;
      font-size: 1rem;
      color: rgba(255,255,255,0.8);
      line-height: 1.6;
      margin-bottom: 28px;
    }
    .testi-author { display: flex; align-items: center; gap: 12px; }
    .testi-avatar {
      width: 40px; height: 40px;
      border-radius: 50%;
      background: var(--sage);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.8rem; font-weight: 600; color: var(--white);
    }
    .testi-name { font-size: 0.875rem; font-weight: 500; color: var(--white); }
    .testi-from { font-size: 0.75rem; color: rgba(255,255,255,0.4); }

    /* ── FAQ ── */
    .faq { background: var(--white); }
    .faq-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 80px; margin-top: 64px; align-items: start; }
    .faq-side { position: sticky; top: 120px; }
    .faq-side-note { font-size: 0.875rem; color: var(--muted); line-height: 1.7; margin-top: 20px; }
    .faq-items { display: flex; flex-direction: column; }
    .faq-item { border-top: 1px solid rgba(0,0,0,0.08); }
    .faq-item:last-child { border-bottom: 1px solid rgba(0,0,0,0.08); }
    .faq-q {
      display: flex; justify-content: space-between; align-items: center;
      padding: 24px 0;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 500;
      gap: 20px;
    }
    .faq-q:hover { color: var(--sage); }
    .faq-toggle { width: 24px; height: 24px; flex-shrink: 0; position: relative; }
    .faq-toggle::before, .faq-toggle::after {
      content: '';
      position: absolute;
      background: currentColor;
      transition: transform 0.3s, opacity 0.3s;
    }
    .faq-toggle::before { top: 50%; left: 4px; right: 4px; height: 1px; transform: translateY(-50%); }
    .faq-toggle::after { left: 50%; top: 4px; bottom: 4px; width: 1px; transform: translateX(-50%); }
    .faq-item.open .faq-toggle::after { transform: translateX(-50%) rotate(90deg); opacity: 0; }
    .faq-a {
      padding: 0 0 24px;
      font-size: 0.9rem;
      color: var(--muted);
      line-height: 1.7;
      display: none;
    }
    .faq-item.open .faq-a { display: block; }

    /* ── CTA ── */
    .cta-section {
      background: var(--sage);
      padding: 100px 0;
      text-align: center;
    }
    .cta-section h2 {
      font-family: var(--font-serif);
      font-size: clamp(2.5rem, 5vw, 4rem);
      font-weight: 300;
      color: var(--white);
      margin-bottom: 20px;
      letter-spacing: -0.02em;
    }
    .cta-section p { color: rgba(255,255,255,0.7); font-size: 1.05rem; margin-bottom: 48px; }
    .cta-actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
    .cta-btn-white {
      background: var(--white);
      color: var(--sage);
      text-decoration: none;
      padding: 16px 40px;
      font-size: 0.875rem;
      font-weight: 500;
      letter-spacing: 0.04em;
      border-radius: 2px;
      transition: background 0.2s, transform 0.2s;
    }
    .cta-btn-white:hover { background: var(--cream); transform: translateY(-2px); }
    .cta-btn-outline {
      border: 1px solid rgba(255,255,255,0.4);
      color: var(--white);
      text-decoration: none;
      padding: 16px 40px;
      font-size: 0.875rem;
      font-weight: 500;
      letter-spacing: 0.04em;
      border-radius: 2px;
      transition: border-color 0.2s, background 0.2s;
    }
    .cta-btn-outline:hover { border-color: rgba(255,255,255,0.8); background: rgba(255,255,255,0.08); }

    /* ── FOOTER ── */
    footer {
      background: var(--ink);
      padding: 80px 0 40px;
      border-top: 1px solid rgba(255,255,255,0.06);
    }
    .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 60px; margin-bottom: 60px; }
    .footer-brand .logo { display: block; margin-bottom: 16px; }
    .footer-tagline { font-size: 0.875rem; color: rgba(255,255,255,0.4); line-height: 1.6; max-width: 280px; }
    .footer-col-title {
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: rgba(255,255,255,0.4);
      font-weight: 500;
      margin-bottom: 20px;
    }
    .footer-links { display: flex; flex-direction: column; gap: 10px; }
    .footer-links a { font-size: 0.875rem; color: rgba(255,255,255,0.6); text-decoration: none; transition: color 0.2s; }
    .footer-links a:hover { color: var(--white); }
    .footer-bottom {
      border-top: 1px solid rgba(255,255,255,0.06);
      padding-top: 32px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .footer-copy { font-size: 0.8rem; color: rgba(255,255,255,0.3); }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
      .hero { grid-template-columns: 1fr; min-height: auto; }
      .hero-left { padding: 120px 40px 60px; }
      .hero-right { padding: 60px 40px; }
      .steps-grid { grid-template-columns: 1fr 1fr; }
      .veri-grid, .visa-grid, .testi-grid { grid-template-columns: 1fr; }
      .roles-grid { grid-template-columns: 1fr; }
      .footer-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 768px) {
      nav { display: none; }
      .steps-grid { grid-template-columns: 1fr; }
      .trust-grid { grid-template-columns: 1fr; }
      .faq-grid { grid-template-columns: 1fr; }
      .faq-side { position: static; }
      .footer-grid { grid-template-columns: 1fr; }
      .footer-bottom { flex-direction: column; gap: 16px; }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header id="header">
    <div class="container">
      <div class="header-inner">
        <a href="#" class="logo">Edu<span>Bridge</span></a>
        <nav>
          <a href="#how-it-works">How It Works</a>
          <a href="#verification">Verification</a>
          <a href="#visa-readiness">Visa Readiness</a>
          <a href="#for-who">For You</a>
          <a href="#faq">FAQ</a>
          <a href="#contact" class="nav-cta">Get Started</a>
        </nav>
      </div>
    </div>
  </header>


  <div class = "content">
    @yield('content')
</div>


  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="#" class="logo">Edu<span>Bridge</span></a>
          <p class="footer-tagline" style="margin-top:16px">Transparent, verified, and accountable overseas education guidance — eliminating fraud from the study abroad process.</p>
        </div>
        <div>
          <div class="footer-col-title">Platform</div>
          <div class="footer-links">
            <a href="#how-it-works">How It Works</a>
            <a href="#verification">Verification</a>
            <a href="#visa-readiness">Visa Readiness</a>
            <a href="#for-who">For Students</a>
            <a href="#for-who">For Counsellors</a>
          </div>
        </div>
        <div>
          <div class="footer-col-title">Company</div>
          <div class="footer-links">
            <a href="#">About EduBridge</a>
            <a href="#">Research</a>
            <a href="#faq">FAQ</a>
            <a href="#">Contact</a>
          </div>
        </div>
        <div>
          <div class="footer-col-title">Legal</div>
          <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Data Security</a>
            <a href="#">Complaint Policy</a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="footer-copy">© 2026 EduBridge. All rights reserved.</div>
        <div class="footer-copy">Protecting students through verified digital governance.</div>
      </div>
    </div>
  </footer>

  <script>
    // Header scroll
    const header = document.getElementById('header');
    window.addEventListener('scroll', () => {
      header.classList.toggle('scrolled', window.scrollY > 40);
    });

    // Animate score bars on scroll
    const bars = document.querySelectorAll('.score-bar-fill, .factor-bar-fill');
    const obs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) { e.target.style.width = e.target.style.width; obs.unobserve(e.target); }
      });
    }, { threshold: 0.3 });
    bars.forEach(b => obs.observe(b));

    // FAQ already handled with CSS toggle via JS onclick
  </script>
</body>
</html>