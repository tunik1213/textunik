<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Article;
use App\User;

class NewArticleNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $article;
    public $receiver;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Article $article, User $receiver)
    {
        $this->article = $article;
        $this->receiver = $receiver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view("mails.new_article_notification")
            ->subject('Новая статья в блоге TEXT-уник!')
            ->with(
                [
                    'article' => $this->article,
                    'receiver' => $this->receiver
                ]);
    }
}
