<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function detail_pesanan()
    {
        return $this->belongsTo(detail_pesanan::class);
    }
}
