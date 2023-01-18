<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\table;

class tableController extends Controller
{
    public function store()
    {
        table::create();
        $output = '<div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-absolute top-0 end-0 p-3">
      
          <!-- Then put toasts within -->
          <div class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="my-toast">
          <div class="toast-body">
              Berhasil Menambah  Meja
            </div>
          </div>
        </div>
      </div>';
        return response($output);
    }

    public function delete(Request $req)
    {
        table::where('no_meja',$req->no_meja)->delete();

        $output = '<div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-absolute top-0 end-0 p-3">
      
          <!-- Then put toasts within -->
          <div class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="my-toast">
          <div class="toast-body">
              Berhasil Menghapus Meja
            </div>
          </div>
        </div>
      </div>';
        return response($output);
    }
}
