<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'order'];

    protected $casts = ['order' => 'integer'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'category_id');
    }
}
