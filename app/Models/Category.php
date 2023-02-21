<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;
    protected $table = 'categories';
    protected $fillable = ['name', 'status'];

    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class);
    }
}
