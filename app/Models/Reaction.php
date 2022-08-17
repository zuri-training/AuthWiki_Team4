<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Reaction extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'wiki_id',
        'comment_id',
        'rating'
    ];

    public function wiki() {
        return $this->belongsTo(Wiki::class);
    }
    public function comment() {
        return $this->belongsTo(Comment::class);
    }
}
