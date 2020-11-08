<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'photo_id',
    ];

    public function photo() {
        return $this->belongsTo('App\Models\Photo');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function author() {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
