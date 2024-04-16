<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'link',
        'points',
        'posted_at',
        'score_id',
        'is_deleted'
    ];



    use HasFactory;
}
