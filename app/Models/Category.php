<?php

namespace App\Models;

use Illuminate\{
    Database\Eloquent\Factories\HasFactory,
    Database\Eloquent\Model,
    Support\Str
};

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'type',
        'name',
        'icon',
        'description'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::ucfirst($value);
    }
    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = Str::lower($value);
    }

    public function wiki() {
        return $this->hasMany(Wiki::class);
    }
    public function glosary() {
        return $this->hasMany(Glossary::class);
    }
}
