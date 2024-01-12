<?php

namespace App\Http\Livewire;

use App\Models\Spending;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class SpendingTable extends TableComponent
{
    public function query()
    {
        return Spending::with('category');
    }

    public function columns()
    {
        return [
            Column::make('Date')->searchable()->sortable(),
            Column::make('Description')->searchable()->sortable(),
            Column::make('Category', 'category.name')->searchable()->sortable(),
            Column::make('Amount')->searchable()->sortable(),
            Column::make()->view('pengeluaran.action'),
            Column::make('id')
        ];
    }

    public $checkbox_side = 'left';
    protected $paginationTheme = 'custom-pagination';
}
