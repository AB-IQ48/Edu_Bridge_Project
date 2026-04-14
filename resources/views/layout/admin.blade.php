<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | EduBridge</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0d1117;
            --ink-soft: #1e2530;
            --cream: #f5f0e8;
            --white: #ffffff;
            --muted: #6b7280;
            --sage: #4a7c6b;
            --sage-light: #7ab3a0;
            --gold: #c8a84b;
            --danger: #dc2626;
            --success: #16a34a;
            --font-sans: 'DM Sans', sans-serif;
            --sidebar-w: 240px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-sans); background: var(--cream); color: var(--ink); min-height: 100vh; }
        .admin-wrap { display: flex; min-height: 100vh; }
        .admin-sidebar {
            width: var(--sidebar-w);
            background: var(--ink);
            color: var(--white);
            flex-shrink: 0;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            overflow-y: auto;
        }
        .admin-sidebar .brand {
            padding: 20px 24px;
            font-weight: 700;
            font-size: 1.1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .admin-sidebar .brand a { color: var(--white); text-decoration: none; }
        .admin-sidebar .brand span { color: var(--sage-light); }
        .admin-nav { padding: 16px 0; }
        .admin-nav a {
            display: block;
            padding: 12px 24px;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
        }
        .admin-nav a:hover { background: rgba(255,255,255,0.06); color: var(--white); }
        .admin-nav a.active { background: rgba(74,124,107,0.25); color: var(--sage-light); border-left: 3px solid var(--sage-light); padding-left: 21px; }
        .admin-main { flex: 1; margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }
        .admin-header {
            background: var(--white);
            border-bottom: 1px solid rgba(0,0,0,0.08);
            padding: 16px 32px;
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
        }
        .admin-header h1 { font-size: 1.25rem; font-weight: 600; }
        .admin-header .user { font-size: 0.875rem; color: var(--muted); }
        .admin-header .user a { color: var(--sage); text-decoration: none; margin-left: 8px; }
        .admin-content { padding: 24px 32px 48px; flex: 1; }
        .admin-card {
            background: var(--white);
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.08);
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
        .admin-card h2 { font-size: 1.1rem; margin-bottom: 16px; font-weight: 600; }
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; }
        .stat-box {
            background: var(--cream);
            border-radius: 8px;
            padding: 20px;
            border: 1px solid rgba(0,0,0,0.06);
        }
        .stat-box .num { font-size: 1.75rem; font-weight: 700; color: var(--ink); line-height: 1.2; }
        .stat-box .label { font-size: 0.8rem; color: var(--muted); margin-top: 4px; }
        .stat-box.pending .num { color: var(--gold); }
        .stat-box.approved .num { color: var(--success); }
        .stat-box.rejected .num { color: var(--danger); }
        table.data-table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        table.data-table th, table.data-table td { padding: 12px 16px; text-align: left; border-bottom: 1px solid rgba(0,0,0,0.08); }
        table.data-table th { font-weight: 600; color: var(--muted); background: var(--cream); }
        table.data-table tr:hover td { background: rgba(0,0,0,0.02); }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .badge-pending { background: rgba(200,168,75,0.2); color: #9a7b2e; }
        .badge-approved { background: rgba(22,163,74,0.15); color: var(--success); }
        .badge-rejected { background: rgba(220,38,38,0.12); color: var(--danger); }
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 6px; font-size: 0.85rem; font-weight: 600; cursor: pointer; border: 1px solid transparent; text-decoration: none; transition: opacity 0.2s; }
        .btn:hover { opacity: 0.9; }
        .btn-sm { padding: 6px 12px; font-size: 0.8rem; }
        .btn-primary { background: var(--sage); color: var(--white); border-color: var(--sage); }
        .btn-danger { background: var(--danger); color: var(--white); border-color: var(--danger); }
        .btn-outline { background: transparent; color: var(--ink); border-color: rgba(0,0,0,0.2); }
        .btn-group { display: flex; gap: 8px; flex-wrap: wrap; }
        .alert { padding: 12px 16px 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; position: relative; overflow: hidden; }
        .alert::before { content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: currentColor; opacity: .7; }
        .alert-success { background: rgba(22,163,74,0.12); color: var(--success); border: 1px solid rgba(22,163,74,0.3); }
        .alert-danger { background: rgba(220,38,38,0.08); color: var(--danger); border: 1px solid rgba(220,38,38,0.25); }
        .filter-bar { display: flex; gap: 12px; align-items: center; margin-bottom: 20px; flex-wrap: wrap; }
        .filter-bar select { padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.14); font-size: 0.9rem; }
        /* Consistent form controls in admin panel */
        .admin-card label { font-size: 0.88rem; font-weight: 600; color: var(--ink); }
        .admin-card input[type="text"],
        .admin-card input[type="email"],
        .admin-card input[type="password"],
        .admin-card input[type="number"],
        .admin-card select,
        .admin-card textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.14);
            background: #fff;
            outline: none;
            font-family: var(--font-sans);
            font-size: 0.92rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .admin-card input:focus,
        .admin-card select:focus,
        .admin-card textarea:focus {
            border-color: rgba(74,124,107,0.7);
            box-shadow: 0 0 0 3px rgba(74,124,107,0.14);
        }
        .admin-card textarea { resize: vertical; }
        .pagination { display: flex; gap: 6px; margin-top: 20px; flex-wrap: wrap; }
        .pagination a, .pagination span { padding: 8px 12px; border-radius: 6px; font-size: 0.875rem; text-decoration: none; color: var(--ink); background: var(--white); border: 1px solid rgba(0,0,0,0.1); }
        .pagination a:hover { background: var(--cream); }
        .pagination .current { background: var(--sage); color: var(--white); border-color: var(--sage); }
        .pagination .disabled { color: var(--muted); cursor: not-allowed; }
        .stat-grid a { text-decoration: none; color: inherit; display: block; }
        .stat-grid a .stat-box {
            transition: border-color 0.2s, transform 0.18s ease, box-shadow 0.2s ease;
            height: 100%;
        }
        .stat-grid a:hover .stat-box {
            border-color: rgba(74,124,107,0.45);
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.08);
        }
        .table-link { color: var(--sage); font-weight: 600; text-decoration: none; }
        .table-link:hover { text-decoration: underline; }
        .admin-card-title-link { color: inherit; text-decoration: none; }
        .admin-card-title-link:hover { color: var(--sage); text-decoration: underline; }
        .admin-workflow-link {
            display: block;
            text-decoration: none;
            color: inherit;
            border-radius: 10px;
            transition: background 0.2s, box-shadow 0.2s;
        }
        .admin-workflow-link:hover {
            background: rgba(74,124,107,0.06);
            box-shadow: 0 4px 16px rgba(74,124,107,0.08);
        }
        .admin-header-row { display: flex; align-items: center; gap: 14px; flex-wrap: wrap; flex: 1; min-width: 0; }
        .admin-header-row h1 { margin: 0; }
        @media (max-width: 768px) {
            .admin-sidebar { width: 100%; position: relative; }
            .admin-main { margin-left: 0; }
        }
    </style>
    @include('partials.back-button-styles')
