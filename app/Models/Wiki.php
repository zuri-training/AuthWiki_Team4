<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};
use Illuminate\Support\Facades\Auth;

class Wiki extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'usage',
        'views',
        'file_dir',
        'viewed_at',
        'downloads',
        'downloaded_at'
    ];
    protected $appends = [
        'rating',
        'rated',
        'stack'
    ];
    protected $casts = [
        'viewed_at' => 'datetime',
        'downloaded_at' => 'datetime'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
    public function categorys() {
        return $this->belongsTo(Category::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function getRatingAttribute()
    {
        return round($this->ratings()->avg('rating'));
    }
    public function getRatedAttribute()
    {
        return $this->ratings()->where('user_id', Auth::id())->exists();
    }
    public function getStackAttribute()
    {
        return $this->categorys->stack;
    }
}
