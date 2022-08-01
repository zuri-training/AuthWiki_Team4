<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Google extends Model
{
    use HasFactory;

    protected $table = 'googles';
    public $timestamps = false;
    protected $fillable = [
        'users_id',
        'google_id',
        'google_token',
        'google_refresh_token'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
}
