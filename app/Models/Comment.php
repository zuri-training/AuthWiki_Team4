<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};
use Illuminate\Support\Facades\Auth;
use App\Helper\Helper;

class Comment extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'user_id',
        'wiki_id',
        'comment',
        'vote'
    ];
    protected $appends = [
        'voted'
    ];

    public function setCommentAttribute($value) {
        $this->attributes['comment'] = Helper::filterText($value);
    }

    public function user() {
        return $this->belongsToThrough(User::class, Wiki::class);
    }
    public function wiki() {
        return $this->belongsTo(Wiki::class);
    }
    public function reaction() {
        return $this->hasMany(Reaction::class);
    }
    public function getVotedAttribute()
    {
        return $this->reaction()->where(['user_id' => Auth::id()])->exists();
    }
}
