<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Comment;

class ArticleCommentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->comment->parentId == 0) {
            $subject = 'Вашу статью прокомментировали';
        } else {
            $subject = 'Новый ответ на Ваш комментарий';
        }

        $view = 'article_comment_notification';

        return $this
            ->view("mails.$view")
            ->subject($subject)
	        ->from('support@textunik.com')
            ->with(
                [
                    'comment' => $this->comment
                ]);
    }
}
