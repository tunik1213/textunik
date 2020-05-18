<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\User;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function confirmEmail(int $userId, string $token)
    {
        $user = User::find($userId);
        if (empty($user->api_token)) return abort(404);
        if ($user->api_token <> $token) return abort(404);

        $user->email_verified_at = time();
        $user->save();

        Auth::login($user);

        $message = 'Спасибо, Ваш email успешно подтвержден!';
        return view('home.index',['user' => $user, 'message' => $message]);
    }
}
