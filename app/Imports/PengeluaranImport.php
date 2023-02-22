<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class PengeluaranImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithValidation
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // default heading row format
    public function model(array $row)
    {
        // jika row tanggal kosong maka isi dengan tanggal sebelumnya
     
        return Pengeluaran::create([
            'category_id' => Category::where('slug', $row['categoryslug'])->first()->id,
            'description' => $row['description'],
            'date' => $row['date'],
            'amount' => $row['amount'],
            'user_id' => auth()->user()->id,
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            'description' => 'required',
            'date' => 'required',
            'amount' => 'required',

        ];
    }

    public function customValidationMessages()
    {
        return [
            'description.required' => 'description is required',
            'date.required' => 'date is required',
            'amount.required' => 'amount is required',
        ];
    }
}