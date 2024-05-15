<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpBpActivity extends Model
{
    use HasFactory;

    protected $table = 'wp_bp_activity';

    protected $fillable = [
        'user_id',
        'date_recorded'
    ];
}
