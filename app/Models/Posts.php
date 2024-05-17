<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function images()
    {
        return $this->hasMany(PostImages::class, 'postId');
    }

    public function comments()
    {
        return $this->hasMany(PostsComment::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(PostsLike::class, 'post_id');
    }
}