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
        'email_verified_at',
        'password',
        'photo',
        'role',
        'website',
        'github',
        'twitter',
        'github_id',
        'google_id',
        'password_changed'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends = [
        'libraries',
        'blogs',
        'forums',
        'contributions'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin' => 'boolean',
        'password_changed' => 'boolean'
    ];

    public function file() {
      return $this->hasMany(File::class);
    }
    public function wiki() {
        return $this->hasMany(Wiki::class);
    }
    public function comment() {
        return $this->hasManyThrough(Comment::class, Wiki::class);
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
        return $this->wiki()->where('type', 'wiki')->count();
    }
    public function getBlogsAttribute()
    {
        return $this->wiki()->where('type', 'blog')->count();
    }
    public function getForumsAttribute()
    {
        return $this->wiki()->where('type', 'forum')->count();
    }
    public function getContributionsAttribute()
    {
        return $this->comment()->count();
    }
}
