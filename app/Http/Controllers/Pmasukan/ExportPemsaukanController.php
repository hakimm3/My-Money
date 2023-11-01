<?php

namespace App\Http\Controllers\Pmasukan;

use Illuminate\Http\Request;
use App\Exports\IncomeExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportPemsaukanController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Excel::download(new IncomeExport(auth()->user()->id), 'incomes.xlsx');
    }
}
