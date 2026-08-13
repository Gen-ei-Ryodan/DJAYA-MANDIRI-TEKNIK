<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['articles', 'products', 'projects'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->text('seo_keywords')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        foreach (['articles', 'products', 'projects'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('seo_keywords')->nullable()->change();
            });
        }
    }
};
