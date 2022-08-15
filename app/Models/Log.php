<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Log extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'wiki_id',
        'comment_id',
        'file_id'
    ];

    public function wiki() {
        return $this->belongsTo(Wiki::class);
    }
    public function comment() {
        return $this->belongsTo(Comment::class);
    }
    public function file() {
        return $this->belongsTo(File::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
