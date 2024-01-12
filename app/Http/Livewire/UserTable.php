<?php

namespace App\Http\Livewire;

use App\Models\User;
use Kdion4891\LaravelLivewireTables\Column;
use Kdion4891\LaravelLivewireTables\TableComponent;

class UserTable extends TableComponent
{
    public function query()
    {
        return User::query();
    }

    public function columns()
    {
        return [
            Column::make('Name')->searchable()->sortable(),
            Column::make('Email')->searchable()->sortable(),
        ];
    }

    public $checkbox_side = 'left';
}
