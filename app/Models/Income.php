<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory, HasUuids;
    use SoftDeletes;
    protected $table = 'incomes';
    protected $fillable = [
        'user_id',
        'category_id',
        'description',
        'date',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(IncomeCategory::class);
    }

    public function scopeFilterYear($query)
    {
        if(request('year')){
            $query->whereYear('date', request('year'));
        }
    }
}
