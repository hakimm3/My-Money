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
    public function index()
    {
        $categories = \App\Models\IncomeCategory::all();

        return view('pemasukan.index', compact('categories'));
    }

    public function store(IncomeRequest $request){
        Income::updateOrCreate(['id' => $request->id], $request->validated());
        return redirect()->back()->with('success', 'Data has been saved!');
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
