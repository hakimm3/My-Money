<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
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
    public function index()
    {   
        $totalBulanIni = Pengeluaran::where('user_id', auth()->user()->id)->whereMonth('date', Carbon::now()->month)->sum('amount');
        $totalBulanIni = 'Rp. '.number_format($totalBulanIni, 0, ',', '.');
        // total pengeluran grup berdasarkan kategori dan dapatkan nama kategorinya
        $totalPengeluaran = Pengeluaran::where('user_id', auth()->user()->id)->filterMonth()->filterYear()->selectRaw('category_id, sum(amount) as total')
            ->groupBy('category_id')
            ->with('category')
            ->get();
        // get total pengeluaran dan nama kategorinya
        $totalPengeluaran = $totalPengeluaran->map(function($item){
            $item->category->total = $item->total;
            return $item->category;
        });

        // total pengeluaran per bulan
        $totalPengeluaranPerBulan = Pengeluaran::where('user_id', auth()->user()->id)->filterMonth()->filterYear()->selectRaw('month(date) as bulan, sum(amount) as total')
            ->groupBy('bulan')
            ->get();
        $totalPengeluaranPerBulan = $totalPengeluaranPerBulan->map(function($item){
            $item->bulan = Date('F', mktime(0, 0, 0, $item->bulan, 10));
            return $item;
        });

        $compact = compact('totalBulanIni', 'totalPengeluaran', 'totalPengeluaranPerBulan');
        return view('home', $compact);
    }
}
