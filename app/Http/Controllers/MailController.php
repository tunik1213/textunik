<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\DailyReport;
use App\Mail\DemoEmail;
use App\User;
use Illuminate\Support\Facades\Mail;
 
class MailController extends Controller
{
    public function dailyReport()
    {
        $report = new DailyReport();
        $receivers = User::where('moderator', 1)->pluck('email')->toArray();
        Mail::to($receivers)->send($report);
    }
}