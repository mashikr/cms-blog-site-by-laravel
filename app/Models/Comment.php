<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    public function author() {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function post() {
        return $this->belongsTo('App\Models\Post','post_id');
    }
}
