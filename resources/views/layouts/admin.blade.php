<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - DevMantra Admin</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --dm-dark: #0a0a0f;
            --dm-sidebar: #111118;
            --dm-card: #16161f;
            --dm-border: rgba(255,255,255,0.06);
            --dm-purple: #7463FF;
            --dm-purple-light: rgba(116,99,255,0.15);
            --dm-text: #e4e4e7;
            --dm-text-muted: rgba(255,255,255,0.45);
            --dm-success: #22c55e;
            --dm-danger: #ef4444;
            --dm-warning: #f59e0b;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--dm-dark);
            color: var(--dm-text);
            margin: 0;
            min-height: 100vh;
        }
        a { color: var(--dm-purple); text-decoration: none; }
        a:hover { color: #9b8fff; }

        /* Sidebar */
        .dm-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 260px;
            height: 100vh;
            background: var(--dm-sidebar);
            border-right: 1px solid var(--dm-border);
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform .3s ease;
        }
        .dm-sidebar-logo {
            padding: 24px 24px 20px;
            border-bottom: 1px solid var(--dm-border);
        }
        .dm-sidebar-logo img {
            border-radius: 12px;
            width: 48px; height: 48px;
            object-fit: cover;
        }
        .dm-sidebar-logo span {
            font-size: 18px; font-weight: 700;
            margin-left: 12px;
            color: #fff;
        }
        .dm-sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }
        .dm-sidebar-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--dm-text-muted);
            padding: 12px 12px 8px;
        }
        .dm-sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--dm-text-muted);
            font-size: 14px;
            font-weight: 500;
            transition: all .2s;
            margin-bottom: 2px;
        }
        .dm-sidebar-link:hover {
            background: var(--dm-purple-light);
            color: #fff;
        }
        .dm-sidebar-link.active {
            background: var(--dm-purple);
            color: #fff;
        }
        .dm-sidebar-link i {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }
        .dm-sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid var(--dm-border);
        }
        .dm-sidebar-footer .dm-user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .dm-sidebar-footer .dm-user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--dm-purple);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
        }
        .dm-sidebar-footer .dm-user-name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }
        .dm-sidebar-footer .dm-user-email {
            font-size: 12px;
            color: var(--dm-text-muted);
        }

        /* Main */
        .dm-main {
            margin-left: 260px;
            min-height: 100vh;
        }
        .dm-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 32px;
            border-bottom: 1px solid var(--dm-border);
            background: rgba(10,10,15,0.8);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .dm-topbar-title {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
        }
        .dm-topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .dm-content {
            padding: 32px;
        }

        /* Cards */
        .dm-stat-card {
            background: var(--dm-card);
            border: 1px solid var(--dm-border);
            border-radius: 12px;
            padding: 24px;
            transition: all .3s;
        }
        .dm-stat-card:hover {
            border-color: var(--dm-purple);
            transform: translateY(-2px);
        }
        .dm-stat-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 16px;
        }
        .dm-stat-value {
            font-size: 32px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }
        .dm-stat-label {
            font-size: 13px;
            color: var(--dm-text-muted);
            margin-top: 4px;
        }

        /* Buttons */
        .dm-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all .2s;
        }
        .dm-btn-primary {
            background: var(--dm-purple);
            color: #fff;
        }
        .dm-btn-primary:hover {
            background: #6353e0;
            color: #fff;
        }
        .dm-btn-outline {
            background: transparent;
            border: 1px solid var(--dm-border);
            color: var(--dm-text);
        }
        .dm-btn-outline:hover {
            border-color: var(--dm-purple);
            color: #fff;
        }
        .dm-btn-danger {
            background: rgba(239,68,68,0.15);
            color: var(--dm-danger);
            border: 1px solid rgba(239,68,68,0.2);
        }
        .dm-btn-danger:hover {
            background: var(--dm-danger);
            color: #fff;
        }
        .dm-btn-sm {
            padding: 6px 14px;
            font-size: 13px;
        }

        /* Table */
        .dm-table-wrap {
            background: var(--dm-card);
            border: 1px solid var(--dm-border);
            border-radius: 12px;
            overflow: hidden;
        }
        .dm-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--dm-border);
        }
        .dm-table-title {
            font-size: 16px;
            font-weight: 700;
            color: #fff;
        }
        .dm-table {
            width: 100%;
            border-collapse: collapse;
        }
        .dm-table th {
            text-align: left;
            padding: 12px 24px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--dm-text-muted);
            border-bottom: 1px solid var(--dm-border);
        }
        .dm-table td {
            padding: 16px 24px;
            font-size: 14px;
            border-bottom: 1px solid var(--dm-border);
            vertical-align: middle;
        }
        .dm-table tr:last-child td { border-bottom: none; }
        .dm-table tr:hover td { background: rgba(255,255,255,0.02); }
        .dm-table-thumb {
            width: 48px; height: 48px;
            border-radius: 8px;
            object-fit: cover;
        }

        /* Badge */
        .dm-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }
        .dm-badge-published {
            background: rgba(34,197,94,0.15);
            color: var(--dm-success);
        }
        .dm-badge-draft {
            background: rgba(245,158,11,0.15);
            color: var(--dm-warning);
        }

        /* Form */
        .dm-form-group { margin-bottom: 20px; }
        .dm-form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--dm-text);
            margin-bottom: 6px;
        }
        .dm-form-input,
        .dm-form-select,
        .dm-form-textarea {
            width: 100%;
            padding: 10px 14px;
            background: var(--dm-dark);
            border: 1px solid var(--dm-border);
            border-radius: 8px;
            color: var(--dm-text);
            font-size: 14px;
            transition: border-color .2s;
        }
        .dm-form-input:focus,
        .dm-form-select:focus,
        .dm-form-textarea:focus {
            outline: none;
            border-color: var(--dm-purple);
        }
        .dm-form-textarea { min-height: 200px; resize: vertical; }
        .dm-form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .dm-form-check input[type="checkbox"] {
            width: 18px; height: 18px;
            accent-color: var(--dm-purple);
        }
        .dm-form-hint {
            font-size: 12px;
            color: var(--dm-text-muted);
            margin-top: 4px;
        }

        /* Alert */
        .dm-alert {
            padding: 14px 20px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .dm-alert-success {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.2);
            color: var(--dm-success);
        }
        .dm-alert-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
            color: var(--dm-danger);
        }

        /* Pagination */
        .dm-pagination {
            display: flex;
            gap: 4px;
            padding: 16px 24px;
        }
        .dm-pagination .page-link {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            color: var(--dm-text-muted);
            background: transparent;
            border: 1px solid var(--dm-border);
        }
        .dm-pagination .page-item.active .page-link {
            background: var(--dm-purple);
            border-color: var(--dm-purple);
            color: #fff;
        }

        /* Mobile sidebar toggle */
        .dm-sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }
        @media (max-width: 991px) {
            .dm-sidebar {
                transform: translateX(-100%);
            }
            .dm-sidebar.open {
                transform: translateX(0);
            }
            .dm-main { margin-left: 0; }
            .dm-sidebar-toggle { display: block; }
            .dm-content { padding: 20px 16px; }
            .dm-sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 99;
            }
            .dm-sidebar-overlay.open { display: block; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay (mobile) -->
    <div class="dm-sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="dm-sidebar" id="sidebar">
        <div class="dm-sidebar-logo d-flex align-items-center">
            <img src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="DevMantra">
            <span>DevMantra</span>
        </div>
        <nav class="dm-sidebar-nav">
            <div class="dm-sidebar-label">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="dm-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i> Dashboard
            </a>

            <div class="dm-sidebar-label">Content</div>
            <a href="{{ route('admin.blogs.index') }}" class="dm-sidebar-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                <i class="fa-solid fa-pen-to-square"></i> Blogs
            </a>
            <a href="{{ route('admin.services.index') }}" class="dm-sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase"></i> Services
            </a>
            <a href="{{ route('admin.newsletters.index') }}" class="dm-sidebar-link {{ request()->routeIs('admin.newsletters.*') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper"></i> Newsletters
            </a>

            <div class="dm-sidebar-label">System</div>
            <a href="{{ url('/') }}" target="_blank" class="dm-sidebar-link">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> View Site
            </a>
        </nav>
        <div class="dm-sidebar-footer">
            <div class="dm-user-info">
                <div class="dm-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="dm-user-name">{{ auth()->user()->name }}</div>
                    <div class="dm-user-email">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm w-100">
                    <i class="fa-solid fa-right-from-bracket"></i> Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <div class="dm-main">
        <div class="dm-topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="dm-sidebar-toggle" onclick="toggleSidebar()">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="dm-topbar-title">@yield('title', 'Dashboard')</div>
            </div>
            <div class="dm-topbar-actions">
                @yield('actions')
            </div>
        </div>
        <div class="dm-content">
            @if(session('success'))
                <div class="dm-alert dm-alert-success">
                    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="dm-alert dm-alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="dm-alert dm-alert-error" style="flex-direction:column;align-items:flex-start;">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <strong>Please fix the following errors:</strong>
                    </div>
                    <ul style="margin:0;padding-left:24px;font-size:13px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
    </script>
    @stack('scripts')
</body>
</html>
