<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->json('thumbnail')->nullable()->change();
        });

        DB::table('projects')->orderBy('id')->get()->each(function ($project) {
            $thumbnail = $project->thumbnail;

            if (is_string($thumbnail) && $thumbnail !== '' && ! json_validate($thumbnail)) {
                DB::table('projects')->where('id', $project->id)->update([
                    'thumbnail' => json_encode([$thumbnail]),
                ]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('thumbnail')->nullable()->change();
        });
    }
};