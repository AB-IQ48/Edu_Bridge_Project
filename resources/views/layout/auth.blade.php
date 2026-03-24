<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Auth')</title>
    <style>
        :root {
            --ink: #0d1117;
            --cream: #f5f0e8;
            --white: #ffffff;
            --muted: #6b7280;
            --sage: #4a7c6b;
            --danger: #dc2626;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: var(--cream);
            color: var(--ink);
        }
        a { color: var(--sage); text-decoration: none; }
        a:hover { text-decoration: underline; }
        .wrap { min-height: 100vh; display: grid; place-items: center; padding: 28px 16px; }
        .card {
            width: 100%;
            max-width: 520px;
            background: var(--white);
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 10px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }
        h1 { margin: 0 0 8px; font-size: 1.35rem; }
        .sub { margin: 0 0 18px; color: var(--muted); font-size: 0.95rem; }
        .role-badge-inline { display: inline-block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--sage); background: rgba(74,124,107,0.12); padding: 2px 8px; border-radius: 4px; }
        .trust-note { font-size: 0.8rem; color: var(--muted); margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(0,0,0,0.08); }
        .grid { display: grid; gap: 12px; }
        label { font-size: 0.9rem; font-weight: 600; }
        input, textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid rgba(0,0,0,0.14);
            background: #fff;
            outline: none;
        }
        textarea { min-height: 90px; resize: vertical; }
        input:focus, textarea:focus { border-color: rgba(74,124,107,0.7); box-shadow: 0 0 0 3px rgba(74,124,107,0.15); }
        .row { display: grid; gap: 12px; grid-template-columns: 1fr 1fr; }
        @media (max-width: 560px) { .row { grid-template-columns: 1fr; } }
        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 11px 14px;
            border-radius: 8px;
            border: 1px solid rgba(0,0,0,0.14);
            background: var(--ink);
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }
        .btn:hover { opacity: 0.92; }
        .error {
            background: rgba(220,38,38,0.08);
            border: 1px solid rgba(220,38,38,0.25);
            color: var(--danger);
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 0.92rem;
        }
        .error ul { margin: 0; padding-left: 18px; }
        .toplinks { display:flex; justify-content: space-between; gap: 12px; margin-top: 14px; font-size: 0.95rem; flex-wrap: wrap; }
        .hint { color: var(--muted); font-size: 0.88rem; margin-top: 6px; }
        .inline { display:flex; align-items:center; gap: 10px; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        @yield('content')
        @hasSection('trust_footer')
            <p class="trust-note">@yield('trust_footer')</p>
        @else
            <p class="trust-note">Secure, role-based access. No opaque AI — transparent verification and rule-based scoring.</p>
        @endif
    </div>
</div>
</body>
</html>

