<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - DevMantra Admin</title>
    <link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon/favicon.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --dm-dark: #f4f6f9;
            --dm-sidebar: #ffffff;
            --dm-card: #ffffff;
            --dm-border: rgba(0,0,0,0.08);
            --dm-purple: #7463FF;
            --dm-purple-light: rgba(116,99,255,0.08);
            --dm-text: #1e293b;
            --dm-text-muted: rgba(0,0,0,0.45);
            --dm-success: #1d6aa9;
            --dm-danger: #dc2626;
            --dm-warning: #d97706;
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
        a:hover { color: #5a48d4; }

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
            color: var(--dm-text);
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
            color: var(--dm-purple);
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
            color: var(--dm-text);
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
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .dm-topbar-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--dm-text);
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
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
            color: var(--dm-text);
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
            color: var(--dm-purple);
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
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
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
            color: var(--dm-text);
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
        .dm-table tr:hover td { background: rgba(0,0,0,0.02); }
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
            background: #fff;
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
            color: var(--dm-text);
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Sidebar Overlay (mobile) -->
    <div class="dm-sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="dm-sidebar" id="sidebar">
        <div class="dm-sidebar-logo d-flex align-items-center">
            <img src="<?php echo e(asset('assets/img/logo/logo.jpeg')); ?>" alt="DevMantra">
            <span>DevMantra</span>
        </div>
        <nav class="dm-sidebar-nav">
            <div class="dm-sidebar-label">Main</div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <i class="fa-solid fa-chart-pie"></i> Dashboard
            </a>

            <div class="dm-sidebar-label">Content</div>
            <a href="<?php echo e(route('admin.blogs.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.blogs.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-pen-to-square"></i> Blogs
            </a>
            <a href="<?php echo e(route('admin.services.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.services.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-briefcase"></i> Services
            </a>
            <a href="<?php echo e(route('admin.sections.library')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.sections.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-swatchbook"></i> Sections
            </a>
            <a href="<?php echo e(route('admin.newsletters.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.newsletters.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-newspaper"></i> Newsletters
            </a>
            <a href="<?php echo e(route('admin.reports.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.reports.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-file-lines"></i> Reports
            </a>
            <a href="<?php echo e(route('admin.case-studies.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.case-studies.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-magnifying-glass-chart"></i> Case Studies
            </a>
            <a href="<?php echo e(route('admin.alerts.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.alerts.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-bell"></i> Alerts
            </a>

            <div class="dm-sidebar-label">Events</div>
            <a href="<?php echo e(route('admin.events.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.events.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-calendar-days"></i> Events
            </a>

            <div class="dm-sidebar-label">Link in Bio</div>
            <a href="<?php echo e(route('admin.bookmarks.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.bookmarks.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-link"></i> Bookmarks
            </a>

            <div class="dm-sidebar-label">Recruitment</div>
            <a href="<?php echo e(route('admin.careers.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.careers.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-user-tie"></i> Careers
            </a>
            <a href="<?php echo e(route('admin.career-applications.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.career-applications.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-file-lines"></i> Applications
            </a>

            <div class="dm-sidebar-label">Enquiries</div>
            <a href="<?php echo e(route('admin.subscribers.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.subscribers.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-users"></i> Subscribers
            </a>
            <a href="<?php echo e(route('admin.contact-submissions.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.contact-submissions.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-envelope-open-text"></i> Contact Submissions
            </a>

            <div class="dm-sidebar-label">Pages</div>
            <a href="<?php echo e(route('admin.pages.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.pages.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-file-lines"></i> Pages
            </a>
            <a href="<?php echo e(route('admin.contact-settings.edit')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.contact-settings.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-address-book"></i> Contact Settings
            </a>
            <a href="<?php echo e(route('admin.popup.edit')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.popup.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-rectangle-ad"></i> Popup Banner
            </a>

            <div class="dm-sidebar-label">Account</div>
            <a href="<?php echo e(route('admin.profile')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.profile') ? 'active' : ''); ?>">
                <i class="fa-solid fa-user"></i> Profile
            </a>
            <a href="<?php echo e(route('admin.password')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.password') ? 'active' : ''); ?>">
                <i class="fa-solid fa-lock"></i> Change Password
            </a>
            <a href="<?php echo e(route('admin.settings')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.settings') ? 'active' : ''); ?>">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
            <a href="<?php echo e(route('admin.typography.edit')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.typography.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-font"></i> Typography
            </a>

            <div class="dm-sidebar-label">Media</div>
            <a href="<?php echo e(route('admin.gallery.index')); ?>" class="dm-sidebar-link <?php echo e(request()->routeIs('admin.gallery.*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-images"></i> Media Gallery
            </a>

            <div class="dm-sidebar-label">System</div>
            <a href="<?php echo e(url('/')); ?>" target="_blank" class="dm-sidebar-link">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> View Site
            </a>
        </nav>
        <div class="dm-sidebar-footer">
            <div class="dm-user-info">
                <div class="dm-user-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
                <div>
                    <div class="dm-user-name"><?php echo e(auth()->user()->name); ?></div>
                    <div class="dm-user-email"><?php echo e(auth()->user()->email); ?></div>
                </div>
            </div>
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-3">
                <?php echo csrf_field(); ?>
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
                <div class="dm-topbar-title"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></div>
            </div>
            <div class="dm-topbar-actions">
                <?php echo $__env->yieldContent('actions'); ?>
            </div>
        </div>
        <div class="dm-content">
            <?php if(session('success')): ?>
                <div class="dm-alert dm-alert-success">
                    <i class="fa-solid fa-check-circle"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="dm-alert dm-alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i> <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="dm-alert dm-alert-error" style="flex-direction:column;align-items:flex-start;">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <strong>Please fix the following errors:</strong>
                    </div>
                    <ul style="margin:0;padding-left:24px;font-size:13px;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 350,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        var editor = $(this);
                        var data = new FormData();
                        data.append('image', files[0]);
                        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
                        $.ajax({
                            url: '<?php echo e(route("admin.upload-image")); ?>',
                            method: 'POST',
                            data: data,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                editor.summernote('insertImage', response.url);
                            },
                            error: function() {
                                alert('Image upload failed. Please try again.');
                            }
                        });
                    }
                }
            });
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home2/devmasjc/devmantra/resources/views/layouts/admin.blade.php ENDPATH**/ ?>