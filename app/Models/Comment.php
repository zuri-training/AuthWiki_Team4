<?php

namespace App\Models;

use App\Helper\Helper;
use Illuminate\{
    Database\Eloquent\Factories\HasFactory,
    Database\Eloquent\Model,
    Database\Eloquent\Casts\Attribute
};

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wiki_id',
        'comment'
    ];

    /**
     * Interact with the comment
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function comment(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Helper::filterText($value),
            get: fn($value) => Helper::outputText($value)
        );
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
