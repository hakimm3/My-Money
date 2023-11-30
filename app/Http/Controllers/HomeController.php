<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cron;
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
        $totalBulanIni = Pengeluaran::where('user_id', auth()->user()->id)->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
        $incomeThisMonth = Income::where('user_id', auth()->user()->id)->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
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
        ->when($request->category_id, function($query) use ($request){
            $query->where('category_id', $request->category_id);
        })
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

        // total pemasukan per bulan
        $totalPemasukanPerBulan = Income::where('user_id', auth()->user()->id)
            ->when($request->year, function($query) use ($request){
                $query->whereYear('date', $request->year);
            })
            ->when($request->date, function($query) use ($dates){
                $query->whereBetween('date', $dates);
            })
            ->selectRaw('month(date) as bulan, sum(amount) as total')
            ->groupBy('bulan')
            ->get();
        $totalPemasukanPerBulan = $totalPemasukanPerBulan->map(function($item){
            $item->bulan = Date('F', mktime(0, 0, 0, $item->bulan, 10));
            return $item;
        });

        
        // total pemasukan dan pengeluaran per bulan
        $totalPemasukanPengeluaranPerBulan = $totalPengeluaranPerBulan->map(function($item) use ($totalPemasukanPerBulan){
            $item->totalPemasukan = $totalPemasukanPerBulan->where('bulan', $item->bulan)->first()->total ?? 0;
            return $item;
        });

        // tambahkan balance per bulan dari total pemasukan dan pengeluaran
        $totalPemasukanPengeluaranPerBulan = $totalPemasukanPengeluaranPerBulan->map(function($item){
            $item->balance = $item->total - $item->totalPemasukan;
            return $item;
        });


        // pengeluaran dengan kategori makanan pokok selama 1 tahun terakhir
        $averageEat = Pengeluaran::where('user_id', auth()->user()->id)
            ->whereHas('category', function($query){
                $query->where('name', 'Makanan Pokok');
            })
            ->whereBetween('date', [Carbon::now()->subYear(), Carbon::now()])
            ->selectRaw('month(date) as bulan, sum(amount) as total')
            ->groupBy('bulan')
            ->get()
            ->average('total');

        $averageKebutuhanDasar = Pengeluaran::where('user_id', auth()->user()->id)
            ->whereHas('category', function($query){
                $query->where('name', 'Kebutuhan Dasar');
            })
            ->whereBetween('date', [Carbon::now()->subYear(), Carbon::now()])
            ->selectRaw('month(date) as bulan, sum(amount) as total')
            ->groupBy('bulan')
            ->get()
            ->average('total');

        // nex backup
        $nextBackup = Carbon::parse(Cron::where('command', 'send:main')->first()->next_run)->timezone('Asia/Jakarta')->format('d F Y H:i:s');

        $categories =  Category::get();
        $compact = compact('totalBulanIni', 'totalPengeluaran', 'totalPengeluaranPerBulan', 'incomeThisMonth', 'balanceThisMonth', 'totalPemasukanPengeluaranPerBulan', 'categories', 'nextBackup', 'averageEat', 'averageKebutuhanDasar');
        return view('home', $compact);
    }
}
