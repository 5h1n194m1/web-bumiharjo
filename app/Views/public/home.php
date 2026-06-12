<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= esc(setting_value($settings, 'company_name', 'Balkondes Bumiharjo')) ?> | Desa Wisata, Penginapan, dan Venue Acara</title>
    <meta name="description" content="<?= esc(setting_value($settings, 'hero_subheadline', 'Website resmi Balkondes Bumiharjo untuk penginapan, venue acara, dan nuansa wisata hangat di kawasan Borobudur.')) ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cormorant+Garamond:wght@500;600;700&display=swap" rel="stylesheet">
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --surface: #f6f0e6;
                --surface-soft: #fbf7f1;
                --surface-deep: #ece1d1;
                --ink: #342a22;
                --muted: #756657;
                --gold: #b8854d;
                --gold-soft: #d5b283;
                --shadow: 0 30px 60px rgba(59, 41, 18, 0.08);
            }

            html { scroll-behavior: smooth; }
            body {
                @apply bg-[var(--surface)] text-[var(--ink)] antialiased;
                font-family: "Plus Jakarta Sans", sans-serif;
            }
            h1, h2, h3, h4 { font-family: "Cormorant Garamond", serif; }
        }

        @layer components {
            .shell { @apply mx-auto w-full max-w-[1360px] px-4 sm:px-6 lg:px-8 xl:px-10; }
            .glass {
                background: rgba(251, 247, 241, 0.68);
                backdrop-filter: blur(18px);
            }
            .section-label { @apply text-[11px] font-semibold uppercase tracking-[0.34em] text-[var(--gold)]; }

            /*
             * FADE-UP SYSTEM
             * ─────────────────────────────────────────────────────────────────
             * Default (non-motion): always visible, no transform.
             * motion-enhanced: baru aktif — JS akan terus mengupdate --fo & --fs
             * via rAF sehingga fade bekerja saat scroll naik maupun turun.
             */
            .fade-up {
                opacity: 1;
                transform: translateY(0);
            }

            .motion-enhanced .fade-up {
                /* --fo  = fade opacity  (0–1, JS controlled)
                   --fs  = fade shift-Y  (px, JS controlled) */
                --fo: 0;
                --fs: 32px;
                --fd: 0ms;
                opacity: var(--fo);
                transform: translateY(var(--fs));
                transition:
                    opacity  1800ms cubic-bezier(0.16, 1, 0.3, 1),
                    transform 1800ms cubic-bezier(0.16, 1, 0.3, 1);
                transition-delay: var(--fd);
            }

            .feature-pill {
                @apply rounded-full bg-white/70 px-4 py-2 text-sm font-semibold text-[var(--muted)] shadow-[0_16px_28px_rgba(52,39,24,0.08)];
                backdrop-filter: blur(10px);
            }
        }

        /* ─── Parallax nodes ────────────────────────────────────────────── */
        .parallax-node {
            --px: 0px;
            --py: 0px;
            --ps: 1;
            --pr: 0deg;
            will-change: transform;
        }

        /* Semua node yang bisa digerakkan parallax */
        .hero-panel-main,
        .hero-panel-secondary,
        .hero-panel-card,
        .hero-panel-tertiary,
        .hero-orb,
        .hero-grid,
        .hero-backdrop {
            transform: translate3d(var(--px, 0px), var(--py, 0px), 0)
                       scale(var(--ps, 1))
                       rotate(var(--pr, 0deg));
            will-change: transform;
        }

        /* Scene parallax — elemen di luar hero */
        [data-parallax-intensity] {
            transform: translate3d(0, var(--py, 0px), 0);
            will-change: transform;
        }

        .hero-orb {
            position: absolute;
            border-radius: 999px;
            /* filter: blur(...) DILARANG — sudah dihapus */
            opacity: .65;
            will-change: transform;
        }

        .hero-grid {
            background-image:
                linear-gradient(rgba(255,255,255,.18) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.18) 1px, transparent 1px);
            background-size: 32px 32px;
            mask-image: linear-gradient(180deg, rgba(0,0,0,.7), transparent 85%);
            will-change: transform;
        }

        .hero-backdrop {
            will-change: transform;
            transform-origin: center center;
        }

        .hero-stage {
            min-height: clamp(460px, 72vh, 760px);
        }

        .adaptive-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            background: #120f0d;
        }
        .adaptive-video[data-fit="contain"] {
            object-fit: contain;
        }

        .hero-tilt {
            transform-style: preserve-3d;
            will-change: transform;
            transition: transform 280ms ease-out;
        }

        .hidden-entry {
            display: inline-flex;
            width: 14px;
            height: 14px;
            border-radius: 999px;
            opacity: .14;
            background: rgba(72, 61, 53, .96);
            border: 1px solid rgba(255,255,255,.035);
            box-shadow: 0 0 0 6px rgba(255,255,255,.018);
            transition: opacity 180ms ease, transform 180ms ease, box-shadow 180ms ease;
        }
        .hidden-entry:hover {
            opacity: .28;
            transform: scale(1.04);
            box-shadow: 0 0 0 8px rgba(255,255,255,.028);
        }

        .menu-sheet {
            transition: opacity .22s ease, transform .22s ease;
            transform-origin: top right;
        }

        .floating-dock {
            position: fixed;
            right: 18px;
            bottom: 18px;
            z-index: 45;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .floating-dock a {
            box-shadow: 0 20px 40px rgba(52,39,24,.12);
        }

        .no-scroll { overflow: hidden; }

        /* ─── Reduced motion ──────────────────────────────────────────── */
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            .motion-enhanced .fade-up {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }
            .hero-panel-main,
            .hero-panel-secondary,
            .hero-panel-card,
            .hero-panel-tertiary,
            .hero-orb,
            .hero-grid,
            .hero-backdrop,
            [data-parallax-intensity] {
                transform: none !important;
                transition: none !important;
            }
        }

        /* ─── Large screen cap ────────────────────────────────────────── */
        @media (min-width: 1440px) {
            .shell { max-width: 1440px; }
        }

        /* ─── Compact viewport adjustments ───────────────────────────── */
        @media (max-height: 940px) and (min-width: 1024px) {
            .hero-stage { min-height: 600px; }
            .hero-panel-main { inset-inline: 20%; height: 54%; }
            .hero-panel-secondary { top: 30%; width: 40%; }
            .hero-panel-card { top: 40%; left: 15%; max-width: 320px; }
            .hero-panel-tertiary { width: 34%; bottom: 5%; }
        }
        @media (max-height: 760px) and (min-width: 1024px) {
            .hero-stage { min-height: 520px; }
        }

        /* ─── Mobile adjustments ──────────────────────────────────────── */
        @media (max-width: 767px) {
            .shell { padding-left: 16px; padding-right: 16px; }
            .floating-dock {
                left: 14px;
                right: 14px;
                bottom: 14px;
                justify-content: stretch;
            }
            .floating-dock a {
                flex: 1;
                justify-content: center;
            }
            .hero-stage { min-height: 420px; }
        }
        @media (max-width: 1023px) {
            .hero-stage { min-height: clamp(420px, 64vh, 620px); }
        }
    </style>
