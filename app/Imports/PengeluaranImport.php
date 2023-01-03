<?php

namespace App\Imports;

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
            'category_id' => 1,
            'description' => $row['keterangan'],
            'date' => $row['tanggal'] ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal'])) : null,
            'amount' => $row['kredit'],
            'user_id' => auth()->user()->id,
        ]);
    }

    public function headingRow(): int
    {
        return 5;
    }

    public function rules(): array
    {
        return [
            'keterangan' => 'required',
            'tanggal' => 'required',
            'kredit' => 'required',

        ];
    }

    public function customValidationMessages()
    {
        return [
            'keterangan.required' => 'keterangan is required',
            'tanggal.required' => 'tanggal is required',
            'kredit.required' => 'kredit is required',
        ];
    }
}