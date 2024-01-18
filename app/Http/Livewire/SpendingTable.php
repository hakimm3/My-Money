<?php

namespace App\Http\Livewire;

use App\Models\Spending;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class SpendingTable extends TableComponent
{
    public function query()
    {
        return Spending::with('category')->whereUserId(auth()->user()->id);
    }

    public function columns()
    {
        return [
            Column::make('Date')->searchable()->sortable(),
            Column::make('Description')->searchable()->sortable(),
            Column::make('Category', 'category.name')->searchable()->sortable(),
            Column::make('Amount')->searchable()->sortable(),
            Column::make()->view('pengeluaran.action')
        ];
    }

    public $checkbox_side = 'left';
    protected $paginationTheme = 'custom-pagination';
}
