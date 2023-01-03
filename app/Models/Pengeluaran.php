<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluarans';
    protected $fillable = ['category_id', 'description', 'date', 'amount', 'user_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilterMonth($query)
    {
       if(request()->month){
        //    $month = request()->month;
           return $query->whereMonth('date', Carbon::parse(request()->month)->month);
       }
    }

    public function scopeFilterYear($query)
    {
        if(request()->year){
            // $year = request()->year;
            return $query->whereYear('date', request()->year);
        }
    }
}
