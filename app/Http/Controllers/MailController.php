<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\DailyReport;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
 
class MailController extends Controller
{
    public function dailyReport()
    {
        $report = new DailyReport();
        Mail::to([
            "fabler77@gmail.com"
        ])->send($report);
    }
}