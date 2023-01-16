<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengeluaranRequest;
use App\Models\Category;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Pengeluaran::filterMonth()->filterYear()->with('category')->orderBy('date', 'desc')->where('user_id', auth()->user()->id)->get();
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
                ->addColumn('action', 'pengeluaran.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        $categories = Category::all();
        $compact = compact('categories');
        return view('pengeluaran.index', $compact);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengeluaranRequest $request)
    {
        $pengeluaran =  Pengeluaran::updateOrCreate(['id' => $request->id], $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::with('category')->find($id);
        return response()->json([
            'success' => true,
            'data' => $pengeluaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengeluaran::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function import(){
        Excel::import(new \App\Imports\PengeluaranImport, request()->file('file'));

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diimport'
        ]);
    }
}
