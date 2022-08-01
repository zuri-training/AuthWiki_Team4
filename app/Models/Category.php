<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stack',
        'description'
    ];

    public function wikis() {
        return $this->hasMany(Wiki::class);
    }

}