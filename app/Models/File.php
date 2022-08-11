<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'file_dir'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
