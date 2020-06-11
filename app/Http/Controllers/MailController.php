<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DailyReport;
use Illuminate\Support\Facades\Auth;
use App\Mail\ErrorReport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function dailyReport()
    {
        $report = new DailyReport();
        $receivers = User::moderatorsEmail();
        Mail::to($receivers)
            ->queue($report);
    }

    public function errorReport(Request $requst)
    {
        $receivers = User::moderatorsEmail();

        $report = new ErrorReport();
        $report->selection = $requst->input('selection');
        $report->description = $requst->input('message');
        $report->user = Auth::user();
        $report->url = $_SERVER["HTTP_REFERER"];

        Mail::to($receivers)
            ->queue($report);
    }

    public function unsubscribeArticleComments(int $userId, string $token)
    {
        $user = User::find($userId);
        if (empty($user->api_token)) return abort(404);
        if ($user->api_token <> $token) return abort(404);

        $user->comment_notifications = false;
        $user->save();

        Auth::login($user);

        return view('staticPages.unsubscribed');
    }

    public function unsubscribeArticleNotifications(int $userId, string $token)
    {
        $user = User::find($userId);
        if (empty($user->api_token)) return abort(404);
        if ($user->api_token <> $token) return abort(404);

        $user->article_notifications = false;
        $user->save();

        Auth::login($user);

        return view('staticPages.unsubscribed');
    }

}
