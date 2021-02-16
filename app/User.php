<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nick_name',
        'email',
        'password',
        'gender',
        'specialization',
        'birthdate',
        'avatar',
        'avatar_mini',
        'short_info',
        'contacts',
        'api_token',
        'comment_notifications',
        'article_notifications'
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
        if ($this->gender === true)
                return 'муж';
        elseif ($this->gender === false)
                return 'жен';

        return '';
    }

    public function sendConfirmEmail() : void
    {
        if (empty($this->email)) return;

        $email = (new ConfirmEmail($this))
            ->onQueue('high');

        Mail::to($this->email)
            ->queue($email);
    }

    public function emailConfirmed() : bool
    {
        return (!empty($this->email_verified_at));
    }

    public static function topAuthors()
    {
        $queryText = '
with authors as (
    select a.authorId id,count(*) co
    from articles a
    where a.moderatedBy is not null
    group by a.authorId
)
select u.*
from users u
join authors a on a.id = u.id
order by a.co desc
';
        $result = DB::select($queryText);
        return User::hydrate($result);
    }
}
