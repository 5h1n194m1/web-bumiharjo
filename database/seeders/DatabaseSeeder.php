<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->firstOrCreate(
            ['company_name' => 'Balkondes Bumiharjo'],
            [
                'hero_headline' => 'Selamat Datang di Balkondes Bumiharjo',
                'hero_subheadline' => 'Jantungnya Kampoeng Dolanan & Kuliner. Temukan kembali hangatnya kebersamaan dan kenangan masa kecil di pelukan alam Borobudur.',
                'about_title' => 'Merawat Tradisi, Merayakan Kebersamaan',
                'about_content' => 'Di Balkondes & Homestay Bumiharjo, waktu seolah berjalan lebih lambat. Kami bukan sekadar tempat singgah, melainkan ruang untuk bernostalgia. Sebagai Kampoeng Dolanan & Kuliner, kami menghidupkan kembali permainan tradisional yang sarat makna dan menyajikan resep rahasia warisan leluhur. Di sini, setiap sudut dirancang agar kamu bisa tertawa lepas, bersantai, dan sejenak melupakan penatnya rutinitas.',
                'services_title' => 'Sempurnakan Momenmu di Tengah Hamparan Hijau',
                'services_intro' => 'Dikelilingi oleh indahnya lanskap sawah yang luas membentang dan hembusan angin segar pedesaan, Balkondes Bumiharjo siap melengkapi setiap cerita perjalanan dan perayaanmu.',
                'footer_title' => 'Mari Berkunjung',
                'address' => 'Jl. Sentanu, Jetis Gayu, Bumiharjo, Kec. Borobudur, Kabupaten Magelang, Jawa Tengah 56553.',
                'maps_embed_url' => '',
                'opening_hours' => 'Buka Setiap Hari (08.00 - 20.00 WIB)',
                'whatsapp_number' => '6281234567890',
                'whatsapp_message' => 'Halo admin Balkondes Bumiharjo, saya ingin bertanya tentang reservasi.',
            ]
        );

        if (HeroSlide::count() === 0) {
            HeroSlide::create([
                'title' => 'Selamat Datang di Balkondes Bumiharjo',
                'subtitle' => 'Jantungnya Kampoeng Dolanan & Kuliner. Temukan kembali hangatnya kebersamaan dan kenangan masa kecil di pelukan alam Borobudur.',
                'button_text' => 'Eksplorasi Sekarang',
                'button_link' => '#layanan',
                'sort_order' => 1,
                'is_active' => true,
            ]);
        }

        if (Service::count() === 0) {
            Service::insert([
                [
                    'icon' => '🏠',
                    'title' => 'Penginapan & Homestay',
                    'description' => 'Bayangkan bangun tidur disambut embun pagi dan pemandangan sawah yang menyejukkan mata. Menginap di homestay kami berarti kembali ke pelukan alam, menikmati ketenangan sejati dengan fasilitas yang nyaman dan terasa seperti di rumah sendiri.',
                    'sort_order' => 1,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'icon' => '🎪',
                    'title' => 'Venue Acara Spesial',
                    'description' => 'Jadikan hamparan sawah dan nuansa tradisional pendopo kami sebagai saksi hari bahagiamu. Area kami yang luas dan asri sangat sempurna untuk disewa sebagai venue Wedding, Reuni, Bukber, Meeting, hingga acara komunitas.',
                    'sort_order' => 2,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'icon' => '🚙',
                    'title' => 'Eksplorasi Mobil VW',
                    'description' => 'Nikmati semilir angin melintasi hijaunya persawahan dan sudut-sudut eksotis Borobudur dengan gaya klasik. Trip menggunakan mobil VW Safari kami siap membawamu bertualang menyusuri pesona desa.',
                    'sort_order' => 3,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}