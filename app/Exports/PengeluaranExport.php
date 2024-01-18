<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PengeluaranExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $user_id;
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function collection()
    {
        $pengeluaran = \App\Models\Spending::with('category')->where('user_id', $this->user_id)->latest()->get();
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
