<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nick_name', 'email', 'password', 'gender', 'specialization', 'birthdate', 'avatar', 'avatar_mini', 'short_info','contacts', 'api_token'
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

    public function getContactsAttribute($value) : string
    {
        if(empty(trim($value))){
            return 'Пользователь не опубликовал свои контакты';
        } else {
            return $value;
        }
    }

    public function getShortInfoAttribute($value) : string
    {
        if(empty(trim($value))){
            return 'Не указано';
        } else {
            return $value;
        }
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

    public function gender_str() : string
    {
        switch ($this->gender) {
            case ($this->gender === null):
                return '';
                break;
            case true:
                return 'муж';
                break;
            case false:
                return 'жен';
                break;
            default:
                return '';
                break;

        }
    }

    public function sendConfirmEmail() : void
    {
        Mail::to($this->email)
            ->queue(new ConfirmEmail($this));
    }

}