</head>
<body>
<?php
    $companyName = setting_value($settings, 'company_name', 'Balkondes Bumiharjo');
    $heroKicker = setting_value($settings, 'hero_kicker', 'Balkondes Bumiharjo');
    $heroHeadline = setting_value($settings, 'hero_headline', 'Balkondes Bumiharjo');
    $heroSubheadline = setting_value($settings, 'hero_subheadline', 'Tempat singgah hangat di kawasan Borobudur untuk penginapan, gathering, meeting, wedding, dan momen yang ingin dikenang lebih lama.');
    $heroPrimaryLabel = setting_value($settings, 'hero_primary_label', 'Lihat Opsi Booking');
    $heroPrimaryUrl = normalize_internal_url(setting_value($settings, 'hero_primary_url', app_relative_url('booking')), 'booking');
    $heroSecondaryLabel = setting_value($settings, 'hero_secondary_label', 'Chat WhatsApp');
    $heroSecondaryUrl = setting_value($settings, 'hero_secondary_url', whatsapp_link($settings));
    $aboutLabel = setting_value($settings, 'about_label', 'Nuansa Desa Wisata');
    $aboutTitle = setting_value($settings, 'about_title', 'Lebih Dari Sekadar Tempat Singgah');
    $aboutContent = setting_value($settings, 'about_content', 'Balkondes Bumiharjo menghadirkan suasana desa yang tenang, nyaman, dan akrab. Di sini, tamu dapat beristirahat, menyusun acara, menikmati kuliner, hingga merasakan ritme Borobudur dengan cara yang lebih dekat dan lebih hangat.');
    $servicesLabel = setting_value($settings, 'services_label', 'Fasilitas');
    $servicesTitle = setting_value($settings, 'services_title', 'Fasilitas');
    $servicesIntro = setting_value($settings, 'services_intro', 'Rangkaian fasilitas yang disusun untuk tamu yang datang mencari kenyamanan, kebersamaan, maupun kebutuhan acara yang berkesan.');
    $galleryLabel = setting_value($settings, 'gallery_label', 'Galeri');
    $galleryTitle = setting_value($settings, 'gallery_title', 'Keindahan yang terasa dekat dan tenang.');
    $galleryIntro = setting_value($settings, 'gallery_intro', 'Sudut-sudut visual Balkondes Bumiharjo yang hangat, tenang, dan cocok untuk penginapan maupun acara.');
    $videoTitle = setting_value($settings, 'video_title', 'Ruang yang hangat, tenang, dan mudah diingat.');
    $videoCaption = setting_value($settings, 'video_caption', 'Section video sudah disiapkan mengikuti referensi. Saat file video final tersedia, bagian ini bisa langsung dihubungkan ke media upload dari admin.');
    $videoEnabled = (int) ($settings['video_enabled'] ?? 1) === 1;
    $address = setting_value($settings, 'address', 'Bumiharjo, Borobudur, Magelang, Jawa Tengah, Indonesia');
    $locationLabel = setting_value($settings, 'location_label', 'Lokasi Kami');
    $locationTitle = setting_value($settings, 'location_title', 'Mudah dijangkau, dekat dengan suasana Borobudur.');
    $locationIntro = setting_value($settings, 'location_intro', 'Akses mudah menuju kawasan Balkondes Bumiharjo untuk kunjungan santai maupun acara bersama.');
    $openingHours = setting_value($settings, 'opening_hours', 'Setiap hari, 08.00 - 20.00 WIB');
    $mapsEmbed = setting_value($settings, 'maps_embed_url', 'https://www.google.com/maps?q=Balkondes%20Bumiharjo&output=embed');
    $whatsAppNumber = setting_value($settings, 'whatsapp_number', '082242186437');
    $footerTitle = setting_value($settings, 'footer_title', $companyName);
    $footerDescription = setting_value($settings, 'footer_description', 'Website resmi Balkondes Bumiharjo untuk penginapan, kegiatan bersama, dan kanal booking yang lebih rapi.');

    $fallbackImages = [
        'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1512632578888-169bbbc64f33?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80',
    ];

    $visualPool = [];
    foreach ($heroSlides as $slide) {
        if (! empty($slide['image_path'])) {
            $visualPool[] = media_url($slide['image_path']);
        }
    }
    foreach ($galleryItems as $item) {
        if (! empty($item['image_path'])) {
            $visualPool[] = media_url($item['image_path']);
        }
    }

    $pickVisual = static function (int $index) use ($visualPool, $fallbackImages): string {
        return $visualPool[$index] ?? $fallbackImages[$index % count($fallbackImages)];
    };

    $fallbackVisual = static function (int $index) use ($fallbackImages): string {
        return $fallbackImages[$index % count($fallbackImages)];
    };

    $detectVideoMime = static function (?string $path): string {
        $extension = strtolower(pathinfo((string) $path, PATHINFO_EXTENSION));
        return match ($extension) {
            'webm' => 'video/webm',
            'mov'  => 'video/quicktime',
            default => 'video/mp4',
        };
    };

    $heroBackground = ! empty($primaryHero['image_path'])
        ? media_url($primaryHero['image_path'])
        : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1600&q=80';

    $videoHighlight = build_video_section_media($settings);
    if ($videoHighlight !== null) {
        $videoHighlight['title']   = $videoTitle;
        $videoHighlight['caption'] = $videoCaption;
        $videoHighlight['poster']  = $fallbackVisual(6);
    }

    $serviceCards = [];
    foreach ($services as $index => $service) {
        $title       = trim((string) ($service['title'] ?? ''));
        $description = trim((string) ($service['description'] ?? ''));
        if ($title === '') continue;
        $serviceCards[] = [
            'title'       => $title,
            'description' => $description !== '' ? $description : 'Nikmati fasilitas yang disusun hangat untuk tamu Balkondes Bumiharjo.',
            'image'       => ! empty($service['image_path']) ? media_url($service['image_path']) : $pickVisual($index + 1),
            'points'      => array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) ($service['highlight_points'] ?? '')) ?: []))),
        ];
        if ($serviceCards[array_key_last($serviceCards)]['points'] === []) {
            $serviceCards[array_key_last($serviceCards)]['points'] = [
                'Suasana hangat khas desa wisata',
                'Cocok untuk keluarga, komunitas, atau acara kecil',
                'Akses mudah menuju kawasan Borobudur',
            ];
        }
    }

    if ($serviceCards === []) {
        $serviceCards = [
            ['title'=>'Penginapan dan Homestay','description'=>'Kamar dan area inap yang tenang untuk tamu yang ingin beristirahat dekat Borobudur dengan suasana desa yang terasa akrab.','image'=>$pickVisual(0),'points'=>['Nuansa hangat dan tenang','Cocok untuk staycation keluarga','Nyaman untuk tamu rombongan kecil']],
            ['title'=>'Kuliner dan Jamuan','description'=>'Sajian yang cocok untuk makan bersama, acara keluarga, hingga penyambutan tamu dalam suasana yang lebih personal.','image'=>$pickVisual(1),'points'=>['Nuansa makan bersama lebih intim','Pas untuk jamuan komunitas','Bisa dikombinasikan dengan acara di lokasi']],
            ['title'=>'Venue Acara','description'=>'Ruang dan suasana yang mendukung meeting, gathering, wedding, atau kegiatan budaya dengan latar desa wisata.','image'=>$pickVisual(2),'points'=>['Fleksibel untuk berbagai kebutuhan acara','Visual lokasi kuat untuk dokumentasi','Suasana tenang dan representatif']],
            ['title'=>'Eksplorasi Borobudur','description'=>'Mulai perjalanan ke kawasan Borobudur dari titik yang lebih hangat, dekat, dan penuh cerita lokal.','image'=>$pickVisual(3),'points'=>['Dekat dengan destinasi utama','Cocok untuk itinerary wisata','Memberi nuansa desa yang lebih otentik']],
        ];
    }

    $galleryVisuals = [];
    foreach ($galleryItems as $index => $item) {
        if (! empty($item['image_path'])) {
            $galleryVisuals[] = ['src'=>media_url($item['image_path']),'type'=>'image','title'=>$item['title']?:'Galeri Balkondes Bumiharjo','caption'=>$item['caption']?:'Sudut suasana Balkondes Bumiharjo.'];
        } elseif (($item['media_type'] ?? 'image') === 'video' && ! empty($item['video_path'])) {
            $galleryVisuals[] = ['src'=>media_url($item['video_path']),'type'=>'video','mime'=>$detectVideoMime($item['video_path']),'poster'=>! empty($item['image_path']) ? media_url($item['image_path']) : $fallbackVisual($index + 2),'title'=>$item['title']?:'Video Balkondes Bumiharjo','caption'=>$item['caption']?:'Video suasana Balkondes Bumiharjo.'];
        }
    }
    while (count($galleryVisuals) < 6) {
        $galleryVisuals[] = ['src'=>$pickVisual(count($galleryVisuals) + 2),'type'=>'image','title'=>'Galeri Balkondes Bumiharjo','caption'=>'Sudut suasana Balkondes Bumiharjo.'];
    }

    $instagramUrl = '#';
    $mapsUrl      = '#';
    foreach ($contactLinks as $contactLink) {
        if (($contactLink['label'] ?? '') === 'Instagram')   $instagramUrl = $contactLink['url'];
        if (($contactLink['label'] ?? '') === 'Google Maps') $mapsUrl      = $contactLink['url'];
    }

    $heroBookingUrl = app_relative_url('booking');
