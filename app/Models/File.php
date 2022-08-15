<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class File extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'wiki_id',
        'name',
        'path'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function wiki() {
        return $this->belongsTo(Wiki::class);
    }
    public function log() {
        return $this->hasMany(Log::class);
    }
}
