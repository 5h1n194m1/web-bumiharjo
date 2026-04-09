<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Web Balkondes') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cormorant+Garamond:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f4eee4;
            --surface: #ffffff;
            --surface-soft: #fcf8f2;
            --border: #e8ddce;
            --text: #30271f;
            --muted: #726455;
            --primary: #b8854d;
            --primary-dark: #9f723f;
            --olive: #26493d;
            --danger: #b42318;
            --success: #027a48;
            --shadow: 0 24px 60px rgba(52, 39, 24, 0.08);
            --radius: 22px;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Plus Jakarta Sans", Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(184,133,77,.14), transparent 26%),
                radial-gradient(circle at bottom right, rgba(38,73,61,.12), transparent 30%),
                linear-gradient(180deg, #faf5ed, #f3ece1);
            color: var(--text);
        }
        h1, h2, h3 {
            font-family: "Cormorant Garamond", Georgia, serif;
            letter-spacing: -.02em;
        }
        a { color: inherit; text-decoration: none; }
        .app {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 270px 1fr;
        }
        .sidebar {
            background:
                radial-gradient(circle at top, rgba(255,255,255,.08), transparent 26%),
                linear-gradient(180deg, #1f342c, #253f35 52%, #16261f);
            color: #fff;
            padding: 28px 20px;
            position: sticky;
            top: 0;
            min-height: 100vh;
        }
        .brand {
            margin-bottom: 26px;
            padding: 18px;
            border-radius: 18px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.08);
        }
        .brand strong {
            display: block;
            font-size: 29px;
            font-family: "Cormorant Garamond", Georgia, serif;
            line-height: .95;
        }
        .brand span { display: block; font-size: 13px; color: rgba(255,255,255,.72); margin-top: 6px; }
        .nav-label {
            font-size: 11px;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: rgba(255,255,255,.62);
            margin: 22px 12px 8px;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 14px;
            border-radius: 14px;
            margin-bottom: 8px;
            color: rgba(255,255,255,.86);
        }
        .nav-link.active, .nav-link:hover {
            background: rgba(255,255,255,.12);
            color: #fff;
        }
        .main { padding: 28px; }
        .topbar {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 22px;
        }
        .welcome-card, .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        .welcome-card {
            padding: 20px 24px;
            background: linear-gradient(180deg, rgba(255,255,255,.98), rgba(252,248,242,.98));
        }
        .welcome-card small { color: var(--muted); display: block; margin-bottom: 4px; }
        .welcome-card strong {
            font-size: 32px;
            line-height: .95;
            font-family: "Cormorant Garamond", Georgia, serif;
        }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 16px;
            border-radius: 12px;
            border: 1px solid transparent;
            font-weight: 700;
            cursor: pointer;
            background: #f1ece3;
            color: var(--text);
            transition: transform .18s ease, background .18s ease, border-color .18s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: linear-gradient(180deg, #c28f58, var(--primary-dark)); color: #fff; box-shadow: 0 18px 34px rgba(184,133,77,.24); }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline { border-color: var(--border); background: #fff; }
        .btn-danger { background: #fef3f2; color: var(--danger); border-color: #fecdca; }
        .card { padding: 24px; }
        .card + .card { margin-top: 20px; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 18px; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 18px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 18px; }
        .stat {
            padding: 18px;
            border-radius: 18px;
            background: linear-gradient(180deg, #fff, #fcf8f2);
            border: 1px solid var(--border);
        }
        .stat small { color: var(--muted); display: block; margin-bottom: 8px; }
        .stat strong {
            font-size: 34px;
            line-height: .95;
            font-family: "Cormorant Garamond", Georgia, serif;
        }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 12px; border-bottom: 1px solid var(--border); text-align: left; vertical-align: middle; }
        tbody tr:hover { background: #fcf8f2; }
        th { font-size: 13px; color: var(--muted); }
        .muted { color: var(--muted); }
        .badge {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }
        .badge-success { background: #ecfdf3; color: #027a48; }
        .badge-muted { background: #f2f4f7; color: #667085; }
        .field { display: grid; gap: 8px; margin-bottom: 16px; }
        label { font-weight: 700; }
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], textarea, select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: #fffdf9;
            font: inherit;
        }
        textarea { min-height: 130px; resize: vertical; }
        .checkbox { display: flex; align-items: center; gap: 10px; margin: 8px 0 18px; }
        .errors, .flash {
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 18px;
        }
        .errors { background: #fef3f2; border: 1px solid #fecdca; color: #912018; }
        .flash-success { background: #ecfdf3; border: 1px solid #abefc6; color: #027a48; }
        .flash-error { background: #fef3f2; border: 1px solid #fecdca; color: #912018; }
        .thumb { width: 96px; height: 72px; border-radius: 12px; object-fit: cover; background: #e5e7eb; }
        .page-head {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: flex-end;
            flex-wrap: wrap;
        }
        .eyebrow {
            font-size: 11px;
            letter-spacing: .22em;
            text-transform: uppercase;
            color: var(--primary);
            font-weight: 800;
            margin-bottom: 8px;
        }
        .page-head h2 {
            margin: 0;
            font-size: 42px;
            line-height: .95;
        }
        .subcard {
            padding: 18px;
            border-radius: 18px;
            background: linear-gradient(180deg, #fff, #fcf8f2);
            border: 1px solid var(--border);
        }
        @media (max-width: 980px) {
            .app { grid-template-columns: 1fr; }
            .sidebar { min-height: auto; position: static; }
            .grid-2, .grid-4, .grid-3 { grid-template-columns: 1fr; }
            .topbar { flex-direction: column; align-items: stretch; }
            .page-head h2 { font-size: 34px; }
        }
    </style>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <a href="<?= site_url('admin/dashboard') ?>" class="brand">
            <strong>web-balkondes</strong>
            <span>CMS sederhana untuk website Balkondes</span>
        </a>

        <div class="nav-label">Konten</div>
        <a href="<?= site_url('admin/site-settings') ?>" class="nav-link <?= is_active_admin('admin/site-settings') ?>">Pengaturan Website</a>
        <a href="<?= site_url('admin/booking-links') ?>" class="nav-link <?= is_active_admin('admin/booking-links') ?>">Booking Links</a>
        <a href="<?= site_url('admin/hero-slides') ?>" class="nav-link <?= is_active_admin('admin/hero-slides') ?>">Hero Slides</a>
        <a href="<?= site_url('admin/services') ?>" class="nav-link <?= is_active_admin('admin/services') ?>">Layanan</a>
        <a href="<?= site_url('admin/gallery-items') ?>" class="nav-link <?= is_active_admin('admin/gallery-items') ?>">Galeri & Video</a>

        <div class="nav-label">Sistem</div>
        <a href="<?= site_url('/') ?>" class="nav-link" target="_blank" rel="noopener">Lihat Website</a>
        <a href="<?= site_url('admin/logout') ?>" class="nav-link">Logout</a>
    </aside>

    <main class="main">
        <div class="topbar">
            <div class="welcome-card">
                <small>Admin aktif</small>
                <strong><?= esc($currentUser['name']) ?></strong>
                <div class="muted"><?= esc($currentUser['email']) ?></div>
            </div>
            <div class="actions">
                <a href="<?= site_url('/') ?>" target="_blank" rel="noopener" class="btn btn-outline">Buka Website</a>
                <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-primary">Dashboard</a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash flash-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash flash-error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="errors">
                <?php foreach ((array) session()->getFlashdata('errors') as $error): ?>
                    <div><?= esc($error) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>
</div>
</body>
</html>