?>

<!-- ═══════════════════════════════════════════════
     NAV
═══════════════════════════════════════════════ -->
<nav class="fixed inset-x-0 top-0 z-50">
    <div class="shell pt-4">
        <div class="glass flex items-center justify-between rounded-full px-4 py-3 shadow-[0_18px_45px_rgba(68,45,14,0.08)] sm:px-6">
            <a class="max-w-[180px] text-sm font-semibold tracking-[0.12em] text-[var(--muted)] sm:max-w-none sm:text-[13px]" href="#home"><?= esc($companyName) ?></a>
            <div class="hidden items-center gap-7 text-sm text-[var(--muted)] md:flex">
                <a href="#tentang"    class="transition hover:text-[var(--ink)]">Tentang</a>
                <a href="#fasilitas" class="transition hover:text-[var(--ink)]">Fasilitas</a>
                <a href="#galeri"     class="transition hover:text-[var(--ink)]">Galeri</a>
                <a href="#lokasi"     class="transition hover:text-[var(--ink)]">Lokasi</a>
            </div>
            <div class="flex items-center gap-2">
                <a class="hidden rounded-full px-4 py-2 text-sm font-semibold text-[var(--muted)] transition hover:bg-white/60 sm:inline-flex"
                   href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener">WhatsApp</a>
                <a class="inline-flex rounded-full bg-[var(--gold)] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#9d723e]"
                   href="<?= esc($heroBookingUrl) ?>">Booking</a>
                <!-- FIXED: type="button" agar tidak trigger submit form secara tidak sengaja -->
                <button type="button"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/70 text-[var(--ink)] md:hidden"
                        id="js-menu-toggle"
                        aria-label="Buka menu"
                        aria-expanded="false"
                        aria-controls="js-menu-sheet">&#9776;</button>
            </div>
        </div>
        <!-- FIXED: id dipakai JS, hidden/block dikelola sepenuhnya lewat JS -->
        <div class="menu-sheet mt-3 hidden rounded-[1.6rem] bg-white/90 p-4 shadow-[0_20px_40px_rgba(52,39,24,0.12)] backdrop-blur-xl md:hidden"
             id="js-menu-sheet"
             role="dialog"
             aria-label="Menu navigasi">
            <div class="grid gap-2 text-sm font-semibold text-[var(--muted)]">
                <a class="rounded-[1rem] px-3 py-3 transition hover:bg-[var(--surface-soft)]" href="#tentang">Tentang</a>
                <a class="rounded-[1rem] px-3 py-3 transition hover:bg-[var(--surface-soft)]" href="#fasilitas">Fasilitas</a>
                <a class="rounded-[1rem] px-3 py-3 transition hover:bg-[var(--surface-soft)]" href="#galeri">Galeri</a>
                <a class="rounded-[1rem] px-3 py-3 transition hover:bg-[var(--surface-soft)]" href="#lokasi">Lokasi</a>
                <a class="rounded-[1rem] bg-[var(--surface-soft)] px-3 py-3 text-[var(--ink)]"
                   href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener">Chat WhatsApp</a>
            </div>
        </div>
    </div>
</nav>

<!-- ═══════════════════════════════════════════════
     MAIN
