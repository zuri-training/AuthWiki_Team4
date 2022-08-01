<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class BlogComment extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'user_id',
        'blog_id',
        'comment'
    ];

    public function blog() {
        return $this->belongsTo(Blog::class);
    }
    public function user() {
        return $this->belongsToThrough(User::class, Blog::class);
    }
}
