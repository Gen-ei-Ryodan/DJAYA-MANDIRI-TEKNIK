<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'page', 'meta_title', 'meta_description', 'keywords',
        'og_title', 'og_description', 'og_image', 'twitter_card',
    ];
}
