<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImages extends Model
{
    use HasFactory;

    protected $table = 'posts_image';

    public function post()
    {
        return $this->belongsTo(Posts::class, 'postId');
    }
}
