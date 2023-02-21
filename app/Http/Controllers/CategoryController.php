<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    if($row->status == true){
                        return '<span class="badge badge-success">Aktif</span>';
                    }else{
                        return '<span class="badge badge-danger">Tidak Aktif</span>';
                    }
                })
                ->addColumn('action', 'pengeluaran.category.action')
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        
        $categories = Category::all();
        $compact = compact('categories');
        return view('pengeluaran.category.index', $compact);
    }

    public function store(CategoryRequest $request)
    {
        $data = Category::updateOrCreate(['id' => $request->id], [
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $data
        ]);
    }

    public function edit($id)
    {
        $data = Category::find($id);
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = Category::find($id);
        $data->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
