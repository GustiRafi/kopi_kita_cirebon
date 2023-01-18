<?php

namespace App\Http\Controllers\waiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\menu;

class pesanController extends Controller
{
    public function index()
    {
        return view('waiter.buatpesanan',[
            'menu'=> menu::orderBy('id','desc')->get(),
        ]);
    }
}
