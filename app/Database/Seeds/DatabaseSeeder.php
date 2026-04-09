<?php

namespace App\Database\Seeds;

use App\Models\BookingLinkModel;
use App\Models\HeroSlideModel;
use App\Models\ServiceModel;
use App\Models\SiteSettingModel;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $siteSettingModel = new SiteSettingModel();
        $heroSlideModel = new HeroSlideModel();
        $serviceModel = new ServiceModel();
        $bookingLinkModel = new BookingLinkModel();
        $userModel = new UserModel();

        if (! $siteSettingModel->first()) {
            $siteSettingModel->insert([
                'company_name' => 'Balkondes Bumiharjo',
                'hero_kicker' => 'Balkondes Bumiharjo',
                'hero_headline' => 'Balkondes Bumiharjo',
                'hero_subheadline' => 'Tempat singgah hangat di kawasan Borobudur untuk penginapan, venue acara, gathering, meeting, dan momen yang ingin dikenang lebih lama.',
                'hero_primary_label' => 'Lihat Opsi Booking',
                'hero_primary_url' => '/booking',
                'hero_secondary_label' => 'Chat WhatsApp',
                'hero_secondary_url' => 'https://wa.me/6282242186437?text=Halo%20admin%20Balkondes%20Bumiharjo%2C%20saya%20ingin%20bertanya%20tentang%20reservasi.',
                'about_label' => 'Nuansa Desa Wisata',
                'about_title' => 'Lebih Dari Sekadar Tempat Singgah',
                'about_content' => 'Balkondes Bumiharjo menghadirkan suasana desa yang tenang, nyaman, dan akrab. Di sini tamu dapat beristirahat, menyusun acara, menikmati kuliner, dan merasakan Borobudur dengan cara yang lebih dekat.',
                'services_label' => 'Pengalaman Tak Terlupakan',
                'services_title' => 'Pengalaman Tak Terlupakan',
                'services_intro' => 'Rangkaian pengalaman yang disusun untuk tamu yang datang mencari ketenangan, kebersamaan, maupun momentum acara yang berkesan.',
                'gallery_label' => 'Galeri',
                'gallery_title' => 'Keindahan yang terasa dekat dan tenang.',
                'gallery_intro' => 'Sudut visual Balkondes Bumiharjo untuk penginapan, acara, dan pengalaman desa wisata.',
                'video_title' => 'Ruang yang hangat, tenang, dan mudah diingat.',
                'video_caption' => 'Section video siap dihubungkan ke file video final dari admin.',
                'video_enabled' => 1,
                'footer_title' => 'Balkondes Bumiharjo',
                'footer_description' => 'Website resmi Balkondes Bumiharjo untuk penginapan, venue acara, dan jalur booking yang rapi.',
                'address' => 'Jl. Sentanu, Jetis Gayu, Bumiharjo, Kec. Borobudur, Kabupaten Magelang, Jawa Tengah 56553',
                'location_title' => 'Mudah dijangkau, dekat dengan suasana Borobudur.',
                'location_intro' => 'Akses mudah untuk tamu penginapan maupun penyelenggara acara.',
                'location_label' => 'Lokasi Kami',
                'maps_embed_url' => 'https://www.google.com/maps?q=Balkondes%20Bumiharjo&output=embed',
                'opening_hours' => 'Setiap hari, 08.00 - 20.00 WIB',
                'whatsapp_number' => '082242186437',
                'whatsapp_message' => 'Halo admin Balkondes Bumiharjo, saya ingin bertanya tentang reservasi.',
                'instagram_url' => 'https://www.instagram.com/balkondes_bumiharjo?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==',
                'facebook_url' => 'https://www.facebook.com/balkondesbumiharjo/',
                'maps_url' => 'https://maps.app.goo.gl/JVdfWouy6Mn44Tvm6',
                'email' => 'balkonbumiharjo@gmail.com',
            ]);
        }

        if ($heroSlideModel->countAllResults() === 0) {
            $heroSlideModel->insert([
                'title' => 'Balkondes Bumiharjo',
                'subtitle' => 'Tempat singgah hangat dekat Borobudur untuk penginapan, acara, dan pengalaman desa wisata.',
                'button_text' => 'Lihat Opsi Booking',
                'button_link' => '/booking',
                'sort_order' => 1,
                'is_active' => 1,
            ]);
        }

        if ($serviceModel->countAllResults() === 0) {
            $serviceModel->insertBatch([
                [
                    'icon' => 'STAY',
                    'title' => 'Penginapan & Homestay',
                    'description' => 'Kamar dan area inap yang tenang untuk tamu yang ingin beristirahat dekat Borobudur dengan suasana desa yang terasa akrab.',
                    'highlight_points' => "Nuansa desa yang hangat\nCocok untuk keluarga dan rombongan kecil\nAkses mudah ke kawasan Borobudur",
                    'sort_order' => 1,
                    'is_active' => 1,
                ],
                [
                    'icon' => 'EVENT',
                    'title' => 'Venue Acara',
                    'description' => 'Ruang dan suasana yang mendukung meeting, gathering, wedding, atau kegiatan budaya dengan latar desa wisata.',
                    'highlight_points' => "Fleksibel untuk berbagai kebutuhan acara\nVisual lokasi kuat untuk dokumentasi\nSuasana tenang dan representatif",
                    'sort_order' => 2,
                    'is_active' => 1,
                ],
                [
                    'icon' => 'TRIP',
                    'title' => 'Eksplorasi Borobudur',
                    'description' => 'Mulai perjalanan ke kawasan Borobudur dari titik yang lebih hangat, dekat, dan penuh cerita lokal.',
                    'highlight_points' => "Dekat dengan destinasi utama\nCocok untuk itinerary wisata\nMemberi pengalaman desa yang lebih otentik",
                    'sort_order' => 3,
                    'is_active' => 1,
                ],
            ]);
        }

        if ($bookingLinkModel->countAllResults() === 0) {
            $bookingLinkModel->insertBatch([
                ['group_key' => 'contact', 'label' => 'WhatsApp Reservasi', 'description' => 'Tanya harga, ketersediaan, dan reservasi langsung ke admin.', 'url' => 'https://wa.me/6282242186437?text=Halo%20admin%20Balkondes%20Bumiharjo%2C%20saya%20ingin%20bertanya%20tentang%20reservasi.', 'sort_order' => 1, 'is_active' => 1],
                ['group_key' => 'contact', 'label' => 'Instagram', 'description' => 'Lihat update visual dan aktivitas terbaru.', 'url' => 'https://www.instagram.com/balkondes_bumiharjo?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==', 'sort_order' => 2, 'is_active' => 1],
                ['group_key' => 'contact', 'label' => 'Facebook', 'description' => 'Ikuti info acara dan dokumentasi kegiatan.', 'url' => 'https://www.facebook.com/balkondesbumiharjo/', 'sort_order' => 3, 'is_active' => 1],
                ['group_key' => 'contact', 'label' => 'Google Maps', 'description' => 'Akses lokasi resmi Balkondes Bumiharjo.', 'url' => 'https://maps.app.goo.gl/JVdfWouy6Mn44Tvm6', 'sort_order' => 4, 'is_active' => 1],
                ['group_key' => 'contact', 'label' => 'Email', 'description' => 'Kirim pertanyaan atau kebutuhan kerja sama.', 'url' => 'mailto:balkonbumiharjo@gmail.com', 'sort_order' => 5, 'is_active' => 1],
                ['group_key' => 'ota', 'label' => 'Traveloka', 'description' => 'Pilihan praktis untuk cek harga dan ketersediaan kamar.', 'url' => 'https://trv.lk/db641855', 'sort_order' => 1, 'is_active' => 1],
                ['group_key' => 'ota', 'label' => 'Agoda', 'description' => 'Reservasi online dengan detail penginapan lengkap.', 'url' => 'https://www.agoda.com/id-id/balkondes-bumiharjo-kampung-dolanan/hotel/magelang-id.html?cid=1844104&ds=juYbDxwIAFbSir8F', 'sort_order' => 2, 'is_active' => 1],
                ['group_key' => 'ota', 'label' => 'Booking.com', 'description' => 'Alternatif booking internasional yang mudah diakses.', 'url' => 'https://www.booking.com/Share-GzG276', 'sort_order' => 3, 'is_active' => 1],
                ['group_key' => 'ota', 'label' => 'Tiket.com', 'description' => 'Reservasi staycation dan perjalanan dalam satu tempat.', 'url' => 'https://www.tiket.com/id-id/homes/indonesia/balkondes-bumiharjo-kampung-dolanan-412001639600251554', 'sort_order' => 4, 'is_active' => 1],
                ['group_key' => 'ota', 'label' => 'Hotels.com', 'description' => 'Pilihan kanal tambahan untuk pemesanan resmi.', 'url' => 'https://hotelsapp.onelink.me/fSyN/fianz273', 'sort_order' => 5, 'is_active' => 1],
            ]);
        }

        if (! $userModel->where('email', 'admin@web-balkondes.test')->first()) {
            $userModel->insert([
                'name' => 'Admin Web Balkondes',
                'username' => 'admin',
                'email' => 'admin@web-balkondes.test',
            'password' => password_hash('Admin123!', PASSWORD_DEFAULT),
                'role' => 'admin',
                'is_active' => 1,
            ]);
        }
    }
}
