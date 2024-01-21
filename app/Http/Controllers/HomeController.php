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

        $spendingThisMonth = $baseQuerySpending->clone()->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
        $incomeThisMonth = $baseQueryIncome->clone()->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');

        $spendingLastMonth = $baseQuerySpending->clone()->whereMonth('date', Carbon::now()->subMonth()->month)->whereYear('date', Carbon::now()->subMonth()->year)->sum('amount');
        $incomeLastMonth = $baseQueryIncome->clone()->whereMonth('date', Carbon::now()->subMonth()->month)->whereYear('date', Carbon::now()->subMonth()->year)->sum('amount');

        // percentage spending this month and last month 
        $percentageSpending = 0;
        if($spendingLastMonth > 0){
            $percentageSpending = floor(($spendingThisMonth - $spendingLastMonth) / $spendingLastMonth * 100);
        }

        // percentage income this month and last month
        $percentageIncome = 0;
        if($incomeLastMonth > 0){
            $percentageIncome = floor(($incomeThisMonth - $incomeLastMonth) / $incomeLastMonth * 100);
        }
        
        $spendingThisMonth = 'Rp. '.number_format($spendingThisMonth, 0, ',', '.');
        $incomeThisMonth = 'Rp. '.number_format($incomeThisMonth, 0, ',', '.');

        

        // Main Widget 
        $spendings = $baseQuerySpending->clone()->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('date')->groupBy('date')->selectRaw('sum(amount) as amount, date')->get();
        $incomes = $baseQueryIncome->clone()->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('date')->groupBy('date')->selectRaw('sum(amount) as amount, date')->get();

        $mainWidgetData = [];
        $mainWidgetData['spending'] = $spendings->pluck('amount')->toArray();
        $mainWidgetData['income'] = $incomes->pluck('amount')->toArray();
        $mainWidgetData['dates'] = $spendings->pluck('date')->map(function($date){
            return Carbon::parse($date)->format('d M');
        });

        // total spending
        $mainWidgetData['totalSpending'] = 'Rp. '.number_format($spendings->sum('amount'), 0, ',', '.');
        // End Main Widget

        // Tabs Widget by Category and month
        $incomes = $baseQueryIncome->clone()->with('category')->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->groupBy('category_id')->selectRaw('sum(amount) as amount, category_id')->limit(5)->get();
        $spendings = $baseQuerySpending->clone()->with('category')->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->groupBy('category_id')->selectRaw('sum(amount) as amount, category_id')->limit(5)->get();
        
        $tabsWidgetData = [];
        $tabsWidgetData['incomes'] = $incomes;
        $tabsWidgetData['spendings'] = $spendings;
        // End Tabs Widget by Category and month

        // nex backup
        $nextBackup = Carbon::parse(Cron::where('command', 'send:main')->first()->next_run)->timezone('Asia/Jakarta')->format('d F Y');

        $categories =  Category::get();
        $compact = compact('spendingThisMonth', 'incomeThisMonth', 'categories', 'nextBackup', 'percentageSpending', 'percentageIncome', 'mainWidgetData', 'tabsWidgetData');
        return view('home', $compact);
    }
}
