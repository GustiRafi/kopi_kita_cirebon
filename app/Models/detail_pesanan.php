<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pesanan extends Model
{
    use HasFactory;

    public function pesanan()
    {
        return $this->belongsTo(pesanan::class);
    }

    public function menu()
    {
        return $this->belongsTo(menu::class);
    }
}
