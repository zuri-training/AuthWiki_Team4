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
        'stars',
        'stack',
        'comments',
        'rated'
    ];
    protected $casts = [
        'viewed_at' => 'datetime',
        'downloaded_at' => 'datetime'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function comment() {
        return $this->hasMany(Comment::class);
    }
    public function rating()
    {
        return $this->hasMany(Rating::class);
    }

    public function getStarsAttribute()
    {
        return floor($this->rating()->avg('rating') * 20);
    }
    public function getStackAttribute()
    {
        return $this->category()->first()->stack;
    }
    public function getCommentsAttribute() {
        return $this->comment()->count();
    }
    public function getRatedAttribute() {
        return $this->rating()->where('user_id', Auth::id())->exists();
    }
}
