<?php

namespace App\Models;

use App\Helper\Helper;

use Illuminate\{
    Database\Eloquent\Factories\HasFactory,
    Database\Eloquent\Model,
    Database\Eloquent\Casts\Attribute
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

    /**
     * Interact with the title
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Helper::filterText($value, true)
        );
    }
    /**
     * Interact with the overview
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function overview(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Helper::filterText($value),
            get: fn($value) => Helper::outputText($value)
        );
    }
    /**
     * Interact with the contents
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function contents(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Helper::filterText($value),
            get: fn($value) => Helper::outputText($value)
        );
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
