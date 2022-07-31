<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'wiki_id',
        'comment_id'
    ];

    public function comments() {
        return $this->belongsTo(Comment::class);
    }
}
