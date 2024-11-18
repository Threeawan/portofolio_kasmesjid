<?php

namespace App\Http\Controllers\Manajemen;

use Illuminate\Http\Request;
use App\Models\Manajemen\Manajemen;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ManajemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manajemen.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         //
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_user'=>'required',
            'username'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role'=>'required',
        ],[
            'nama_user.required'=>'Nama User wajib diisi',
            'username.required'=>'Username wajib diisi',
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
            'role.required'=>'Role wajib diisi',
        ]);

        $manajemen = [
            'nama_user'=>$request->input('nama_user'),
            'username'=>$request->input('username'),
            'email'=>$request->input('email'),
            'password'=>bcrypt($request->password),
            'role'=>$request->input('role'),
        ];

        Manajemen::create($manajemen);
        return redirect()->route('manajemen.detail')->with('success','User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
        return view('manajemen.detail')->with('manajemen', Manajemen::all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('manajemen.edit')->with('manajemen', Manajemen::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $manajemen = [
            'nama_user'=>$request->input('nama_user'),
            'username'=>$request->input('username'),
            'email'=>$request->input('email'),
            'password'=>bcrypt($request->password),
            'role'=>$request->input('role'),
        ];

        Manajemen::where('id',$id)->update($manajemen);
        return redirect()->route('manajemen.detail')->with('success', 'User Berhasil Diubah');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Manajemen::where('id',$id)->delete();
       // Tampilkan notifikasi SweetAlert
       Alert::success('Berhasil', 'Data berhasil dihapus!');
       return redirect()->route('manajemen.detail');
    }

    public function dashboard()
    {
        // Hitung total pemasukan (dari jenis 'Pemasukan')
        $totalUser = Manajemen::where('role', 'User')->sum('jumlah');

        // Hitung total pengeluaran (dari jenis 'Pengeluaran')
        $totalAdmin = Manajemen::where('role', 'Admin')->sum('jumlah');

        // Hitung total saldo (pemasukan - pengeluaran)
        $totalPengguna = $totalUser + $totalAdmin;

    return view('manajemen.dashboard', compact('totalAdmin', 'totalUser', 'totalPengguna'));

    }

   

   
}
