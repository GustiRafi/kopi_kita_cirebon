<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\menu;
use App\Models\table;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.menu',[
            'menu' => menu::orderBy('id','desc')->get(),
            'tables' => table::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama'=> ['required','max:255'],
            'harga' => ['required'],
            'type' => ['required'],
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg']
        ]);

        $validate['image'] = $request->file('image')->store('menu');

        menu::create($validate);
        $output = '<div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-absolute top-0 end-0 p-3">
      
          <!-- Then put toasts within -->
          <div class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="my-toast">
          <div class="toast-body">
              Berhasil Menambahkan Menu Baru
            </div>
          </div>
        </div>
      </div>';
        return response($output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama'=> ['required','max:255'],
            'harga' => ['required'],
            'type' => ['required'],
            'image' => ['image','mimes:jpeg,png,jpg,gif,svg']
        ]);

        $menu = menu::firstWhere('id',$id);
        if($request->file('image')){
            Storage::delete($menu->image);
            $validate['image'] = $request->file('image')->store('menu');
        }

        menu::where('id',$id)->update($validate);
      //   $output = '<div aria-live="polite" aria-atomic="true" class="position-relative">
      //   <div class="toast-container position-absolute top-0 end-0 p-3">
      
      //     <!-- Then put toasts within -->
      //     <div class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="my-toast">
      //     <div class="toast-body">
      //         Berhasil Mengedit Menu
      //       </div>
      //     </div>
      //   </div>
      // </div>';
      //   return response($output);
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = menu::firstWhere('id',$id);

        Storage::delete($menu->image);
        menu::where('id',$id)->delete();

        $output = '<div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-absolute top-0 end-0 p-3">
      
          <!-- Then put toasts within -->
          <div class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="my-toast">
          <div class="toast-body">
              Berhasil Menghapus Menu
            </div>
          </div>
        </div>
      </div>';
        return response($output);
    }
}
