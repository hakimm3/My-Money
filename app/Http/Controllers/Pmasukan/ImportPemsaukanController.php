<?php

namespace App\Http\Controllers\Pmasukan;

use Illuminate\Http\Request;
use App\Exports\IncomeExport;
use App\Imports\IncomeImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportPemsaukanController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Excel::import(new IncomeImport, $request->file('file'));

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diimport'
        ]);
    }
}
