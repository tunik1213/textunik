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

class DailyReport extends Mailable
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
        $disk_usage_percent = shell_exec(" df --output=pcent /dev/sda1 |  tr -dc '0-9'");

        $report_ts = strtotime("yesterday");
        $report_dt = Carbon::createFromTimestamp($report_ts);

        $new_users = User::where('created_at','>=',$report_dt->toDateString())->get();

        $new_comments = Comment::where('created_at','>=',$report_dt->toDateString())->get();

        $moderation = Article::where('finished',1)
            ->where('moderatedBy',null)
            ->where('title','<>', '')
            ->get();

        $drafts = Article::where('finished',0)
            ->where('title','<>', '')
            ->get();

        return $this->from('support@textunik.com')
            ->view('mails.daily_report')
	    ->subject('Ежедневный отчет')
            ->with(
                [
                    'disk_usage_percent' => $disk_usage_percent,
                    'report_dt' => $report_dt,
                    'new_users' => $new_users,
                    'new_comments' => $new_comments,
                    'moderation' => $moderation,
                    'drafts' => $drafts,
                ]);
    }
}
