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
        $data = Pengeluaran::with('category', 'event')->orderBy('date', 'desc')->where('user_id', auth()->user()->id)
                ->when($request->dates, function($query) use ($request){
                    $dates = explode(' - ', $request->dates);
                    $query->whereBetween('date', [Carbon::parse($dates[0])->format('Y-m-d'), Carbon::parse($dates[1])->format('Y-m-d')]);
                });
        if($request->ajax()){
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('date', function($row){
                    return Carbon::parse($row->date)->format('l d F Y');
                })
                ->addColumn('category', function($row){
                    return $row->category->name;
                })
                ->addColumn('event', function($row){
                    return $row->event->name ?? '-';
                })
                ->addColumn('amount', function($row){
                    return 'Rp. '.number_format($row->amount, 0, ',', '.');
                })
                ->addColumn('action', 'pengeluaran.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        $events = \App\Models\Event::all();
        $categories = Category::all();
        $compact = compact('categories', 'events');
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

    public function export(){
        return Excel::download(new \App\Exports\PengeluaranExport, 'pengeluaran.xlsx');
    }
}