═══════════════════════════════════════════════ -->
<main id="home">

    <!-- ── HERO ── -->
    <section class="relative overflow-hidden px-0 pb-16 pt-24 sm:pt-28 lg:pt-32">
        <div class="absolute inset-x-0 top-0 h-[88%] bg-gradient-to-b from-[#eadbc8] via-[#f3eadf] to-transparent"></div>

        <div class="hero-orb parallax-node left-[-6%] top-[10%] h-40 w-40 bg-[rgba(184,133,77,.22)]" data-speed="0.22"></div>
        <div class="hero-orb parallax-node right-[6%] top-[18%] h-28 w-28 bg-[rgba(92,106,85,.18)]" data-speed="-0.18"></div>
        <div class="hero-orb parallax-node right-[12%] bottom-[14%] h-44 w-44 bg-[rgba(255,255,255,.26)]" data-speed="0.16"></div>
        <div class="hero-grid parallax-node absolute inset-x-0 top-[6%] h-[68%] opacity-30" data-speed="0.08"></div>

        <div class="shell relative">
            <div class="grid items-end gap-10 lg:grid-cols-[1.08fr_0.92fr] lg:gap-12">

                <!-- Left copy -->
                <div class="relative z-10 fade-up">
                    <p class="section-label mb-5"><?= esc($heroKicker) ?></p>
                    <h1 class="max-w-[14ch] text-[44px] leading-[0.92] text-[var(--ink)] sm:text-[64px] lg:text-[80px] xl:text-[88px] 2xl:text-[96px]"><?= esc($heroHeadline) ?></h1>
                    <p class="mt-6 max-w-xl text-[15px] leading-7 text-[var(--muted)] sm:text-[17px]"><?= esc($heroSubheadline) ?></p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a class="inline-flex rounded-full bg-[var(--gold)] px-6 py-3 text-sm font-semibold text-white shadow-[0_18px_35px_rgba(184,133,77,0.28)] transition hover:-translate-y-0.5 hover:bg-[#9d723e]"
                           href="<?= esc($heroPrimaryUrl) ?>"<?= str_starts_with($heroPrimaryUrl, 'http') ? ' target="_blank" rel="noopener"' : '' ?>><?= esc($heroPrimaryLabel) ?></a>
                        <a class="inline-flex rounded-full bg-white/80 px-6 py-3 text-sm font-semibold text-[var(--ink)] shadow-[0_18px_35px_rgba(60,40,18,0.08)] transition hover:-translate-y-0.5"
                           href="<?= esc($heroSecondaryUrl) ?>"<?= str_starts_with($heroSecondaryUrl, 'http') ? ' target="_blank" rel="noopener"' : '' ?>><?= esc($heroSecondaryLabel) ?></a>
                    </div>
                    <div class="mt-10 flex flex-wrap gap-6 text-sm text-[var(--muted)]">
                        <span>Penginapan</span><span>Venue Acara</span><span>Gathering</span><span>Borobudur</span>
                    </div>
                </div>

                <!-- Right floating panels -->
                <div class="hero-stage relative" id="js-hero-mouse">
                    <div class="hero-panel-main parallax-node absolute inset-x-[16%] top-0 h-[58%] overflow-hidden rounded-[2.5rem] bg-[#231a14] shadow-[var(--shadow)] sm:inset-x-[20%] lg:left-[18%] lg:right-[12%]"
                         data-speed="0.12" data-depth="16">
                        <img class="hero-backdrop h-full w-full object-cover scale-[1.08]"
                             src="<?= esc($heroBackground) ?>" alt="Hero Balkondes Bumiharjo" loading="eager">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2f261f]/26 via-transparent to-white/10"></div>
                    </div>
                    <div class="hero-panel-secondary parallax-node absolute left-0 top-[32%] w-[44%] overflow-hidden rounded-[1.75rem] shadow-[var(--shadow)]"
                         data-speed="0.08" data-depth="10">
                        <img class="h-[220px] w-full object-cover sm:h-[280px]"
                             src="<?= esc($pickVisual(4)) ?>" alt="Suasana penginapan" loading="lazy">
                    </div>
                    <div class="glass hero-panel-card parallax-node absolute left-[18%] top-[42%] max-w-[340px] rounded-[2rem] p-5 shadow-[var(--shadow)] sm:p-7"
                         data-speed="0.05" data-depth="7">
                        <p class="section-label"><?= esc($aboutLabel) ?></p>
                        <h2 class="mt-2 text-[30px] leading-[1] text-[var(--ink)] sm:text-[42px]"><?= esc($aboutTitle) ?></h2>
                        <p class="mt-3 text-sm leading-6 text-[var(--muted)] sm:text-[15px]"><?= esc(mb_strimwidth($aboutContent, 0, 220, '...')) ?></p>
                    </div>
                    <div class="hero-panel-tertiary parallax-node absolute bottom-[3%] right-0 w-[38%] overflow-hidden rounded-[1.5rem] shadow-[var(--shadow)]"
                         data-speed="0.09" data-depth="12">
                        <img class="h-[150px] w-full object-cover sm:h-[190px]"
                             src="<?= esc($pickVisual(5)) ?>" alt="Sudut budaya" loading="lazy">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── TENTANG ── -->
    <section id="tentang" class="shell py-10 sm:py-16">
        <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:gap-12">
            <div class="fade-up">
                <p class="section-label"><?= esc($aboutLabel) ?></p>
                <h2 class="mt-3 text-[40px] leading-[0.95] sm:text-[56px]"><?= esc($aboutTitle) ?></h2>
            </div>
            <div class="fade-up rounded-[2rem] bg-[var(--surface-soft)] p-7 shadow-[var(--shadow)] sm:p-10">
                <p class="text-[15px] leading-8 text-[var(--muted)] sm:text-[17px]"><?= nl2br(esc($aboutContent)) ?></p>
            </div>
        </div>
    </section>

    <!-- ── VIDEO ── -->
    <?php if ($videoEnabled): ?>
    <section class="shell pt-3 pb-10 sm:pt-5 sm:pb-16">
        <div class="fade-up parallax-node relative overflow-hidden rounded-[2.5rem] bg-[#3f382f] shadow-[var(--shadow)]" data-parallax-intensity="18">
            <?php if ($videoHighlight !== null): ?>
                <div class="relative h-[320px] w-full bg-black sm:h-[420px]">
                    <img class="absolute inset-0 h-full w-full object-cover opacity-35 scale-105" src="<?= esc($videoHighlight['poster']) ?>" alt="" loading="lazy">
                    <?php if (($videoHighlight['type'] ?? 'file') === 'embed'): ?>
                        <iframe class="autoplay-embed relative z-[1] h-full w-full"
                                data-autoplay-src="<?= esc($videoHighlight['src'], 'attr') ?>"
                                src="" title="<?= esc($videoHighlight['title']) ?>"
                                allow="autoplay; encrypted-media; picture-in-picture"
                                allowfullscreen loading="lazy"
                                referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    <?php else: ?>
                        <video class="adaptive-video autoplay-video relative z-[1] opacity-90"
                               data-audio-autoplay="true"
                               poster="<?= esc($videoHighlight['poster']) ?>"
                               autoplay loop playsinline preload="metadata">
                            <source src="<?= esc($videoHighlight['src']) ?>" type="<?= esc($videoHighlight['mime']) ?>">
                        </video>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <img class="h-[320px] w-full object-cover opacity-80 sm:h-[420px]"
                     src="<?= esc($pickVisual(6)) ?>" alt="Video highlight Balkondes Bumiharjo" loading="lazy">
            <?php endif; ?>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-black/10"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <button type="button"
                        class="video-trigger flex h-16 w-16 items-center justify-center rounded-full bg-white text-[var(--gold)] shadow-[0_20px_40px_rgba(0,0,0,0.18)] transition hover:scale-105 sm:h-20 sm:w-20"
                        aria-label="Putar highlight video"
                        <?= $videoHighlight === null ? 'disabled' : '' ?>>
                    <span class="ml-1 text-2xl sm:text-3xl">&#9654;</span>
                </button>
            </div>
            <div class="absolute inset-x-0 bottom-0 p-6 text-white sm:p-10">
                <p class="text-[11px] font-semibold uppercase tracking-[0.34em] text-white/70">Video Highlight</p>
                <h2 class="mt-2 text-[34px] leading-none sm:text-[56px]"><?= esc($videoTitle) ?></h2>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── FASILITAS ── -->
    <section id="fasilitas" class="bg-[var(--surface-soft)] py-16 sm:py-24">
        <div class="shell">
            <div class="fade-up max-w-2xl">
                <p class="section-label"><?= esc($servicesLabel) ?></p>
                <h2 class="mt-3 text-[40px] leading-[0.95] sm:text-[58px]"><?= esc($servicesTitle) ?></h2>
                <p class="mt-4 text-[15px] leading-7 text-[var(--muted)] sm:text-[17px]"><?= esc($servicesIntro) ?></p>
            </div>

            <div class="mt-10 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
                <?php foreach (array_slice($serviceCards, 0, 4) as $index => $service): ?>
                <article class="fade-up parallax-node group relative overflow-hidden rounded-[2rem] bg-[#2d241d] shadow-[var(--shadow)] <?= $index % 2 === 1 ? 'sm:translate-y-8' : '' ?>"
                         data-parallax-intensity="<?= esc((string) (14 + ($index % 2 === 0 ? 6 : 10))) ?>">
                    <img class="h-[320px] w-full object-cover opacity-80 transition duration-700 group-hover:scale-105 group-hover:opacity-100"
                         src="<?= esc($service['image']) ?>" alt="<?= esc($service['title']) ?>" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/35 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                        <h3 class="text-[30px] leading-none"><?= esc($service['title']) ?></h3>
                        <p class="mt-3 text-sm leading-6 text-white/70"><?= esc(mb_strimwidth($service['description'], 0, 120, '...')) ?></p>
                        <!-- FIXED: type="button" wajib pada tombol di luar form -->
                        <button type="button"
                                class="service-trigger mt-5 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.28em] text-[var(--gold-soft)]"
                                data-title="<?= esc($service['title'], 'attr') ?>"
                                data-description="<?= esc($service['description'], 'attr') ?>"
                                data-image="<?= esc($service['image'], 'attr') ?>"
                                data-points="<?= esc(json_encode($service['points'], JSON_UNESCAPED_UNICODE), 'attr') ?>">
                            Lihat Detail <span aria-hidden="true">+</span>
                        </button>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── GALERI ── -->
    <section id="galeri" class="shell py-16 sm:py-24">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div class="fade-up max-w-2xl">
                <p class="section-label"><?= esc($galleryLabel) ?></p>
                <h2 class="mt-3 text-[40px] leading-[0.95] sm:text-[58px]"><?= esc($galleryTitle) ?></h2>
                <p class="mt-4 text-[15px] leading-7 text-[var(--muted)] sm:text-[17px]"><?= esc($galleryIntro) ?></p>
            </div>
            <a class="fade-up inline-flex w-fit rounded-full border border-[var(--gold-soft)] px-5 py-3 text-sm font-semibold text-[var(--gold)] transition hover:bg-[var(--gold)] hover:text-white"
               href="<?= esc($heroBookingUrl) ?>">Booking dan Kontak</a>
        </div>

        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach (array_slice($galleryVisuals, 0, 6) as $index => $visual): ?>
            <?php $spanClass = in_array($index, [0, 4], true) ? 'lg:col-span-2' : ''; ?>
            <button type="button"
                    class="gallery-trigger fade-up parallax-node group relative overflow-hidden rounded-[1.8rem] shadow-[var(--shadow)] <?= esc($spanClass) ?>"
                    data-parallax-intensity="<?= esc((string) ($spanClass !== '' ? 20 : 12)) ?>"
                    data-src="<?= esc($visual['src'], 'attr') ?>"
                    data-type="<?= esc($visual['type'] ?? 'image', 'attr') ?>"
                    data-mime="<?= esc($visual['mime'] ?? '', 'attr') ?>"
                    data-poster="<?= esc($visual['poster'] ?? '', 'attr') ?>"
                    data-title="<?= esc($visual['title'], 'attr') ?>"
                    data-caption="<?= esc($visual['caption'], 'attr') ?>">

                <?php if (($visual['type'] ?? 'image') === 'video'): ?>
                    <div class="h-[210px] w-full bg-black sm:h-[260px] <?= $spanClass !== '' ? 'lg:h-[300px]' : '' ?>">
                        <video class="adaptive-video transition duration-700 group-hover:scale-105"
                               poster="<?= esc($visual['poster'] ?? $fallbackVisual($index + 2)) ?>"
                               muted playsinline preload="metadata">
                            <source src="<?= esc($visual['src']) ?>" type="<?= esc($visual['mime'] ?? 'video/mp4') ?>">
                        </video>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="flex h-14 w-14 items-center justify-center rounded-full bg-white/90 text-xl text-[var(--gold)] shadow-[0_20px_40px_rgba(0,0,0,0.18)]" aria-hidden="true">&#9654;</span>
                    </div>
                <?php else: ?>
                    <img class="h-[210px] w-full object-cover transition duration-700 group-hover:scale-105 sm:h-[260px] <?= $spanClass !== '' ? 'lg:h-[300px]' : '' ?>"
                         src="<?= esc($visual['src']) ?>" alt="<?= esc($visual['title']) ?>" loading="lazy">
                <?php endif; ?>
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-80"></div>
                <div class="absolute bottom-0 left-0 right-0 p-5 text-left text-white">
                    <p class="text-lg leading-none sm:text-xl"><?= esc($visual['title']) ?></p>
                </div>
            </button>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ── LOKASI ── -->
    <section id="lokasi" class="bg-[var(--surface-soft)] py-16 sm:py-24">
        <div class="shell">
            <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr]">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="fade-up parallax-node overflow-hidden rounded-[2rem] shadow-[var(--shadow)] sm:col-span-2" data-parallax-intensity="14">
                        <img class="h-[280px] w-full object-cover sm:h-[360px]" src="<?= esc($pickVisual(7)) ?>" alt="Balkondes Bumiharjo exterior" loading="lazy">
                    </div>
                    <div class="fade-up parallax-node overflow-hidden rounded-[2rem] shadow-[var(--shadow)]" data-parallax-intensity="10">
                        <img class="h-[220px] w-full object-cover sm:h-[280px]" src="<?= esc($pickVisual(3)) ?>" alt="Aktivitas warga" loading="lazy">
                    </div>
                    <div class="fade-up parallax-node overflow-hidden rounded-[2rem] shadow-[var(--shadow)]" data-parallax-intensity="16">
                        <img class="h-[220px] w-full object-cover sm:h-[280px]" src="<?= esc($pickVisual(5)) ?>" alt="Detail interior" loading="lazy">
                    </div>
                </div>

                <div class="fade-up self-end">
                    <p class="section-label"><?= esc($locationLabel) ?></p>
                    <h2 class="mt-3 text-[40px] leading-[0.95] sm:text-[58px]"><?= esc($locationTitle) ?></h2>
                    <p class="mt-4 text-[15px] leading-7 text-[var(--muted)] sm:text-[17px]"><?= esc($locationIntro) ?></p>
                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-[1.8rem] bg-white p-5 shadow-[var(--shadow)]">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold)]">Alamat</p>
                            <p class="mt-3 text-sm leading-7 text-[var(--muted)]"><?= esc($address) ?></p>
                        </div>
                        <div class="rounded-[1.8rem] bg-white p-5 shadow-[var(--shadow)]">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold)]">Operasional</p>
                            <p class="mt-3 text-sm leading-7 text-[var(--muted)]"><?= esc($openingHours) ?></p>
                        </div>
                    </div>
                    <div class="mt-4 rounded-[2rem] bg-white p-5 shadow-[var(--shadow)]">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold)]">Kontak</p>
                        <p class="mt-3 text-sm leading-7 text-[var(--muted)]">WhatsApp <?= esc($whatsAppNumber) ?></p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <a class="inline-flex rounded-full bg-[var(--gold)] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#9d723e]"
                               href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener">Hubungi Sekarang</a>
                            <a class="inline-flex rounded-full bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--ink)] transition hover:bg-[var(--surface-deep)]"
                               href="<?= esc($heroBookingUrl) ?>">Lihat Semua Link</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fade-up parallax-node mt-8 overflow-hidden rounded-[2rem] shadow-[var(--shadow)]" data-parallax-intensity="10">
                <iframe title="Peta Balkondes Bumiharjo"
                        src="<?= esc($mapsEmbed, 'attr') ?>"
                        class="h-[320px] w-full border-0 sm:h-[420px]"
                        loading="lazy" allowfullscreen></iframe>
            </div>
        </div>
    </section>

