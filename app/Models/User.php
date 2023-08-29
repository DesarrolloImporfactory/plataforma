<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function profile(){
        // return $this->hasOne('App\Models\Profile');
        return $this->hasOne(Profile::class,'user_id','id');
    }

    public function courses_dictaded(){
        return $this->hasMany(Course::class,'user_id','id');
    }

    public function reviews(){
        return $this->hasMany(Review::class,'user_id','id');
    }

    public function courses_enrolle(){
        return $this->belongsToMany(Course::class,'user_id','id');
    }

    public function lessons(){
        return $this->belongsToMany(Lesson::class,'lesson_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'user_id','id');
    }

    public function ractions(){
        return $this->hasMany(Raction::class,'user_id','id');
    }
}
