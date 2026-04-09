<?php

if (! function_exists('setting_value')) {
    function setting_value(?array $settings, string $key, string $fallback = ''): string
    {
        $value = $settings[$key] ?? null;

        return is_string($value) && trim($value) !== '' ? $value : $fallback;
    }
}

if (! function_exists('whatsapp_link')) {
    function whatsapp_link(?array $settings): string
    {
        $number = preg_replace('/\D+/', '', (string) ($settings['whatsapp_number'] ?? ''));

        if ($number === '') {
            return '#';
        }

        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }

        $message = setting_value(
            $settings,
            'whatsapp_message',
            'Halo admin Balkondes Bumiharjo, saya ingin bertanya soal reservasi.'
        );

        return 'https://wa.me/' . $number . '?text=' . rawurlencode($message);
    }
}

if (! function_exists('media_url')) {
    function media_url(?string $path): string
    {
        if ($path === null || trim($path) === '') {
            return '';
        }

        return base_url(str_replace('\\', '/', $path));
    }
}

if (! function_exists('is_active_admin')) {
    function is_active_admin(string $prefix): string
    {
        $path = trim(uri_string(), '/');

        return $path === $prefix || str_starts_with($path, $prefix . '/') ? 'active' : '';
    }
}

if (! function_exists('old_or_value')) {
    function old_or_value(string $key, $value = ''): string
    {
        return (string) old($key, $value);
    }
}