</main>

<!-- ── Floating dock ── -->
<div class="floating-dock">
    <a class="inline-flex rounded-full bg-[#1d4d3d] px-5 py-3 text-sm font-semibold text-white"
       href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener">WhatsApp</a>
    <a class="inline-flex rounded-full bg-[var(--gold)] px-5 py-3 text-sm font-semibold text-white"
       href="<?= esc($heroBookingUrl) ?>">Booking Hub</a>
</div>

<!-- ── Footer ── -->
<footer class="bg-[#3a3028] pb-10 pt-16 text-white">
    <div class="shell">
        <div class="grid gap-10 md:grid-cols-4">
            <div>
                <p class="text-[28px] leading-none text-[var(--gold-soft)]"><?= esc($footerTitle) ?></p>
                <p class="mt-4 text-sm leading-7 text-white/65"><?= esc($footerDescription) ?></p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold-soft)]">Menu</p>
                <div class="mt-4 space-y-3 text-sm text-white/70">
                    <a class="block transition hover:text-white" href="#tentang">Tentang</a>
                    <a class="block transition hover:text-white" href="#fasilitas">Fasilitas</a>
                    <a class="block transition hover:text-white" href="#galeri">Galeri</a>
                    <a class="block transition hover:text-white" href="#lokasi">Lokasi</a>
                </div>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold-soft)]">Reservasi</p>
                <div class="mt-4 space-y-3 text-sm text-white/70">
                    <a class="block transition hover:text-white" href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener">WhatsApp</a>
                    <a class="block transition hover:text-white" href="<?= esc($heroBookingUrl) ?>">Booking Hub</a>
                    <a class="block transition hover:text-white" href="<?= esc($instagramUrl) ?>" target="_blank" rel="noopener">Instagram</a>
                    <a class="block transition hover:text-white" href="<?= esc($mapsUrl) ?>" target="_blank" rel="noopener">Google Maps</a>
                </div>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold-soft)]">Alamat</p>
                <p class="mt-4 text-sm leading-7 text-white/70"><?= esc($address) ?></p>
            </div>
        </div>
        <div class="mt-10 flex flex-wrap items-end justify-between gap-4 border-t border-white/10 pt-6 text-sm text-white/40">
            <a href="<?= esc(app_relative_url('gerbang-senja-bumiharjo')) ?>" class="hidden-entry" aria-label="Akses admin tersembunyi" title="Akses admin tersembunyi"></a>
            <div class="flex-1 text-center md:pr-6">
                &copy; <?= esc(date('Y')) ?> <?= esc($companyName) ?>. Seluruh hak cipta dilindungi.
            </div>
            <div class="hidden w-[14px] md:block" aria-hidden="true"></div>
        </div>
    </div>
</footer>

<!-- ═══════════════════════════════════════════════════════════════════
     MODALS
═══════════════════════════════════════════════════════════════════ -->

<!-- Service modal -->
<div id="service-modal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/55 px-4 py-8" role="dialog" aria-modal="true" aria-label="Detail layanan">
    <div class="relative max-h-[92vh] w-full max-w-4xl overflow-auto rounded-[2rem] bg-[var(--surface-soft)] shadow-[0_35px_80px_rgba(0,0,0,0.28)]">
        <button type="button" class="service-close absolute right-4 top-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/85 text-xl text-[var(--ink)]" aria-label="Tutup">&times;</button>
        <div class="grid lg:grid-cols-[0.95fr_1.05fr]">
            <div class="overflow-hidden">
                <img id="service-modal-image" class="h-[260px] w-full object-cover lg:h-full" src="" alt="Detail layanan">
            </div>
            <div class="p-6 sm:p-8 lg:p-10">
                <p class="section-label">Detail Layanan</p>
                <h3 id="service-modal-title" class="mt-3 text-[42px] leading-none text-[var(--ink)]"></h3>
                <p id="service-modal-description" class="mt-5 text-[15px] leading-8 text-[var(--muted)]"></p>
                <div id="service-modal-points" class="mt-6 space-y-3"></div>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a class="inline-flex rounded-full bg-[var(--gold)] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#9d723e]"
                       href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener">Tanya via WhatsApp</a>
                    <a class="inline-flex rounded-full bg-white px-5 py-3 text-sm font-semibold text-[var(--ink)] shadow-[var(--shadow)]"
                       href="<?= esc($heroBookingUrl) ?>">Lihat Booking Hub</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gallery lightbox -->
