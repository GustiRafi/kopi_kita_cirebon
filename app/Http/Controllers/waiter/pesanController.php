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

    public function select(Request $req){
        $menu = menu::firstWhere('id',$req->id);

        $output = '<button class="btn btn-link" onclick="return get_menu({{ $item->id }})">
        <div class="card">
            <img src="/storage/'. $menu->image .'" class="
                card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title" id="nama">'.$menu->nama.'</h5>
                    <input type="number" min="1" max="" value="1" class="form-control qty" name="qty" id="qty">
                    <button class="btn btn-primary addcart me-2" id="add" onclick="return add_pesan('.$menu->id.','. $menu->harga .')">Tambah</button>
            </div>
        </div>';

        return response($output);
    }
}
