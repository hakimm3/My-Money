<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluarans';
    protected $fillable = ['category_id', 'keterangan', 'tanggal', 'jumlah'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
