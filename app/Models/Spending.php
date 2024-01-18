<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Spending extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'pengeluarans';
    protected $fillable = ['category_id', 'description', 'date', 'amount', 'user_id', 'event_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function scopeFilterMonth($query)
    {
       if(request()->month){
        //    $month = request()->month;
           return $query->whereMonth('date', Carbon::parse(request()->month)->month);
       }
    }
}
