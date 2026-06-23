<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->text('address')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->text('google_maps')->nullable(); // iframe embed
            $table->json('operational_hours')->nullable(); // [{day, open, close}]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
