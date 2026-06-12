<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="post" action="<?= app_relative_url('admin/site-settings') ?>" class="card">
    <div class="page-head" style="margin-bottom:18px;">
        <div>
            <div class="eyebrow">Editor Landing Page</div>
            <h2><?= esc($title) ?></h2>
            <p class="muted">Kelola teks utama, label section, CTA hero, footer, dan informasi kontak landing page.</p>
        </div>
        <div class="actions">
            <a href="<?= app_relative_url('/') ?>" target="_blank" rel="noopener" class="btn btn-outline">Preview Website</a>
        </div>
    </div>

    <div class="card" style="padding:20px;background:#f9fbfc;">
        <h3 style="margin-top:0;">Hero Section</h3>
        <div class="grid-2">
            <div class="field">
                <label>Nama Tempat</label>
                <input type="text" name="company_name" value="<?= esc(old_or_value('company_name', $setting['company_name'] ?? '')) ?>">
            </div>
            <div class="field">
                <label>Label Kecil Hero</label>
                <input type="text" name="hero_kicker" value="<?= esc(old_or_value('hero_kicker', $setting['hero_kicker'] ?? 'Balkondes Bumiharjo')) ?>">
            </div>
        </div>
        <div class="field">
            <label>Headline Hero</label>
            <input type="text" name="hero_headline" value="<?= esc(old_or_value('hero_headline', $setting['hero_headline'] ?? '')) ?>">
        </div>
        <div class="field">
            <label>Subheadline Hero</label>
            <textarea name="hero_subheadline"><?= esc(old_or_value('hero_subheadline', $setting['hero_subheadline'] ?? '')) ?></textarea>
        </div>
        <div class="grid-2">
            <div class="field">
                <label>Label Tombol Utama</label>
                <input type="text" name="hero_primary_label" value="<?= esc(old_or_value('hero_primary_label', $setting['hero_primary_label'] ?? '')) ?>">
            </div>
            <div class="field">
                <label>URL Tombol Utama</label>
                <input type="text" name="hero_primary_url" value="<?= esc(old_or_value('hero_primary_url', $setting['hero_primary_url'] ?? '')) ?>">
            </div>
        </div>
        <div class="grid-2">
            <div class="field">
                <label>Label Tombol Kedua</label>
                <input type="text" name="hero_secondary_label" value="<?= esc(old_or_value('hero_secondary_label', $setting['hero_secondary_label'] ?? '')) ?>">
            </div>
            <div class="field">
                <label>URL Tombol Kedua</label>
                <input type="text" name="hero_secondary_url" value="<?= esc(old_or_value('hero_secondary_url', $setting['hero_secondary_url'] ?? '')) ?>">
            </div>
        </div>
    </div>

    <div class="card" style="padding:20px;background:#f9fbfc;">
        <h3 style="margin-top:0;">Tentang dan Fasilitas</h3>
        <div class="grid-2">
            <div class="field">
                <label>Label Tentang</label>
                <input type="text" name="about_label" value="<?= esc(old_or_value('about_label', $setting['about_label'] ?? 'Nuansa Desa Wisata')) ?>">
            </div>
            <div class="field">
                <label>Judul Tentang</label>
                <input type="text" name="about_title" value="<?= esc(old_or_value('about_title', $setting['about_title'] ?? '')) ?>">
            </div>
        </div>
        <div class="field">
            <label>Isi Tentang</label>
            <textarea name="about_content"><?= esc(old_or_value('about_content', $setting['about_content'] ?? '')) ?></textarea>
        </div>
        <div class="grid-2">
            <div class="field">
                <label>Label Layanan</label>
                <input type="text" name="services_label" value="<?= esc(old_or_value('services_label', $setting['services_label'] ?? 'Fasilitas')) ?>">
            </div>
            <div class="field">
                <label>Judul Layanan</label>
                <input type="text" name="services_title" value="<?= esc(old_or_value('services_title', $setting['services_title'] ?? '')) ?>">
            </div>
        </div>
        <div class="field">
            <label>Pengantar Layanan</label>
            <textarea name="services_intro"><?= esc(old_or_value('services_intro', $setting['services_intro'] ?? '')) ?></textarea>
        </div>
    </div>

    <div class="card" style="padding:20px;background:#f9fbfc;">
        <h3 style="margin-top:0;">Galeri dan Lokasi</h3>
        <div class="grid-2">
            <div class="field">
                <label>Label Galeri</label>
                <input type="text" name="gallery_label" value="<?= esc(old_or_value('gallery_label', $setting['gallery_label'] ?? 'Galeri')) ?>">
            </div>
            <div class="field">
                <label>Judul Galeri</label>
                <input type="text" name="gallery_title" value="<?= esc(old_or_value('gallery_title', $setting['gallery_title'] ?? '')) ?>">
            </div>
        </div>
        <div class="grid-2">
            <div class="field">
                <label>Label Lokasi</label>
                <input type="text" name="location_label" value="<?= esc(old_or_value('location_label', $setting['location_label'] ?? 'Lokasi Kami')) ?>">
            </div>
            <div class="field">
                <label>Judul Lokasi</label>
                <input type="text" name="location_title" value="<?= esc(old_or_value('location_title', $setting['location_title'] ?? '')) ?>">
            </div>
        </div>
        <div class="field">
            <label>Pengantar Galeri</label>
            <textarea name="gallery_intro"><?= esc(old_or_value('gallery_intro', $setting['gallery_intro'] ?? '')) ?></textarea>
        </div>
        <div class="field">
            <label>Pengantar Lokasi</label>
            <textarea name="location_intro"><?= esc(old_or_value('location_intro', $setting['location_intro'] ?? '')) ?></textarea>
        </div>
    </div>

    <div class="card" style="padding:20px;background:#f9fbfc;">
        <h3 style="margin-top:0;">Kontak dan Footer</h3>
        <div class="grid-2">
            <div class="field">
                <label>Judul Footer</label>
                <input type="text" name="footer_title" value="<?= esc(old_or_value('footer_title', $setting['footer_title'] ?? '')) ?>">
            </div>
            <div class="field">
                <label>Jam Operasional</label>
                <input type="text" name="opening_hours" value="<?= esc(old_or_value('opening_hours', $setting['opening_hours'] ?? '')) ?>">
            </div>
        </div>
        <div class="field">
            <label>Deskripsi Footer</label>
            <textarea name="footer_description"><?= esc(old_or_value('footer_description', $setting['footer_description'] ?? '')) ?></textarea>
        </div>
        <div class="field">
            <label>Alamat</label>
            <textarea name="address"><?= esc(old_or_value('address', $setting['address'] ?? '')) ?></textarea>
        </div>
        <div class="field">
            <label>Link Embed Google Maps</label>
            <textarea name="maps_embed_url"><?= esc(old_or_value('maps_embed_url', $setting['maps_embed_url'] ?? '')) ?></textarea>
        </div>
        <div class="grid-2">
            <div class="field">
                <label>Nomor WhatsApp</label>
                <input type="text" name="whatsapp_number" value="<?= esc(old_or_value('whatsapp_number', $setting['whatsapp_number'] ?? '')) ?>">
            </div>
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" value="<?= esc(old_or_value('email', $setting['email'] ?? '')) ?>">
            </div>
        </div>
        <div class="field">
            <label>Pesan Default WhatsApp</label>
            <textarea name="whatsapp_message"><?= esc(old_or_value('whatsapp_message', $setting['whatsapp_message'] ?? '')) ?></textarea>
        </div>
        <div class="grid-3">
            <div class="field">
                <label>Instagram URL</label>
                <input type="text" name="instagram_url" value="<?= esc(old_or_value('instagram_url', $setting['instagram_url'] ?? '')) ?>">
            </div>
            <div class="field">
                <label>Facebook URL</label>
                <input type="text" name="facebook_url" value="<?= esc(old_or_value('facebook_url', $setting['facebook_url'] ?? '')) ?>">
            </div>
            <div class="field">
                <label>Google Maps URL</label>
                <input type="text" name="maps_url" value="<?= esc(old_or_value('maps_url', $setting['maps_url'] ?? '')) ?>">
            </div>
        </div>
    </div>

    <button class="btn btn-primary" type="submit">Simpan Pengaturan</button>
</form>
<?= $this->endSection() ?>

