<?php

namespace App\Models;

use App\Helper\Helper;

use Illuminate\{
    Database\Eloquent\Factories\HasFactory,
    Database\Eloquent\Model
};

class Wiki extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'category_id',
        'title',
        'overview',
        'contents',
        'views',
        'viewed_at',
        'downloads',
        'downloaded_at',
        'published'
    ];
    protected $appends = [
        'comments',
        'stars'
    ];
    protected $casts = [
        'viewed_at' => 'datetime',
        'downloaded_at' => 'datetime',
        'published' => 'boolean'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Helper::filterText($value, true);
    }
    public function setOverviewAttribute($value)
    {
        $this->attributes['overview'] = Helper::filterText($value);
    }
    public function setContentsAttribute($value)
    {
        $this->attributes['contents'] = Helper::filterText($value);
    }

    public function file() {
        return $this->hasOne(File::class);
    }
    public function reaction()
    {
        return $this->hasMany(Reaction::class);
    }
    public function comment() {
        return $this->hasMany(Comment::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function log() {
        return $this->hasMany(Log::class);
    }

    public function getCommentsAttribute() {
        return $this->comment()->count();
    }
    public function getStarsAttribute()
    {
        return floor($this->reaction()->where('comment_id', null)->avg('rating') * 20);
    }
}
