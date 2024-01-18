<?php

namespace App\Http\Livewire;

use App\Income;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class IncomeTable extends TableComponent
{
    public function query()
    {
        return \App\Models\Income::with('category')->whereUserId(auth()->user()->id);
    }

    public function columns()
    {
        return [
            Column::make('Date')->sortable()->searchable(),
            Column::make('Description')->sortable()->searchable(),
            Column::make('Category', 'category.name')->sortable()->searchable(),
            Column::make('Amount')->sortable()->searchable(),
            Column::make()->view('pemasukan.action')
        ];
    }

    public $checkbox_side = 'left';
    public $paginationTheme = 'custom-pagination';
}
