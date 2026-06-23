<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('background_video')->nullable();
            $table->string('background_image')->nullable();
            $table->json('statistics')->nullable(); // [{label, value, icon}]
            $table->string('button1_text')->default('Konsultasi Sekarang');
            $table->string('button1_url')->default('#contact');
            $table->string('button2_text')->default('Lihat Project');
            $table->string('button2_url')->default('#projects');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
