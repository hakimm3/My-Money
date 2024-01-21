<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cron;
use Illuminate\Http\Request;
use App\Models\Spending;
use App\Models\Income;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request  $request)
    {   

        $baseQuerySpending = Spending::where('user_id', auth()->user()->id);
        $baseQueryIncome = Income::where('user_id', auth()->user()->id);

        $spendingThisMonth = $baseQuerySpending->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
        $incomeThisMonth = $baseQueryIncome->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');

        $spendingLastMonth = $baseQuerySpending->whereMonth('date', Carbon::now()->subMonth()->month)->whereYear('date', Carbon::now()->subMonth()->year)->sum('amount');
        $incomeLastMonth = $baseQueryIncome->whereMonth('date', Carbon::now()->subMonth()->month)->whereYear('date', Carbon::now()->subMonth()->year)->sum('amount');

        // percentage spending this month and last month 
        $percentageSpending = 0;
        if($spendingLastMonth > 0){
            $percentageSpending = ($spendingThisMonth - $spendingLastMonth) / $spendingLastMonth * 100;
        }

        // percentage income this month and last month
        $percentageIncome = 0;
        if($incomeLastMonth > 0){
            $percentageIncome = ($incomeThisMonth - $incomeLastMonth) / $incomeLastMonth * 100;
        }
        
        $spendingThisMonth = 'Rp. '.number_format($spendingThisMonth, 0, ',', '.');
        $incomeThisMonth = 'Rp. '.number_format($incomeThisMonth, 0, ',', '.');

        $dates = [];
        if($request->date){
            $dates = explode(' - ', $request->date);
            $dates = [Carbon::parse($dates[0])->format('Y-m-d'), Carbon::parse($dates[1])->format('Y-m-d')];
        }

       
        // nex backup
        $nextBackup = Carbon::parse(Cron::where('command', 'send:main')->first()->next_run)->timezone('Asia/Jakarta')->format('d F Y');

        $categories =  Category::get();
        $compact = compact('spendingThisMonth', 'incomeThisMonth', 'categories', 'nextBackup', 'percentageSpending', 'percentageIncome');
        return view('home', $compact);
    }
}
