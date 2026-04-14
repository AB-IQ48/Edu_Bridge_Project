        :root {
            --ink: #0d1117;
            --cream: #f5f0e8;
            --white: #ffffff;
            --muted: #6b7280;
            --sage: #4a7c6b;
            --sage-light: #7ab3a0;
            --gold: #c8a84b;
            --coral: #e07a5f;
            --sky: #3b82f6;
            --violet: #7c3aed;
            --danger: #dc2626;
            --success: #16a34a;
            --font-sans: 'DM Sans', system-ui, sans-serif;
            --font-serif: 'Fraunces', Georgia, serif;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: var(--font-sans);
            color: var(--ink);
            min-height: 100vh;
            background:
                radial-gradient(1200px 600px at 10% -10%, rgba(74,124,107,0.18), transparent 50%),
                radial-gradient(900px 500px at 100% 0%, rgba(200,168,75,0.15), transparent 45%),
                radial-gradient(800px 400px at 50% 100%, rgba(224,122,95,0.1), transparent 50%),
                linear-gradient(165deg, #f0ebe3 0%, var(--cream) 40%, #eef5f1 100%);
        }
        a { color: var(--sage); text-decoration: none; font-weight: 500; }
        a:hover { text-decoration: underline; color: #3d6b5c; }
        .wrap {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 28px 16px 40px;
        }
        .card {
            width: 100%;
            max-width: 520px;
            background: var(--white);
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 16px;
            padding: 28px 26px 26px;
            box-shadow:
                0 4px 6px -1px rgba(0,0,0,0.06),
                0 20px 40px -12px rgba(13,17,23,0.12);
        }
        .card.card--wide { max-width: 760px; }
        .card.card--xl { max-width: 960px; }
        h1 {
            margin: 0 0 8px;
            font-size: 1.45rem;
            font-family: var(--font-serif);
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--ink);
        }
        .sub { margin: 0 0 18px; color: var(--muted); font-size: 0.95rem; line-height: 1.55; }
        .role-badge-inline {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--sage);
            background: rgba(74,124,107,0.12);
            padding: 4px 10px;
            border-radius: 999px;
        }
        .trust-note {
            font-size: 0.8rem;
            color: var(--muted);
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid rgba(0,0,0,0.08);
            line-height: 1.45;
        }
        .grid { display: grid; gap: 14px; }
        label { font-size: 0.88rem; font-weight: 600; color: var(--ink); }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 11px 14px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.12);
            background: #fafafa;
            outline: none;
            font-family: var(--font-sans);
            font-size: 0.92rem;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }
        input:focus, select:focus, textarea:focus {
            border-color: rgba(74,124,107,0.65);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(74,124,107,0.14);
        }
        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
        }
        textarea { min-height: 100px; resize: vertical; }
        .row { display: grid; gap: 14px; grid-template-columns: 1fr 1fr; }
        @media (max-width: 560px) { .row { grid-template-columns: 1fr; } }
        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 13px 18px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #1a2332 0%, var(--ink) 100%);
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(13,17,23,0.25);
            transition: transform 0.15s, box-shadow 0.2s, opacity 0.2s;
        }
        .btn:hover {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(13,17,23,0.28);
        }
        .btn--sage {
            background: linear-gradient(135deg, #5a9480 0%, var(--sage) 100%);
            box-shadow: 0 4px 14px rgba(74,124,107,0.35);
        }
        .btn--gold {
            background: linear-gradient(135deg, #d4b86a 0%, var(--gold) 100%);
            color: #1a1508;
            box-shadow: 0 4px 14px rgba(200,168,75,0.35);
        }
        .btn--ghost {
            background: #fff;
            color: var(--ink);
            border: 1px solid rgba(0,0,0,0.14);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .btn--ghost:hover { background: #f8fafc; }
        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-bottom: 16px;
            line-height: 1.45;
            position: relative;
            overflow: hidden;
        }
        .alert::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: currentColor;
            opacity: .7;
        }
        .alert--error {
            background: rgba(220,38,38,0.08);
            border: 1px solid rgba(220,38,38,0.22);
            color: #b91c1c;
        }
        .alert--success {
            background: rgba(22,163,74,0.1);
            border: 1px solid rgba(22,163,74,0.25);
            color: #15803d;
        }
        .alert--error ul { margin: 0; padding-left: 18px; }
        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 999px;
            padding: 5px 10px;
            font-size: .74rem;
            font-weight: 700;
            letter-spacing: .02em;
        }
        .chip--ok { background: rgba(22,163,74,.12); color: #166534; }
        .chip--warn { background: rgba(234,179,8,.16); color: #92400e; }
        .chip--danger { background: rgba(220,38,38,.12); color: #991b1b; }
        .chip--muted { background: rgba(100,116,139,.14); color: #334155; }
        .panel {
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 14px;
            background: linear-gradient(180deg, #fff, #fbfbfb);
            box-shadow: 0 8px 22px rgba(0,0,0,0.05);
            padding: 14px;
        }
        .stat-mini-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            margin: 14px 0 18px;
        }
        .stat-mini {
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.08);
            background: #fff;
            padding: 12px;
        }
        .stat-mini .num {
            font-size: 1.3rem;
            font-weight: 800;
            line-height: 1.1;
        }
        .stat-mini .lbl {
            font-size: .78rem;
            color: var(--muted);
            margin-top: 3px;
        }
        .toplinks {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 10px 16px;
            margin-top: 18px;
            font-size: 0.9rem;
        }
        .toplinks a:not(.eb-back) {
            padding: 8px 12px;
            border-radius: 999px;
            border: 1px solid rgba(0,0,0,0.12);
            background: #fff;
        }
        .toplinks a:not(.eb-back):hover { border-color: rgba(74,124,107,.45); text-decoration: none; background: rgba(74,124,107,.05); }
        .hint { color: var(--muted); font-size: 0.86rem; margin-top: 4px; line-height: 1.45; }
        .inline { display: flex; align-items: center; gap: 10px; }
        /* Complaints UI */
        .eb-complaints-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
        }
        .eb-complaints-list {
            display: grid;
            gap: 12px;
            margin: 0;
            padding: 0;
        }
        .eb-complaint-card {
            display: block;
            padding: 16px 18px;
            border-radius: 14px;
            border: 1px solid rgba(0,0,0,0.08);
            background: #fff;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 6px 18px rgba(0,0,0,0.05);
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
        }
        .eb-complaint-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
            border-color: rgba(74,124,107,0.28);
        }
        .eb-complaint-top {
            display: flex;
            gap: 12px;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
        }
        .eb-complaint-title {
            font-weight: 800;
            color: var(--ink);
            line-height: 1.25;
        }
        .eb-complaint-meta {
            font-size: 0.84rem;
            color: var(--muted);
            margin-top: 6px;
            line-height: 1.4;
        }
        .eb-complaint-body {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid rgba(0,0,0,0.06);
            color: #374151;
            font-size: 0.9rem;
            line-height: 1.55;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .eb-complaint-box {
            padding: 16px;
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.08);
            background: #fafafa;
            margin-bottom: 16px;
        }
        .eb-complaint-box--response {
            border-color: rgba(74,124,107,0.25);
            background: rgba(74,124,107,0.06);
        }
        .eb-complaint-box__label {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--muted);
            margin-bottom: 8px;
        }
        .eb-complaint-box--response .eb-complaint-box__label { color: var(--sage, #4a7c6b); }
        .eb-complaint-box__text { white-space: pre-wrap; font-size: 0.92rem; line-height: 1.6; }
        .eb-complaint-note { color: var(--muted); font-size: 0.9rem; margin-bottom: 16px; }
        /* Form section cards (visa assess) */
        .form-section {
            margin-bottom: 22px;
            padding: 18px 18px 4px;
            border-radius: 14px;
            border: 1px solid rgba(0,0,0,0.06);
            background: linear-gradient(180deg, #fafafa 0%, #fff 100%);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .form-section__head {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }
        .form-section__icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }
        .form-section__title { font-weight: 700; font-size: 1.02rem; margin: 0 0 4px; }
        .form-section__sub { font-size: 0.85rem; color: var(--muted); margin: 0; }
        .q-block { margin-bottom: 16px; }
        .q-block label.q-label { display: block; margin-bottom: 10px; font-weight: 600; line-height: 1.4; }
        .radio-grid { display: flex; flex-direction: column; gap: 8px; }
        .radio-option {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 2px solid rgba(0,0,0,0.08);
            background: var(--white);
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }
        .radio-option:hover { border-color: rgba(74,124,107,0.35); background: rgba(74,124,107,0.04); }
        .radio-option input { margin-top: 3px; accent-color: var(--sage); }
        .radio-option span { font-size: 0.9rem; font-weight: 500; color: #374151; }
        /* Score input pills */
        .score-field {
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.08);
            background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(245,240,232,0.5));
        }
        .score-field label { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
        .score-field .tag {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 2px 8px;
            border-radius: 6px;
            color: #fff;
        }
        .flash-stack {
            position: fixed;
            top: 14px;
            right: 14px;
            z-index: 1000;
            display: grid;
            gap: 8px;
            width: min(92vw, 380px);
        }
        .flash-toast {
            border-radius: 10px;
            padding: 11px 12px 11px 14px;
            border: 1px solid rgba(0,0,0,.12);
            box-shadow: 0 10px 24px rgba(0,0,0,.15);
            background: #fff;
            font-size: .9rem;
            line-height: 1.35;
            position: relative;
            overflow: hidden;
            animation: flashIn .2s ease;
        }
        .flash-toast::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: currentColor;
            opacity: .7;
        }
        .flash-toast--success { color: #166534; background: #f0fdf4; border-color: rgba(22,163,74,.28); }
        .flash-toast--error { color: #b91c1c; background: #fef2f2; border-color: rgba(220,38,38,.28); }
        .flash-toast--info { color: #1d4ed8; background: #eff6ff; border-color: rgba(59,130,246,.3); }
        @keyframes flashIn {
            from { opacity: 0; transform: translateY(-6px) scale(.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
