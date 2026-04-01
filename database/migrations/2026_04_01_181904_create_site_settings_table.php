<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('Balkondes Bumiharjo');
            $table->string('hero_headline')->nullable();
            $table->text('hero_subheadline')->nullable();
            $table->string('about_title')->nullable();
            $table->longText('about_content')->nullable();
            $table->string('services_title')->nullable();
            $table->text('services_intro')->nullable();
            $table->string('footer_title')->nullable();
            $table->text('address')->nullable();
            $table->longText('maps_embed_url')->nullable();
            $table->string('opening_hours')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->text('whatsapp_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};