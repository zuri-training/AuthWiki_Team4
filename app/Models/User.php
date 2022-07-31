<?php

namespace App\Models;

use Illuminate\{
    Database\Eloquent\Factories\HasFactory,
    Foundation\Auth\User as Authenticatable,
    Contracts\Auth\MustVerifyEmail,
    Notifications\Notifiable,
    Support\Facades\Hash,
    Support\Str
};
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'user_name',
        'email',
        'password',
        'photo',
        'email_verified_at'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends = [
        'libraries',
        'contributions'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin' => 'boolean'
    ];

    public function github() {
        return $this->hasOne(Github::class);
    }
    public function google() {
        return $this->hasOne(Google::class);
    }

    public function wikis() {
        return $this->hasMany(Wiki::class);
    }
    public function comments() {
        return $this->hasManyThrough(Comment::class, Wiki::class);
    }

    public function blogs() {
        return $this->hasMany(Blog::class);
    }
    public function blogComments() {
        return $this->hasManyThrough(BlogComment::class, Blog::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }
    public function setUserNameAttribute($value)
    {
        $this->attributes['user_name'] = Str::lower($value);
    }
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Str::lower($value);
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getLibrariesAttribute()
    {
        return $this->wikis()->count();
    }
    public function getContributionsAttribute()
    {
        return $this->comments()->count();
    }
}
