<?php

namespace App\Models;

use Illuminate\{
    Database\Eloquent\Factories\HasFactory,
    Foundation\Auth\User as Authenticatable,
    Contracts\Auth\MustVerifyEmail,
    Notifications\Notifiable,
    Support\Facades\Hash,
    Support\Str,
    Database\Eloquent\Casts\Attribute
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
        'password_changed',
        'admin'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends = [
        'first_name',
        'libraries',
        // 'blogs',
        // 'forums',
        'contributions'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin' => 'boolean',
        'password_changed' => 'boolean'
    ];

    public function log() {
        return $this->hasOne(Log::class);
    }
    public function file() {
      return $this->hasMany(File::class);
    }
    public function wiki() {
        return $this->hasMany(Wiki::class);
    }
    public function comment() {
        return $this->hasMany(Comment::class);
    }


    /**
     * Interact with the first name
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn() => Str::of($this->name)->split('/[\s]+/')->first()
        );
    }
    /**
     * Interact with the name
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::title($value)
        );
    }
    /**
     * Interact with the user name
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function userName(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::lower($value)
        );
    }
    /**
     * Interact with the email
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::lower($value)
        );
    }
    /**
     * Interact with the password
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value)
        );
    }

    public function getLibrariesAttribute()
    {
        return $this->wiki()->where('type', 'wiki')->count();
    }
    // public function getBlogsAttribute()
    // {
    //     return $this->wiki()->where('type', 'blog')->count();
    // }
    // public function getForumsAttribute()
    // {
    //     return $this->wiki()->where('type', 'forum')->count();
    // }
    public function getContributionsAttribute()
    {
        return $this->comment()->count();
    }
}
