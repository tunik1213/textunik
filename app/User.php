<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nick_name', 'email', 'password', 'gender', 'specialization', 'birthdate', 'avatar', 'avatar_mini', 'short_info'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getGenderAttribute($value)
    {
        return ($value === null) ? null : (bool)$value;
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'authorId');
    }

    public function articles()
    {
        return $this->hasMany('App\Article', 'authorId');
    }

    public function profile_url()
    {
        return url('/profile/' . $this->id);
    }

    public function superAdmin() : bool
    {
        $ids = [
            1
        ];

        return in_array(Auth::user()->id, $ids);
    }

    public function displayName() : string
    {
        if (empty(trim($this->nick_name)))
            return $this->name;

        return $this->nick_name;
    }

    public static function moderatorsEmail() : array
    {
        return self::where('moderator', 1)->pluck('email')->toArray();
    }

}
