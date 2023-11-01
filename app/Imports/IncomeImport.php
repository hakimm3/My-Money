<?php

namespace App\Imports;

use App\Models\Income;
use App\Models\IncomeCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class IncomeImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Income([
            'date' => $row['date'],
            'description' => $row['description'],
            'amount' => $row['amount'],
            'category_id' => IncomeCategory::where('name', $row['category'])->first()->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'date' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'category' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'date.required' => 'date is required',
            'description.required' => 'description is required',
            'amount.required' => 'amount is required',
            'category.required' => 'category is required',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
}
