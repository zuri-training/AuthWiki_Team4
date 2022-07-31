<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'wiki_id',
        'user_id',
        'comment',
        'vote'
    ];
    protected $appends = [
        'voted'
    ];

    public function wikis() {
        return $this->belongsTo(Wiki::class);
    }
    public function users() {
        return $this->belongsToThrough(User::class, Wiki::class);
    }
    public function votes() {
        return $this->hasMany(Vote::class);
    }
    public function getVotedAttribute()
    {
        return $this->votes()->where(['comment_id' => $this->id, 'user_id' => Auth::id()])->exists();
    }
}
