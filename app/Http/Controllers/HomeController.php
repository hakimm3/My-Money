<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
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
        $totalBulanIni = Pengeluaran::where('user_id', auth()->user()->id)->whereMonth('date', Carbon::now()->month)->sum('amount');
        $incomeThisMonth = Income::where('user_id', auth()->user()->id)->whereMonth('date', Carbon::now()->month)->sum('amount');
        $balanceThisMonth = $incomeThisMonth - $totalBulanIni;
        
        $totalBulanIni = 'Rp. '.number_format($totalBulanIni, 0, ',', '.');
        $incomeThisMonth = 'Rp. '.number_format($incomeThisMonth, 0, ',', '.');
        $balanceThisMonth = 'Rp. '.number_format($balanceThisMonth, 0, ',', '.');

        $dates = [];
        if($request->date){
            $dates = explode(' - ', $request->date);
            $dates = [Carbon::parse($dates[0])->format('Y-m-d'), Carbon::parse($dates[1])->format('Y-m-d')];
        }
        $baseQuery = Pengeluaran::where('user_id', auth()->user()->id)
        ->filterYear()
        ->when($request->date, function($query) use ($dates){
            $query->whereBetween('date', $dates);
        });

        // total pengeluran grup berdasarkan kategori dan dapatkan nama kategorinya
        $totalPengeluaran = $baseQuery->clone()->selectRaw('category_id, sum(amount) as total')
            ->groupBy('category_id')
            ->with('category')
            ->get();
        // get total pengeluaran dan nama kategorinya
        $totalPengeluaran = $totalPengeluaran->map(function($item){
            $item->category->total = $item->total;
            return $item->category;
        });

        // total pengeluaran per bulan
        $totalPengeluaranPerBulan = $baseQuery->clone()->selectRaw('month(date) as bulan, sum(amount) as total')
            ->groupBy('bulan')
            ->get();
        $totalPengeluaranPerBulan = $totalPengeluaranPerBulan->map(function($item){
            $item->bulan = Date('F', mktime(0, 0, 0, $item->bulan, 10));
            return $item;
        });
        // $totalPengeluaranPerBulan = Pengeluaran::where('user_id', auth()->user()->id)->filterMonth()->filterYear()->get();

        $compact = compact('totalBulanIni', 'totalPengeluaran', 'totalPengeluaranPerBulan', 'incomeThisMonth', 'balanceThisMonth');
        return view('home', $compact);
    }
}
