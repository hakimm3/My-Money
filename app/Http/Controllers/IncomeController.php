<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Income;
use App\Models\Category;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeRequest;
use Yajra\DataTables\Facades\DataTables;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $data = Income::with('category')->where('user_id', auth()->user()->id)->orderBy('date', 'desc')->get();
        if($request->ajax()){
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('date', function($row){
                    return Carbon::parse($row->date)->format('l d F Y');
                })
                ->addColumn('category', function($row){
                    return $row->category->name;
                })
                ->addColumn('amount', function($row){
                    return 'Rp. '.number_format($row->amount, 0, ',', '.');
                })
                ->addColumn('action', 'pemasukan.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        $categories = \App\Models\IncomeCategory::all();

        return view('pemasukan.index', compact('categories'));
    }

    public function store(IncomeRequest $request){
        $income = Income::updateOrCreate(['id' => $request->id], $request->validated());
        return response(200);
    }

    public function edit($id){
        $income = Income::find($id);
        return response()->json([
            'data' => $income,
        ]);
    }

    public function destroy($id){
        Income::find($id)->delete();
        return response(200);
    }
}
