<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Str;

class PengeluaranExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $pengeluaran = Pengeluaran::all();
        $xport = [];
        foreach ($pengeluaran as $key => $value) {
            $xport[] = [
                'CategorySlug' => Str::slug($value->category->name),
                'Description' => $value->description,
                'Date' => $value->date,
                'Amount' => $value->amount,
            ];
        }
        return collect($xport);
    }

    public function headings(): array
    {
        return [
            'CategorySlug',
            'Description',
            'Date',
            'Amount',
        ];
    }
}
