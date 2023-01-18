<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('owner.addkaryawan',[
            'karyawans' => user::all(),
            'admin' => user::where('level','admin')->get(),
            'kasir' => user::where('level','kasir')->get(),
            'waiter' => user::where('level','waiter')->get(),
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
            'name'=> ['required','max:255'],
            'email' => ['required','email'],
            'level' => ['required'],
            'password' => ['required','max:255','min:6']
        ]);

        $validate['password'] = Hash::make($request->password);

        user::create($validate);
        $output = '<div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-absolute top-0 end-0 p-3">
      
          <!-- Then put toasts within -->
          <div class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="my-toast">
          <div class="toast-body">
              Berhasil Menambahkan Data karyawan Baru
            </div>
          </div>
        </div>
      </div>';
        return response($output);
        // return redirect()->back()->with
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = user::firstWhere('id',$id);
        if($user->image != 'profile/anonime.jpg'){
            Storage::delete($user->image);
            user::where('id', $id)->delete();
        }
        user::where('id', $id)->delete();
        $output = '<div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-absolute top-0 end-0 p-3">
      
          <!-- Then put toasts within -->
          <div class="toast text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="my-toast">
          <div class="toast-body">
              Berhasil Menghapus Data karyawan
            </div>
          </div>
        </div>
      </div>';
        return response($output);
        
    }
}
