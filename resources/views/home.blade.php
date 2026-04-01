<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->company_name ?? 'Balkondes Bumiharjo' }}</title>
    <meta name="description" content="{{ $settings->hero_subheadline ?? 'Website resmi Balkondes Bumiharjo' }}">
    <style>
        :root {
            --green-900: #103b2a;
            --green-800: #174f38;
            --green-700: #1d6a49;
            --green-500: #2d8f61;
            --green-100: #e9f6ef;
            --gold: #d7b56d;
            --slate-900: #0f172a;
            --slate-700: #334155;
            --slate-500: #64748b;
            --white: #ffffff;
            --bg: #f8fafc;
            --shadow: 0 20px 50px rgba(15, 23, 42, .10);
            --radius: 24px;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--slate-900);
            background: var(--bg);
        }

        a { text-decoration: none; color: inherit; }
        img, video { max-width: 100%; display: block; }

        .container {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(16px);
            background: rgba(255,255,255,.82);
            border-bottom: 1px solid rgba(148,163,184,.18);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 14px 0;
        }

        .brand strong {
            display: block;
            font-size: 18px;
            color: var(--green-900);
        }

        .brand span {
            display: block;
            font-size: 12px;
            color: var(--slate-500);
        }

        .nav-links {
            display: flex;
            gap: 18px;
            font-size: 14px;
            color: var(--slate-700);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 22px;
            border-radius: 999px;
            font-weight: bold;
            transition: .25s ease;
            border: 1px solid transparent;
        }

        .btn-primary {
            background: var(--green-700);
            color: white;
            box-shadow: 0 12px 30px rgba(29,106,73,.25);
        }

        .btn-primary:hover {
            background: var(--green-800);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(255,255,255,.12);
            color: white;
            border-color: rgba(255,255,255,.24);
        }

        .btn-outline {
            border-color: var(--green-700);
            color: var(--green-700);
            background: transparent;
        }

        .hero {
            position: relative;
            min-height: 92vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            color: white;
        }

        .hero-slide {
            position: absolute;
            inset: 0;
            background-position: center;
            background-size: cover;
            opacity: 0;
            transform: scale(1.05);
            transition: opacity 1s ease, transform 7s ease;
        }

        .hero-slide.active {
            opacity: 1;
            transform: scale(1);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(15,23,42,.42), rgba(15,23,42,.66)),
                linear-gradient(90deg, rgba(16,59,42,.72), rgba(16,59,42,.18));
            z-index: 1;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
            padding: 120px 0 90px;
            width: 100%;
        }

        .eyebrow {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.18);
            margin-bottom: 18px;
            font-size: 13px;
        }

        .hero h1 {
            margin: 0;
            font-size: clamp(38px, 7vw, 72px);
            line-height: 1.02;
            max-width: 780px;
        }

        .hero p {
            margin: 20px 0 0;
            font-size: clamp(16px, 2vw, 21px);
            line-height: 1.7;
            max-width: 760px;
            color: rgba(255,255,255,.92);
        }

        .hero-actions {
            margin-top: 28px;
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .hero-info {
            margin-top: 34px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            max-width: 920px;
        }

        .info-chip {
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 20px;
            padding: 18px;
            backdrop-filter: blur(6px);
        }

        .info-chip small {
            display: block;
            font-size: 12px;
            margin-bottom: 8px;
            color: rgba(255,255,255,.72);
        }

        .info-chip strong {
            font-size: 15px;
            line-height: 1.6;
        }

        .hero-dots {
            position: absolute;
            z-index: 3;
            left: 50%;
            bottom: 28px;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .hero-dot {
            width: 11px;
            height: 11px;
            border-radius: 999px;
            background: rgba(255,255,255,.35);
            border: 1px solid rgba(255,255,255,.35);
            transition: .25s ease;
        }

        .hero-dot.active {
            width: 28px;
            background: white;
        }

        section { padding: 90px 0; }

        .section-head {
            margin-bottom: 28px;
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: end;
        }

        .section-head h2 {
            margin: 0;
            font-size: clamp(28px, 4vw, 44px);
            color: var(--green-900);
            line-height: 1.1;
        }

        .section-head p {
            margin: 0;
            max-width: 650px;
            color: var(--slate-500);
            line-height: 1.8;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 28px;
            align-items: stretch;
        }

        .card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .about-copy {
            padding: 34px;
        }

        .about-copy p {
            margin: 0;
            color: var(--slate-700);
            line-height: 1.9;
            font-size: 16px;
        }

        .about-visual {
            background:
                linear-gradient(180deg, rgba(16,59,42,.15), rgba(16,59,42,.45)),
                url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            min-height: 380px;
            position: relative;
        }

        .about-badge {
            position: absolute;
            left: 24px;
            bottom: 24px;
            right: 24px;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.22);
            border-radius: 22px;
            color: white;
            padding: 18px;
            backdrop-filter: blur(10px);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .service-card {
            padding: 28px;
            height: 100%;
        }

        .service-icon {
            width: 58px;
            height: 58px;
            display: grid;
            place-items: center;
            border-radius: 18px;
            background: var(--green-100);
            font-size: 26px;
            margin-bottom: 18px;
        }

        .service-card h3 {
            margin: 0 0 12px;
            font-size: 22px;
            color: var(--green-900);
        }

        .service-card p {
            margin: 0;
            color: var(--slate-700);
            line-height: 1.8;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .gallery-card {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            background: #dfe9e2;
            min-height: 280px;
            box-shadow: var(--shadow);
        }

        .gallery-card img,
        .gallery-card video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-caption {
            position: absolute;
            left: 16px;
            right: 16px;
            bottom: 16px;
            padding: 14px 16px;
            border-radius: 16px;
            color: white;
            background: linear-gradient(180deg, rgba(15,23,42,.05), rgba(15,23,42,.78));
        }

        .gallery-caption strong {
            display: block;
            margin-bottom: 6px;
        }

        .gallery-caption span {
            font-size: 13px;
            line-height: 1.6;
            color: rgba(255,255,255,.88);
        }

        .contact-wrap {
            display: grid;
            grid-template-columns: .95fr 1.05fr;
            gap: 24px;
        }

        .contact-card {
            padding: 30px;
        }

        .contact-card h3 {
            margin: 0 0 18px;
            font-size: 28px;
            color: var(--green-900);
        }

        .contact-list {
            display: grid;
            gap: 16px;
            margin-bottom: 24px;
        }

        .contact-item {
            padding: 18px;
            background: #f8fafc;
            border-radius: 18px;
            border: 1px solid #e5e7eb;
        }

        .contact-item small {
            display: block;
            margin-bottom: 6px;
            color: var(--slate-500);
        }

        .contact-item strong,
        .contact-item div {
            color: #1e293b;
            line-height: 1.7;
        }

        .map-box iframe {
            width: 100%;
            min-height: 500px;
            border: 0;
        }

        .placeholder-map {
            min-height: 500px;
            display: grid;
            place-items: center;
            padding: 28px;
            background: linear-gradient(135deg, #ebf5ef, #d9ede0);
            color: var(--green-900);
            text-align: center;
            line-height: 1.8;
            font-weight: bold;
        }

        .footer {
            padding: 24px 0 42px;
            color: var(--slate-500);
            font-size: 14px;
        }

        .floating-wa {
            position: fixed;
            right: 18px;
            bottom: 18px;
            z-index: 99;
            background: #22c55e;
            color: white;
            padding: 14px 18px;
            border-radius: 999px;
            box-shadow: 0 18px 38px rgba(34,197,94,.28);
            font-weight: bold;
        }

        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: .7s ease;
        }

        .reveal.show {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 980px) {
            .hero-info,
            .services-grid,
            .gallery-grid,
            .about-grid,
            .contact-wrap {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }

            .section-head {
                flex-direction: column;
                align-items: start;
            }
        }

        @media (max-width: 640px) {
            .hero-inner {
                padding: 110px 0 80px;
            }

            .btn {
                width: 100%;
            }

            .hero-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<header class="topbar">
    <div class="container nav">
        <a href="#beranda" class="brand">
            <strong>{{ $settings->company_name ?? 'Balkondes Bumiharjo' }}</strong>
            <span>Kampoeng Dolanan & Kuliner</span>
        </a>

        <nav class="nav-links">
            <a href="#tentang">Tentang</a>
            <a href="#layanan">Layanan</a>
            <a href="#galeri">Galeri</a>
            <a href="#kontak">Kontak</a>
        </nav>

        <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="btn btn-outline">
            WhatsApp
        </a>
    </div>
</header>

<section class="hero" id="beranda">
    @forelse($heroSlides as $index => $slide)
        <div
            class="hero-slide {{ $index === 0 ? 'active' : '' }}"
            style="
                @if($slide->image_path)
                    background-image: url('{{ asset('storage/' . $slide->image_path) }}');
                @else
                    background:
                    linear-gradient(135deg, rgba(16,59,42,.80), rgba(16,59,42,.35)),
                    url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1600&q=80');
                    background-size: cover;
                    background-position: center;
                @endif
            "
        ></div>
    @empty
        <div
            class="hero-slide active"
            style="
                background:
                linear-gradient(135deg, rgba(16,59,42,.80), rgba(16,59,42,.35)),
                url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1600&q=80');
                background-size: cover;
                background-position: center;
            "
        ></div>
    @endforelse

    <div class="hero-overlay"></div>

    <div class="container hero-inner reveal">
        <span class="eyebrow">Jantungnya Kampoeng Dolanan & Kuliner</span>

        <h1>
            {{ $primaryHero?->title ?: ($settings->hero_headline ?? 'Selamat Datang di Balkondes Bumiharjo') }}
        </h1>

        <p>
            {{ $primaryHero?->subtitle ?: ($settings->hero_subheadline ?? 'Temukan kembali hangatnya kebersamaan dan kenangan masa kecil di pelukan alam Borobudur.') }}
        </p>

        <div class="hero-actions">
            <a href="{{ $primaryHero?->button_link ?: '#layanan' }}" class="btn btn-primary">
                {{ $primaryHero?->button_text ?: 'Eksplorasi Sekarang' }}
            </a>

            <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="btn btn-secondary">
                Reservasi via WhatsApp
            </a>
        </div>

        <div class="hero-info">
            <div class="info-chip">
                <small>Alamat</small>
                <strong>{{ $settings->address ?? 'Bumiharjo, Borobudur, Magelang' }}</strong>
            </div>
            <div class="info-chip">
                <small>Jam Operasional</small>
                <strong>{{ $settings->opening_hours ?? 'Buka Setiap Hari (08.00 - 20.00 WIB)' }}</strong>
            </div>
            <div class="info-chip">
                <small>Fokus Utama</small>
                <strong>Homestay, Venue, Kuliner, dan Trip VW di suasana sawah yang asri.</strong>
            </div>
        </div>
    </div>

    @if($heroSlides->count() > 1)
        <div class="hero-dots">
            @foreach($heroSlides as $index => $slide)
                <span class="hero-dot {{ $index === 0 ? 'active' : '' }}"></span>
            @endforeach
        </div>
    @endif
</section>

<section id="tentang">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <h2>{{ $settings->about_title ?? 'Merawat Tradisi, Merayakan Kebersamaan' }}</h2>
            </div>
            <p>
                Website ini dirancang sebagai wajah digital Balkondes Bumiharjo:
                hangat, alami, dan menjual pengalaman.
            </p>
        </div>

        <div class="about-grid">
            <div class="card about-copy reveal">
                <p>{!! nl2br(e($settings->about_content ?? 'Konten tentang kami belum diisi.')) !!}</p>
            </div>

            <div class="card about-visual reveal">
                <div class="about-badge">
                    <strong>Nuansa alam, memori masa kecil, dan ruang kebersamaan.</strong>
                    <div style="margin-top:8px; line-height:1.7;">
                        Cocok untuk staycation, acara keluarga, reuni, bukber, hingga eksplorasi VW di kawasan Borobudur.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="layanan" style="background:#f1f8f4;">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <h2>{{ $settings->services_title ?? 'Sempurnakan Momenmu di Tengah Hamparan Hijau' }}</h2>
            </div>
            <p>{{ $settings->services_intro ?? 'Kami siap melengkapi setiap cerita perjalanan dan perayaanmu.' }}</p>
        </div>

        <div class="services-grid">
            @forelse($services as $service)
                <div class="card service-card reveal">
                    <div class="service-icon">{{ $service->icon ?: '✨' }}</div>
                    <h3>{{ $service->title }}</h3>
                    <p>{{ $service->description }}</p>
                </div>
            @empty
                <div class="card service-card reveal">
                    <div class="service-icon">✨</div>
                    <h3>Belum ada layanan</h3>
                    <p>Silakan isi data layanan dari panel admin.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section id="galeri">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <h2>Galeri Visual</h2>
            </div>
            <p>
                Tambahkan foto sawah, homestay, pendopo, makanan, dan video suasana
                agar website ini terasa lebih menjual.
            </p>
        </div>

        <div class="gallery-grid">
            @forelse($galleryItems as $item)
                <div class="gallery-card reveal">
                    @if($item->media_type === 'video' && $item->video_path)
                        <video controls preload="metadata">
                            <source src="{{ asset('storage/' . $item->video_path) }}">
                            Browser Anda tidak mendukung video.
                        </video>
                    @elseif($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}">
                    @else
                        <div style="height:100%;display:grid;place-items:center;color:#334155;background:#e2e8f0;padding:24px;text-align:center;">
                            Media belum diupload
                        </div>
                    @endif

                    <div class="gallery-caption">
                        <strong>{{ $item->title ?: 'Galeri Balkondes' }}</strong>
                        <span>{{ $item->caption ?: 'Tambahkan caption dari panel admin agar lebih menarik.' }}</span>
                    </div>
                </div>
            @empty
                <div class="gallery-card reveal">
                    <div style="height:100%;display:grid;place-items:center;color:#334155;background:#e2e8f0;padding:24px;text-align:center;">
                        Belum ada foto/video. Upload dari panel admin.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section id="kontak" style="background:#f1f8f4;">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <h2>{{ $settings->footer_title ?? 'Mari Berkunjung' }}</h2>
            </div>
            <p>
                Informasi kontak dan lokasi bisa Anda ubah kapan saja dari admin panel.
            </p>
        </div>

        <div class="contact-wrap">
            <div class="card contact-card reveal">
                <h3>Informasi Kunjungan</h3>

                <div class="contact-list">
                    <div class="contact-item">
                        <small>Alamat</small>
                        <div>{{ $settings->address ?? '-' }}</div>
                    </div>

                    <div class="contact-item">
                        <small>Jam Operasional</small>
                        <strong>{{ $settings->opening_hours ?? '-' }}</strong>
                    </div>

                    <div class="contact-item">
                        <small>WhatsApp</small>
                        <strong>{{ $settings->whatsapp_number ?? '-' }}</strong>
                    </div>
                </div>

                <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="btn btn-primary">
                    Reservasi Sekarang
                </a>
            </div>

            <div class="card map-box reveal">
                @if(!empty($settings?->maps_embed_url))
                    <iframe
                        src="{{ $settings->maps_embed_url }}"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen>
                    </iframe>
                @else
                    <div class="placeholder-map">
                        Link embed Google Maps belum diisi.<br>
                        Isi dari admin panel pada menu Pengaturan Website.
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<div class="container footer">
    © {{ date('Y') }} {{ $settings->company_name ?? 'Balkondes Bumiharjo' }}. Dibangun dengan Laravel.
</div>

<a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="floating-wa">
    WhatsApp
</a>

<script>
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    let currentSlide = 0;

    function setActiveSlide(index) {
        slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
        dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
    }

    if (slides.length > 1) {
        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            setActiveSlide(currentSlide);
        }, 5000);
    }

    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    }, { threshold: 0.12 });

    reveals.forEach((item) => observer.observe(item));
</script>

</body>
</html>