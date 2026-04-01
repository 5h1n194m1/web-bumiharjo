<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\HeroSlide;
use App\Models\Service;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        $heroSlides = HeroSlide::where('is_active', true)->orderBy('sort_order')->get();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $galleryItems = GalleryItem::where('is_active', true)->orderBy('sort_order')->get();

        $primaryHero = $heroSlides->first();

        $whatsappLink = '#';

        if ($settings?->whatsapp_number) {
            $wa = preg_replace('/\D+/', '', $settings->whatsapp_number);

            if ($wa !== '' && str_starts_with($wa, '0')) {
                $wa = '62' . substr($wa, 1);
            }

            $message = $settings->whatsapp_message ?: 'Halo admin Balkondes Bumiharjo, saya ingin bertanya soal reservasi.';
            $whatsappLink = 'https://wa.me/' . $wa . '?text=' . urlencode($message);
        }

        return view('home', [
            'settings' => $settings,
            'heroSlides' => $heroSlides,
            'primaryHero' => $primaryHero,
            'services' => $services,
            'galleryItems' => $galleryItems,
            'whatsappLink' => $whatsappLink,
        ]);
    }
}