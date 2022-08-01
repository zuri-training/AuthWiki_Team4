<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'wiki_id',
        'rating'
    ];

    public function wiki() {
        return $this->belongsTo(Wiki::class);
    }
}
