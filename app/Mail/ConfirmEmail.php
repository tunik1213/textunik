<?php

namespace App\Mail;

use App\Article;
use App\Comment;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class ConfirmEmail extends Mailable //implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mails.confirm_email')
            ->subject('Подтвердите свой e-mail на TEXT-уник')
	        ->from('support@textunik.com')
            ->with(
                [
                    'user' => $this->user
                ]);
    }
}
