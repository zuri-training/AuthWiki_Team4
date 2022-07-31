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

    public function blogComments() {
        return $this->hasMany(BlogComment::class);
    }
    public function users() {
        return $this->belongsTo(User::class);
    }
}