<div id="gallery-lightbox" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 px-4 py-8" role="dialog" aria-modal="true" aria-label="Galeri foto">
    <button type="button" class="gallery-close absolute right-5 top-5 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/15 text-2xl text-white" aria-label="Tutup">&times;</button>
    <div class="w-full max-w-5xl">
        <img id="gallery-lightbox-image" class="max-h-[76vh] w-full rounded-[1.8rem] object-cover shadow-[0_30px_70px_rgba(0,0,0,0.35)]" src="" alt="Galeri Balkondes Bumiharjo">
        <video id="gallery-lightbox-video" class="hidden max-h-[76vh] w-full rounded-[1.8rem] bg-black object-contain shadow-[0_30px_70px_rgba(0,0,0,0.35)]" controls playsinline preload="metadata"></video>
        <div class="mx-auto mt-5 max-w-2xl text-center text-white">
            <p id="gallery-lightbox-title" class="text-2xl"></p>
            <p id="gallery-lightbox-caption" class="mt-2 text-sm leading-7 text-white/75"></p>
        </div>
    </div>
</div>

<!-- Video modal -->
<div id="video-modal" class="fixed inset-0 z-[75] hidden items-center justify-center bg-black/75 px-4 py-8" role="dialog" aria-modal="true" aria-label="Video highlight">
    <button type="button" class="video-close absolute right-5 top-5 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/15 text-2xl text-white" aria-label="Tutup">&times;</button>
    <div class="w-full max-w-4xl overflow-hidden rounded-[2rem] bg-black shadow-[0_30px_80px_rgba(0,0,0,0.4)]">
        <div class="relative aspect-video">
            <?php if ($videoHighlight !== null): ?>
                <?php if (($videoHighlight['type'] ?? 'file') === 'embed'): ?>
                    <iframe id="video-modal-embed"
                            class="h-full w-full"
                            data-src="<?= esc($videoHighlight['modal_src'] ?? $videoHighlight['src'], 'attr') ?>"
                            src=""
                            title="<?= esc($videoHighlight['title']) ?>"
                            allow="autoplay; encrypted-media; picture-in-picture"
                            allowfullscreen loading="lazy"
                            referrerpolicy="strict-origin-when-cross-origin"></iframe>
                <?php else: ?>
                    <video id="video-modal-player"
                           class="h-full w-full bg-black object-contain"
                           controls playsinline preload="auto"
                           poster="<?= esc($videoHighlight['poster']) ?>">
                        <source src="<?= esc($videoHighlight['src']) ?>" type="<?= esc($videoHighlight['mime']) ?>">
                    </video>
                <?php endif; ?>
            <?php else: ?>
                <img class="h-full w-full object-cover opacity-45" src="<?= esc($pickVisual(6)) ?>" alt="Video highlight" loading="lazy">
                <div class="absolute inset-0 flex items-center justify-center p-8 text-center text-white">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.34em] text-white/70">Video Highlight</p>
                        <h3 class="mt-3 text-[34px] leading-none sm:text-[48px]"><?= esc($videoTitle) ?></h3>
                        <p class="mx-auto mt-4 max-w-xl text-sm leading-7 text-white/75 sm:text-base"><?= esc($videoCaption) ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════
     JAVASCRIPT
     ─────────────────────────────────────────────────────────────────
     Arsitektur:
     1. SETUP          – deteksi preferensi, cache DOM
     2. PARALLAX LOOP  – satu rAF untuk scroll-orbs, hero-depth,
                         scene cards, fade-up (dua arah)
     3. MOUSE TILT     – hero panels tilt on pointer move (desktop only)
     4. VIDEO HELPERS  – autoplay, embed activate/deactivate
     5. MENU           – mobile nav toggle
     6. MODALS         – service / gallery / video
     7. AUTOPLAY OBS   – IntersectionObserver untuk video in-viewport
