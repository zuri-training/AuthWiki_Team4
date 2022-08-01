<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Google extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'google_id',
        'google_token',
        'google_refresh_token'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
