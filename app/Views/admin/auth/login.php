<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin web-balkondes</title>
    <style>
        :root {
            --ink: #2f261f;
            --muted: #6e6257;
            --gold: #b8854d;
            --olive: #2f5546;
            --cream: #f7f1e7;
        }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: "Plus Jakarta Sans", Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(184, 133, 77, 0.22), transparent 30%),
                radial-gradient(circle at bottom right, rgba(47, 85, 70, 0.18), transparent 34%),
                linear-gradient(135deg, #efe0cb, #f7f1e7 48%, #eef3ef);
            color: var(--ink);
        }
        .card {
            width: min(470px, calc(100% - 32px));
            background: rgba(255,255,255,.82);
            backdrop-filter: blur(18px);
            border-radius: 28px;
            padding: 32px;
            box-shadow: 0 30px 80px rgba(41, 29, 17, .16);
        }
        .kicker {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .34em;
            text-transform: uppercase;
            color: var(--gold);
        }
        h1 {
            margin: 10px 0 8px;
            font-size: 42px;
            line-height: .95;
            font-family: Georgia, "Times New Roman", serif;
        }
        p { color: var(--muted); line-height: 1.7; }
        .field { display: grid; gap: 8px; margin-top: 16px; }
        input {
            width: 100%;
            padding: 13px 14px;
            border-radius: 14px;
            border: 1px solid #ddd4c8;
            box-sizing: border-box;
            font: inherit;
            background: rgba(255,255,255,.9);
        }
        button {
            width: 100%;
            margin-top: 20px;
            padding: 14px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(180deg, #bb8a54, #9d723e);
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 18px 36px rgba(184, 133, 77, .28);
        }
        button:hover { filter: brightness(1.03); }
        .alert {
            margin-top: 16px;
            padding: 12px 14px;
            border-radius: 14px;
            background: #fef3f2;
            color: #912018;
            border: 1px solid #fecdca;
        }
        .success { background:#ecfdf3; color:#027a48; border-color:#abefc6; }
        .portal-badge {
            display: inline-flex;
            margin-top: 14px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(47, 85, 70, .08);
            color: var(--olive);
            font-size: 12px;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <form method="post" action="<?= esc($loginAction ?? site_url('admin/login')) ?>" class="card">
        <div class="kicker"><?= ! empty($isHiddenEntry) ? 'Private Entry' : 'Admin Panel' ?></div>
        <h1>Portal Kontrol Balkondes</h1>
        <p>Masuk untuk mengelola hero, section landing page, layanan, galeri, dan booking links secara terpusat.</p>

        <?php if (! empty($isHiddenEntry)): ?>
            <div class="portal-badge">Akses tersembunyi aktif</div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>

        <div class="field">
            <label for="login">Email atau Username</label>
            <input id="login" type="text" name="login" value="<?= esc(old('login')) ?>" placeholder="Masukkan akun admin">
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Masukkan password">
        </div>

        <button type="submit">Masuk ke Dashboard</button>
    </form>
</body>
</html>
