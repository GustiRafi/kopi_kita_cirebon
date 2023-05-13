<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    use HasFactory;
    
    protected $guarded =['id'];


    public function table()
    {
        return $this->belongsTo(table::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function detail_pesanan()
    {
        return $this->hasMany(detail_pesanan::class);
    }
    
}
