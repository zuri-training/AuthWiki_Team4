<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};
use Illuminate\Support\{
    Facades\Auth,
    Str
};
use App\Helper\Helper;

class Wiki extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'category_id',
        'file_id',
        'title',
        'overview',
        'requirements',
        'snippets',
        'examples',
        'links',
        'views',
        'viewed_at',
        'downloads',
        'downloaded_at'
    ];
    protected $appends = [
        'comments',
        'stars',
        'stared'
    ];
    protected $casts = [
        'viewed_at' => 'datetime',
        'downloaded_at' => 'datetime'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Helper::filterText($value, true);
    }
    public function setOverviewAttribute($value)
    {
        $this->attributes['overview'] = Helper::filterText($value);
    }
    public function setRequirementsAttribute($value)
    {
        $this->attributes['requirements'] = Helper::filterText($value);
    }
    public function setSnippetsAttribute($value) {
        $this->attributes['snippets'] = Helper::filterText($value, true);
    }
    public function setExamplesAttribute($value) {
        $this->attributes['examples'] = Helper::filterText($value);
    }
    public function setLinksAttribute($value) {
        $this->attributes['links'] = Helper::filterText($value, true);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function file() {
        return $this->hasOne(File::class);
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function comment() {
        return $this->hasMany(Comment::class);
    }
    public function reaction()
    {
        return $this->hasMany(Reaction::class);
    }

    public function getCommentsAttribute() {
        return $this->comment()->count();
    }
    public function getStarsAttribute()
    {
        return floor($this->reaction()->where('comment_id', null)->avg('rating') * 20);
    }
    public function getStaredAttribute() {
        return $this->reaction()->where(['comment_id' => null, 'user_id' => Auth::id()])->exists();
    }
}
