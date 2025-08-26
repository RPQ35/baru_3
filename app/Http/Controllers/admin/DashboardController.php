<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lockets;
use App\Models\Queues;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $week = Carbon::now()->startOfWeek()->endOfWeek();

        $TodayQue = Queues::where('updated_at', Carbon::today())->count();
        $WeekQue = Queues::where('updated_at', $week)->count();
        $Account = User::count();
        $Locket = Lockets::count();
        $Service = Services::count();


        return view('dashboard', compact(
            'TodayQue',
            'WeekQue',
            'Service',
            'Locket',
            'Account',
        ));
    }
}
