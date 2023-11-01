<?php

namespace App\Exports;

use App\Models\Income;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class IncomeExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
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
        $incomes = Income::where('user_id', $this->user_id)->with('category')->latest()->get();
        $data = [];
        foreach($incomes as $item){
            $data[] = [
                'date' => $item->date,
                'description' => $item->description,
                'amount' => $item->amount,
                'category' => $item->category->name,
            ];
        }
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'date',
            'description',
            'amount',
            'category',
        ];
    }

    public function styles($sheet)
    {
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'argb' => 'FFFFFF',
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '181C3C',
                ],
            ],
        ]);
    }
}
