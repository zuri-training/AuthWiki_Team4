<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Github extends Model
{
    use HasFactory;

    protected $table = 'githubs';
    public $timestamps = false;
    protected $fillable = [
        'users_id',
        'github_id',
        'github_token',
        'github_refresh_token'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
}
