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

        $totalBulanIni = Spending::where('user_id', auth()->user()->id)->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
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

        $baseQuery = Spending::where('user_id', auth()->user()->id)
        ->when($request->category_id, function($query) use ($request){
            $query->where('category_id', $request->category_id);
        })
        ->when($request->date, function($query) use ($dates){
            $query->whereBetween('date', $dates);
        })
        ->when(!$request->date, function($query){
            $query->whereYear('date', Carbon::now()->year);
        });

        $baseQueryPemasukan = Income::where('user_id', auth()->user()->id) 
        ->when($request->date, function($query) use ($dates){
            $query->whereBetween('date', $dates);
        })
        ->when(!$request->date, function($query){
            $query->whereYear('date', Carbon::now()->year);
        });


        // total pengeluran grup berdasarkan kategori dan dapatkan nama kategorinya
        $totalSpending = $baseQuery->clone()->selectRaw('category_id, sum(amount) as total')
            ->groupBy('category_id')
            ->with('category')
            ->get();
        // get total Spending dan nama kategorinya
        $totalSpending = $totalSpending->map(function($item){
            $item->category->total = $item->total;
            return $item->category;
        });


        $totalSpendingPerBulan = $baseQuery->clone()->get()->groupBy(function($item){
            return Carbon::parse($item->date)->format('Y M');
        })->map(function($item){
            return $item->sum('amount');
        });

        $totalPemasukanPerBulan = $baseQueryPemasukan->clone()->get()
            ->groupBy(function($item){
                return Carbon::parse($item->date)->format('Y M');
            })->map(function($item){
                return $item->sum('amount');
            });
        
        $pemasukanDanSpendingPerBulan = [];
        foreach($totalPemasukanPerBulan as $key => $value){
            $pemasukanDanSpendingPerBulan[] = [
                'pemasukan' => $value,
                'Spending' => $totalSpendingPerBulan[$key] ?? 0,
                'balance' => $value - $totalSpendingPerBulan[$key] ?? 0,
                'bulan' => $key
            ];
        }

        $pemasukanDanSpendingPerBulan = collect($pemasukanDanSpendingPerBulan)->sortByDesc('bulan')->values();

        // Spending dengan kategori makanan pokok selama 1 tahun terakhir
        $averageEat = Spending::where('user_id', auth()->user()->id)
            ->whereHas('category', function($query){
                $query->where('name', 'Makanan Pokok');
            })
            ->whereBetween('date', [Carbon::now()->subYear(), Carbon::now()])
            ->selectRaw('month(date) as bulan, sum(amount) as total')
            ->groupBy('bulan')
            ->get()
            ->average('total');

        $averageKebutuhanDasar = Spending::where('user_id', auth()->user()->id)
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
        $compact = compact('totalBulanIni', 'totalSpending', 'totalSpendingPerBulan', 'incomeThisMonth', 'balanceThisMonth', 'pemasukanDanSpendingPerBulan', 'categories', 'nextBackup', 'averageEat', 'averageKebutuhanDasar');
        return view('home', $compact);
    }
}
