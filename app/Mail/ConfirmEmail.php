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

class ConfirmEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            ->onQueue('high')
	        ->from('support@textunik.com')
            ->with(
                [
                    'user' => Auth::user()
                ]);
    }
}
