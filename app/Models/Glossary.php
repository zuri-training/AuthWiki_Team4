<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Glossary extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'category_id',
        'title',
        'content'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
