<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body'
    ];

    public function blogComment() {
        return $this->hasMany(BlogComment::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
