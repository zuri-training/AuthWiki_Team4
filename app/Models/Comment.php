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

    public function wiki() {
        return $this->belongsTo(Wiki::class);
    }
    public function user() {
        return $this->belongsToThrough(User::class, Wiki::class);
    }
    public function vote() {
        return $this->hasMany(Vote::class);
    }
    public function getVotedAttribute()
    {
        return $this->vote()->where(['user_id' => Auth::id()])->exists();
    }
}
