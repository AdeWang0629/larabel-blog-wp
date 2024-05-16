<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsComment extends Model
{
    use HasFactory;

    protected $table = 'posts_comment';

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }
}