</head>
<body>
<div class="admin-wrap">
    <aside class="admin-sidebar">
        <div class="brand"><a href="{{ route('admin.index') }}">Edu<span>Bridge</span> Admin</a></div>
        <p style="padding: 12px 24px; font-size: 0.75rem; color: rgba(255,255,255,0.5); line-height: 1.4;">Review counsellor documents and profiles. Admin access only.</p>
        <nav class="admin-nav">
            <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('admin.profile*') ? 'active' : '' }}">Profile Settings</a>
            <a href="{{ route('admin.counsellors.index') }}" class="{{ request()->routeIs('admin.counsellors.*') ? 'active' : '' }}">Counsellors</a>
            <a href="{{ route('admin.documents.index') }}" class="{{ request()->routeIs('admin.documents.index') ? 'active' : '' }}">Documents</a>
            <a href="{{ route('admin.students.index') }}" class="{{ request()->routeIs('admin.students.index') ? 'active' : '' }}">Students</a>
            <a href="{{ route('admin.scores.index') }}" class="{{ request()->routeIs('admin.scores.index') ? 'active' : '' }}">Visa scores</a>
            <a href="{{ route('admin.complaints.index') }}" class="{{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}">Complaints</a>
        </nav>
    </aside>
    <main class="admin-main">
        <header class="admin-header">
            <div class="admin-header-row">
                @unless(request()->routeIs('admin.index'))
                    @include('partials.back-button', ['href' => route('admin.index'), 'title' => 'Return to admin dashboard'])
                @endunless
                <h1>@yield('header', 'Admin')</h1>
            </div>
            <div class="user">
                {{ auth()->user()->name }}
                <a href="{{ route('dashboard') }}">Main site</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button type="submit" class="btn btn-outline btn-sm" style="margin-left:8px">Logout</button></form>
            </div>
        </header>
        <div class="admin-content">
            @if (session('message') || session('success'))
                <div class="alert alert-success">{{ session('message') ?? session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
