<?php

namespace App\Http\Controllers\Pengeluaran;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengeluaran.create');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function pengeluaran()
    {
        $jumlah_pengeluaran = Pengeluaran::all()->count();
        return view('pengeluaran.dashboard')->with('jumlah_pengeluaran',$jumlah_pengeluaran);
    }



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
            'due_date'=>'required',
            'kategori_pengeluaran'=>'required',
            'deskripsi_transaksi'=>'required',
            'jumlah_pengeluaran'=>'required',
        ],[
            'due_date.required'=>'Tanggal wajib diisi',
            'kategori_pengeluaran.required'=>'Kategori wajib diisi',
            'deskripsi_transaksi.required'=>'Deskripsi wajib diisi',
            'jumlah_pengeluaran.required'=>'Jumlah wajib diisi',
        ]);

        $request['jumlah_pengeluaran'] = str_replace('.','',$request['jumlah_pengeluaran']);


        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis').".".$foto_ekstensi;
        $foto_file->move(public_path('foto'),$foto_nama);

        $pengeluaran = [
            'due_date'=>$request->input('due_date'),
            'kategori_pengeluaran'=>$request->input('kategori_pengeluaran'),
            'deskripsi_transaksi'=>$request->input('deskripsi_transaksi'),
            'jumlah_pengeluaran'=>$request->input('jumlah_pengeluaran'),
            'foto'=>$foto_nama,

        ];

        Pengeluaran::create($pengeluaran);
        return redirect()->route('pengeluaran.detail')->with('success','Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('pengeluaran.detail')->with('pengeluaran', Pengeluaran::all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengeluaran = Pengeluaran::where('id',$id)->first();
        File::delete(public_path('foto').'/'.$pengeluaran->foto);

        Pengeluaran::where('id',$id)->delete();
        return redirect()->route('pengeluaran.detail')->with('success','Data Berhasil Dihapus');
    }

    public function laporanPengeluaran()
    {
        return view('pengeluaran.laporan')->with('pengeluaran', Pengeluaran::all());
    }

    public function filter(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir =  $request->tanggal_akhir;

        $pengeluaran = Pengeluaran::whereDate('created_at','>=',$tanggal_awal)
                        ->whereDate('created_at','<=',$tanggal_akhir)->get();
        
        return view('pengeluaran.laporan', compact('pengeluaran'));
    }

    public function dashboardPengeluaran()
    {
        $jumlah_pengeluaran = Pengeluaran::all()->count();
        return view('pengeluaran.dashboard')->with('jumlah_pengeluaran',$jumlah_pengeluaran);
    }
}
