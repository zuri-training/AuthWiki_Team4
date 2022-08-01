<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Github extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'github_id',
        'github_token',
        'github_refresh_token'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
