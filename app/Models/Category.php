<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'icon',
        'description'
    ];

    public function wiki() {
        return $this->hasMany(Wiki::class);
    }
    public function glosary() {
        return $this->hasMany(Glossary::class);
    }

}