═══════════════════════════════════════════════════════════════════ -->
<script>
(function () {
    'use strict';

    /* ── 1. SETUP ──────────────────────────────────────────────────── */

    const PRM = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const IS_DESKTOP = () => window.innerWidth >= 1024;
    const NAV_BAR = document.querySelector('nav');
    const SMART_SNAP_IDS = ['home', 'tentang', 'fasilitas', 'galeri', 'lokasi'];
    const SMART_SNAP_TARGETS = SMART_SNAP_IDS.map((id) => document.getElementById(id)).filter(Boolean);
    let smartSnapTimer = null;
    let smartSnapLocked = false;
    let smartSnapReleaseTimeout = null;

    /* Aktifkan kelas motion hanya jika user tidak prefer reduced */
    if (!PRM) {
        document.documentElement.classList.add('motion-enhanced');
    }

    const canUseSmartSnap = () => !PRM && window.innerWidth >= 1024 && SMART_SNAP_TARGETS.length > 1;

    const getSmartSnapOffset = () => {
        const navHeight = NAV_BAR ? NAV_BAR.getBoundingClientRect().height : 0;
        return navHeight + 18;
    };

    const releaseSmartSnapLock = (delay = 0) => {
        window.clearTimeout(smartSnapReleaseTimeout);

        if (delay <= 0) {
            smartSnapLocked = false;
            return;
        }

        smartSnapReleaseTimeout = window.setTimeout(() => {
            smartSnapLocked = false;
        }, delay);
    };

    const queueSmartSnap = () => {
        window.clearTimeout(smartSnapTimer);

        if (!canUseSmartSnap() || smartSnapLocked) {
            return;
        }

        smartSnapTimer = window.setTimeout(() => {
            if (smartSnapLocked || window.scrollY < 24) {
                return;
            }

            const currentY = window.scrollY;
            const maxSnapDistance = Math.min(220, window.innerHeight * 0.24);
            const offset = getSmartSnapOffset();
            let nearestTarget = null;
            let nearestDistance = Number.POSITIVE_INFINITY;

            for (const target of SMART_SNAP_TARGETS) {
                const targetTop = currentY + target.getBoundingClientRect().top - offset;
                const distance = Math.abs(targetTop - currentY);

                if (distance < nearestDistance) {
                    nearestDistance = distance;
                    nearestTarget = target;
                }
            }

            if (!nearestTarget || nearestDistance < 20 || nearestDistance > maxSnapDistance) {
                return;
            }

            smartSnapLocked = true;
            releaseSmartSnapLock(560);

            window.scrollTo({
                top: Math.max(0, currentY + nearestTarget.getBoundingClientRect().top - offset),
                behavior: 'smooth',
            });
        }, 140);
    };

    /* ── 2. PARALLAX / FADE LOOP ───────────────────────────────────── */

    if (!PRM) {

        /*
         * State — semua nilai disimpan di sini; tidak ada global yang tersebar.
         */
        const state = {
            scrollY: window.scrollY,
            scrollYSmooth: window.scrollY,   // smoothed scroll untuk parallax
            lastScrollY: window.scrollY,   // untuk menghitung scroll direction
            scrollVelocity: 0,                  // untuk efek berbasis kecepatan scroll
            scrollVelocitySmooth: 0,           // smoothed scroll velocity
            vH: window.innerHeight,
            ptrX: 0, ptrY: 0,                // target pointer (normalized -0.5..0.5)
            ptrXS: 0, ptrYS: 0,              // smoothed pointer
        };

        /*
         * Cache DOM — dikumpulkan sekali, bukan setiap frame.
         */
        const DOM = {
            fadeItems:    [...document.querySelectorAll('.fade-up')],
            speedNodes:   [...document.querySelectorAll('[data-speed]:not([data-depth])')],
            depthNodes:   [...document.querySelectorAll('[data-depth]')],
            sceneNodes:   [...document.querySelectorAll('[data-parallax-intensity]')],
            heroBackdrop: document.querySelector('.hero-backdrop'),
            heroMouse:    document.getElementById('js-hero-mouse'),
        };

        DOM.fadeItems.forEach((el, index) => {
        const delay = Math.min(index * 90, 540);
        el.style.setProperty('--fd', `${delay}ms`);
        });

        
        /*
         * Lerp helper — linear interpolation
         * α kecil = lebih smooth / lambat; α besar = responsif
         */
        const lerp = (a, b, α) => a + (b - a) * α;

        /*
         * Clamp
         */
        const clamp = (v, lo, hi) => Math.max(lo, Math.min(hi, v));

        /*
         * setVar — wrapper agar tidak ada string concatenation di hot path
         */
        const setY  = (el, v)    => el.style.setProperty('--py', v.toFixed(2) + 'px');
        const setXY = (el, x, y) => {
            el.style.setProperty('--px', x.toFixed(2) + 'px');
            el.style.setProperty('--py', y.toFixed(2) + 'px');
        };
        const setScale  = (el, s) => el.style.setProperty('--ps', s.toFixed(4));
        const setRotate = (el, r) => el.style.setProperty('--pr', r.toFixed(3) + 'deg');

        /*
         * computeFade — menghitung opacity & shift-Y berdasarkan posisi
         * elemen relatif terhadap viewport anchor.
         * Bekerja DWIDIARAH: saat scroll naik maupun turun nilai berubah.
         */
        const FADE_ANCHOR = 0.52;   // titik "paling visible" = 52% dari atas viewport
        const FADE_RANGE  = 1.2;   // zona pengaruh (proporsi viewport)

        const computeFade = (rect) => {
            const elCenter   = rect.top + rect.height / 2;
            const anchor     = state.vH * FADE_ANCHOR;
            const range      = state.vH * FADE_RANGE + rect.height * 0.6;
            const dist       = Math.abs(elCenter - anchor);
            const t          = clamp(1 - dist / range, 0, 1);

            /* easeOutCubic untuk feel smooth */
            const ease = 1 - Math.pow(1 - t, 3);

            const opacity    = clamp(0.02 + ease * 0.98, 0, 1);
            const direction  = elCenter > anchor ? 1 : -1;
            const shift      = (1 - ease) * 18 * direction;

            return { opacity, shift };
        };

        /*
         * Main render loop — satu rAF, semua efek di dalam.
         */
        const tick = () => {

            /* Smooth scroll */
            state.scrollYSmooth = lerp(state.scrollYSmooth, state.scrollY, 0.08);
            state.scrollVelocitySmooth = lerp(state.scrollVelocitySmooth, state.scrollVelocity, 0.12);
            state.scrollVelocity *= 0.88;

            state.ptrXS = lerp(state.ptrXS, state.ptrX, 0.06);
            state.ptrYS = lerp(state.ptrYS, state.ptrY, 0.06);
            const sY       = state.scrollYSmooth;
            const vBoost = clamp(state.scrollVelocitySmooth, -56, 56);
            const desktop  = IS_DESKTOP();

            /* ── Orbs & grid (speed nodes) ── */
            for (const node of DOM.speedNodes) {
                const speed = parseFloat(node.dataset.speed) || 0;
                const y = (sY * speed * -0.15) + (vBoost * speed * -1.1);
                setY(node, y);
            }

            /* ── Hero depth panels (mouse + scroll) ── */
            for (const node of DOM.depthNodes) {
                const depth = parseFloat(node.dataset.depth) || 0;
                const speed = parseFloat(node.dataset.speed) || 0;

                const tX  = desktop ? state.ptrXS * depth * 0.75 : 0;
                const tY  = (sY * speed * -0.13)
                            + (vBoost * speed * -0.9)
                            + (desktop ? state.ptrYS * depth * 0.55 : 0);
                const rot = desktop ? state.ptrXS * depth * 0.028 : 0;

                setXY(node, tX, tY);
                if (rot !== 0) setRotate(node, rot);
            }

            /* ── Scene cards (scroll-based translate) ── */
            for (const node of DOM.sceneNodes) {
                const rect      = node.getBoundingClientRect();
                const intensity = parseFloat(node.dataset.parallaxIntensity) || 0;
                /* progress 0→1 saat elemen masuk viewport dari bawah ke atas */
                const progress  = clamp((state.vH - rect.top) / (state.vH + rect.height), 0, 1);
                const tY        = ((progress - 0.5) * intensity * -1.4) + (vBoost * 0.24);
                setY(node, tY);
            }

            /* ── Hero backdrop (scale + translate) ── */
            if (DOM.heroBackdrop) {
                const scale = 1.04 + clamp(sY / 5000, 0, 0.06);
                const tY = (sY * -0.018) + (vBoost * -0.12);
                setY(DOM.heroBackdrop, tY);
                setScale(DOM.heroBackdrop, scale);
                /* filter: DILARANG — tidak dipasang */
            }

            /* ── Fade-up items (bidirectional) ── */
            for (const el of DOM.fadeItems) {
                const rect = el.getBoundingClientRect();
                /* Skip elemen yang jauh di luar viewport agar tidak mubazir */
                if (rect.bottom < -200 || rect.top > state.vH + 200) continue;

                const { opacity, shift } = computeFade(rect);
                el.style.setProperty('--fo', opacity.toFixed(3));
                el.style.setProperty('--fs', shift.toFixed(1) + 'px');
            }

            requestAnimationFrame(tick);
        };

        /* Scroll listener — hanya update state, rAF yang render */

        window.addEventListener('scroll', () => {
            const nextY = window.scrollY;
            const delta = nextY - state.lastScrollY;

            state.scrollY = nextY;
            state.scrollVelocity = delta;
            state.lastScrollY = nextY;

            if (Math.abs(delta) < 120) {
                queueSmartSnap();
            }
        }, { passive: true });

        /* Resize listener */
        window.addEventListener('resize', () => {
            state.vH      = window.innerHeight;
            state.scrollY = window.scrollY;
            if (!IS_DESKTOP()) {
                state.ptrX = state.ptrY = 0;
            }

            window.clearTimeout(smartSnapTimer);
            releaseSmartSnapLock();
        });

        /* ── 3. MOUSE TILT ── */
        if (DOM.heroMouse) {
            DOM.heroMouse.addEventListener('pointermove', (e) => {
                if (!IS_DESKTOP()) return;
                const rect = DOM.heroMouse.getBoundingClientRect();
                state.ptrX = (e.clientX - rect.left) / rect.width  - 0.5;
                state.ptrY = (e.clientY - rect.top)  / rect.height - 0.5;
            });
            DOM.heroMouse.addEventListener('pointerleave', () => {
                state.ptrX = state.ptrY = 0;
            });
        }

        /* Kick off */
        requestAnimationFrame(tick);
    }


    /* ── 4. VIDEO HELPERS ──────────────────────────────────────────── */

    let mediaAudioUnlocked = false;

    const safePlay = (video, withSound = false) => {
        if (!video) return;
        video.muted = !withSound;
        video.defaultMuted = !withSound;
        const p = video.play();
        if (p && p.catch) p.catch(() => {});
    };

    const safePause = (video) => {
        if (!video) return;
        try { video.pause(); } catch (_) {}
    };

    const activateEmbed = (frame) => {
        if (!frame) return;
        const src = frame.dataset.autoplaySrc || frame.dataset.src || '';
        if (src && frame.getAttribute('src') !== src) frame.setAttribute('src', src);
    };

    const deactivateEmbed = (frame) => {
        if (!frame) return;
        frame.setAttribute('src', '');
    };

    const syncVideoFit = (video) => {
        if (!video || !video.videoWidth) return;
        video.dataset.fit = video.videoWidth / video.videoHeight < 1.2 ? 'contain' : 'cover';
    };

    const isElementVisibleEnough = (element, threshold = 0.3) => {
        if (!element) return false;

        const rect = element.getBoundingClientRect();
        const viewportHeight = window.innerHeight || document.documentElement.clientHeight;
        const viewportWidth = window.innerWidth || document.documentElement.clientWidth;

        if (rect.width <= 0 || rect.height <= 0) {
            return false;
        }

        const visibleWidth = Math.max(0, Math.min(rect.right, viewportWidth) - Math.max(rect.left, 0));
        const visibleHeight = Math.max(0, Math.min(rect.bottom, viewportHeight) - Math.max(rect.top, 0));
        const visibleArea = visibleWidth * visibleHeight;
        const totalArea = rect.width * rect.height;

        if (totalArea <= 0) {
            return false;
        }

        return (visibleArea / totalArea) >= threshold;
    };

    const unlockMediaAudio = () => {
        if (mediaAudioUnlocked) return;

        mediaAudioUnlocked = true;

        document.querySelectorAll('.autoplay-video[data-audio-autoplay="true"]').forEach((video) => {
            video.muted = false;
            video.defaultMuted = false;

            if (isElementVisibleEnough(video, 0.3)) {
                safePlay(video, true);
            }
        });
    };

    ['pointerdown', 'touchstart', 'keydown'].forEach((eventName) => {
        window.addEventListener(eventName, unlockMediaAudio, { passive: true, once: true });
    });

    /* Fix object-fit saat metadata loaded */
    document.querySelectorAll('.adaptive-video, .autoplay-video').forEach((v) => {
        syncVideoFit(v);
        v.addEventListener('loadedmetadata', () => syncVideoFit(v), { once: true });
    });

    /* IntersectionObserver — autoplay saat masuk viewport */
    if (!PRM) {
        const autoObs = new IntersectionObserver((entries) => {
            entries.forEach(({ target: el, isIntersecting, intersectionRatio }) => {
                if (el instanceof HTMLVideoElement) {
                    if (isIntersecting && intersectionRatio >= 0.3) {
                        const wantsSound = el.dataset.audioAutoplay === 'true' && mediaAudioUnlocked;
                        safePlay(el, wantsSound);
                    } else if (!el.closest('#video-modal') && !el.closest('#gallery-lightbox')) {
                        safePause(el);
                    }
                }
                if (el instanceof HTMLIFrameElement) {
                    if (isIntersecting && intersectionRatio >= 0.3) activateEmbed(el);
                    else if (!el.closest('#video-modal'))             deactivateEmbed(el);
                }
            });
        }, { threshold: [0.2, 0.3, 0.6] });

        document.querySelectorAll('.autoplay-video').forEach((v) => autoObs.observe(v));
        document.querySelectorAll('.autoplay-embed').forEach((f) => autoObs.observe(f));
    }


    /* ── 5. MENU ───────────────────────────────────────────────────── */

    const menuToggle = document.getElementById('js-menu-toggle');
    const menuSheet  = document.getElementById('js-menu-sheet');

    if (menuToggle && menuSheet) {
        const openMenu = () => {
            menuSheet.classList.remove('hidden');
            menuSheet.classList.add('block');
            menuToggle.textContent = '✕';
            menuToggle.setAttribute('aria-expanded', 'true');
        };
        const closeMenu = () => {
            menuSheet.classList.add('hidden');
            menuSheet.classList.remove('block');
            menuToggle.textContent = '☰';
            menuToggle.setAttribute('aria-expanded', 'false');
        };

        menuToggle.addEventListener('click', () => {
            menuSheet.classList.contains('hidden') ? openMenu() : closeMenu();
        });

        /* Tutup menu saat klik link di dalam sheet */
        menuSheet.querySelectorAll('a').forEach((a) => {
            a.addEventListener('click', closeMenu);
        });

        /* Tutup menu saat resize ke desktop */
        window.addEventListener('resize', () => {
            if (IS_DESKTOP()) closeMenu();
        });
    }


    /* ── 6. MODALS ─────────────────────────────────────────────────── */

    const toggleModal = (modal, open) => {
        if (!modal) return;
        modal.classList.toggle('hidden', !open);
        modal.classList.toggle('flex', open);
        document.body.classList.toggle('no-scroll', open);

        /* Accessibility: focus trap sederhana */
        if (open) {
            const focusable = modal.querySelectorAll('button, a, input, [tabindex]');
            if (focusable.length) focusable[0].focus();
        }
    };

    /* Backdrop click helper */
    const onBackdropClick = (modal, onClose) => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) onClose();
        });
    };

    /* ── Service modal ── */
    const serviceModal       = document.getElementById('service-modal');
    const serviceModalImg    = document.getElementById('service-modal-image');
    const serviceModalTitle  = document.getElementById('service-modal-title');
    const serviceModalDesc   = document.getElementById('service-modal-description');
    const serviceModalPoints = document.getElementById('service-modal-points');

    document.querySelectorAll('.service-trigger').forEach((btn) => {
        btn.addEventListener('click', () => {
            serviceModalTitle.textContent = btn.dataset.title || '';
            serviceModalDesc.textContent  = btn.dataset.description || '';
            serviceModalImg.src           = btn.dataset.image || '';
            serviceModalImg.alt           = btn.dataset.title || 'Detail layanan';

            let points = [];
            try { points = JSON.parse(btn.dataset.points || '[]'); } catch (_) {}

            serviceModalPoints.innerHTML = points.map((p) =>
                `<div class="flex items-start gap-3 rounded-[1.2rem] bg-white px-4 py-3 text-sm leading-6 text-[var(--muted)] shadow-[var(--shadow)]">
                    <span class="mt-1 text-[var(--gold)]">&#9679;</span>
                    <span>${p}</span>
                </div>`
            ).join('');

            toggleModal(serviceModal, true);
        });
    });

    document.querySelectorAll('.service-close').forEach((btn) => {
        btn.addEventListener('click', () => toggleModal(serviceModal, false));
    });
    onBackdropClick(serviceModal, () => toggleModal(serviceModal, false));

    /* ── Gallery lightbox ── */
    const lightbox        = document.getElementById('gallery-lightbox');
    const lbImage         = document.getElementById('gallery-lightbox-image');
    const lbVideo         = document.getElementById('gallery-lightbox-video');
    const lbTitle         = document.getElementById('gallery-lightbox-title');
    const lbCaption       = document.getElementById('gallery-lightbox-caption');

    const closeLightbox = () => {
        safePause(lbVideo);
        toggleModal(lightbox, false);
    };

    document.querySelectorAll('.gallery-trigger').forEach((btn) => {
        btn.addEventListener('click', () => {
            const type   = btn.dataset.type   || 'image';
            const src    = btn.dataset.src    || '';
            const mime   = btn.dataset.mime   || 'video/mp4';
            const poster = btn.dataset.poster || '';

            if (type === 'video') {
                lbImage.classList.add('hidden');
                lbImage.removeAttribute('src');
                lbVideo.classList.remove('hidden');
                lbVideo.poster   = poster;
                lbVideo.innerHTML = `<source src="${src}" type="${mime}">`;
                lbVideo.load();
            } else {
                safePause(lbVideo);
                lbVideo.classList.add('hidden');
                lbVideo.innerHTML = '';
                lbImage.classList.remove('hidden');
                lbImage.src = src;
            }

            lbTitle.textContent   = btn.dataset.title   || '';
            lbCaption.textContent = btn.dataset.caption || '';
            toggleModal(lightbox, true);
        });
    });

    document.querySelectorAll('.gallery-close').forEach((btn) => {
        btn.addEventListener('click', closeLightbox);
    });
    onBackdropClick(lightbox, closeLightbox);

    /* ── Video modal ── */
    const videoModal  = document.getElementById('video-modal');
    const videoPlayer = document.getElementById('video-modal-player');
    const videoEmbed  = document.getElementById('video-modal-embed');

    const closeVideoModal = () => {
        safePause(videoPlayer);
        deactivateEmbed(videoEmbed);
        toggleModal(videoModal, false);
    };

    document.querySelectorAll('.video-trigger').forEach((btn) => {
        btn.addEventListener('click', () => {
            if (btn.hasAttribute('disabled')) return;
            toggleModal(videoModal, true);
            if (videoPlayer) {
                videoPlayer.currentTime = 0;
                mediaAudioUnlocked = true;
                safePlay(videoPlayer, true);
            }
            if (videoEmbed)  activateEmbed(videoEmbed);
        });
    });

    document.querySelectorAll('.video-close').forEach((btn) => {
        btn.addEventListener('click', closeVideoModal);
    });
    onBackdropClick(videoModal, closeVideoModal);

    /* ── Escape key — tutup semua modal ── */
    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') return;
        closeLightbox();
        closeVideoModal();
        toggleModal(serviceModal, false);
    });

    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', () => {
            window.clearTimeout(smartSnapTimer);
            smartSnapLocked = true;
            releaseSmartSnapLock(700);
        });
    });

})();
</script>
</body>
</html>
