<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengeluaranRequest;
use App\Models\Category;
use App\Models\Pengeluaran;
use App\Models\Spending;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranController extends Controller
{
    public function __construct()
     {
        // $this->middleware('permission:index machine|create machine|update machine|delete mesin');
        $this->middleware('permission:create-pengeluaran|index-pengeluaran|update-pengeluaran|delete-pengeluaran');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $events = \App\Models\Event::all();
        $categories = Category::all();

        $spendings = Spending::with('category')->where('user_id', auth()->user()->id)->paginate(10);
        // dd($spendings);

        $compact = compact('categories', 'events', 'spendings');
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
        Spending::updateOrCreate(['id' => $request->id], $request->validated());
        return redirect()->back()->with('success', 'Data has been saved!');
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
        $pengeluaran = Spending::with('category')->find($id);
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
        Spending::find($id)->delete();
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

    public function export(){
        return Excel::download(new \App\Exports\PengeluaranExport(auth()->user()->id), 'pengeluaran.xlsx');
    }
}
