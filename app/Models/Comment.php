<?php

namespace App\Models;

use App\Helper\Helper;
use Illuminate\{
    Database\Eloquent\Factories\HasFactory,
    Database\Eloquent\Model
};

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wiki_id',
        'comment',
        'vote'
    ];

    public function setCommentAttribute($value) {
        $this->attributes['comment'] = Helper::filterText($value);
    }

    public function reaction() {
        return $this->hasMany(Reaction::class);
    }
    public function wiki() {
        return $this->belongsTo(Wiki::class);
    }
    public function log() {
        return $this->hasMany(Log::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
