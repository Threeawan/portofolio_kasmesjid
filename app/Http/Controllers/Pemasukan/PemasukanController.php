<?php

namespace App\Http\Controllers\Pemasukan;

use Illuminate\Http\Request;
use App\Models\Pemasukan\Pemasukan;
use App\Http\Controllers\Controller;
use App\Models\Pengeluaran\Pengeluaran;
use Illuminate\Support\Facades\File;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pemasukan.create');
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
            'due_date'=>'required',
            'kategori_pemasukan'=>'required|string|max:255',
            'deskripsi_transaksi'=>'required|string|max:255',
            'jumlah_pemasukan'=>'required|numeric',
            'foto'=>'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ],[
            'due_date.required'=>'Tanggal wajib diisi',
            'kategori_pemasuka.required'=>'Kategori wajib diisi',
            'deskripsi_transaksi.required'=>'Deskripsi wajib diisi',
            'jumlah_pemasukan.required'=>'Jumlah wajib diisi',
        ]);

        $request['jumlah_pemasukan'] = str_replace('.','',$request['jumlah_pemasukan']);


        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis').".".$foto_ekstensi;
        $foto_file->move(public_path('foto'),$foto_nama);

        //hitung saldo terakhir
        $lastPemasukan = Pemasukan::latest()->first();
        $lastSaldo = $lastPemasukan ? $lastPemasukan->saldo:0;

        //tambahkan jumlah pemasukan ke saldo terakhir
        $newSaldo = $lastSaldo + $request['jumlah_pemasukan'];

        $pemasukan = [
            'due_date'=>$request->input('due_date'),
            'kategori_pemasukan'=>$request->input('kategori_pemasukan'),
            'deskripsi_transaksi'=>$request->input('deskripsi_transaksi'),
            'jumlah_pemasukan'=>$request->input('jumlah_pemasukan'),
            'foto'=>$foto_nama,
            'saldo_akhir'=>$newSaldo,
        ];

        Pemasukan::create($pemasukan);
        return redirect()->route('pemasukan.detail')->with('success','Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('pemasukan.detail')->with('pemasukan', Pemasukan::all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pemasukan.detail')->with('pemasukan', Pemasukan::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pemasukan = [
            'due_date'=>$request->input('due_date'),
            'kategori_pemasukan'=>$request->input('kategori_pemasukan'),
            'deskripsi_transaksi'=>$request->input('deskripsi_transaksi'),
            'jumlah_pemasukan'=>$request->input('jumlah_pemasukan'),
        ];

        if($request->hasFile('foto')){
            $request->validate([
                'foto' => 'mimes:jpeg,jpg,png,gif'
            ],[
                'foto.mimes' => 'Foto hanya diperbolehkan berekstensi JPEG,JPG,PNG, dan GIF'
            ]);
    
        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis').".".$foto_ekstensi;
        $foto_file->move(public_path('foto'),$foto_nama);
        
        $pemasukan_foto = Pemasukan::where('id',$id)->first();
        File::delete(public_path('foto').'/'.$pemasukan_foto->foto);

        $pemasukan['foto'] = $foto_nama;
        }  

        Pemasukan::where('id',$id)->update($pemasukan);
        return redirect()->route('pemasukan.detail')->with('success','Data Berhasil Diubah');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $pemasukan = Pemasukan::where('id',$id)->first();
        File::delete(public_path('foto').'/'.$pemasukan->foto);

        Pemasukan::where('id',$id)->delete();
        return redirect()->route('pemasukan.detail')->with('success','Data Berhasil Dihapus');
    }

    public function laporanPemasukan()
    {
        return view('pemasukan.laporan')->with('pemasukan', Pemasukan::all());
    }

    public function filter(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $pemasukan = Pemasukan::whereDate('created_at','>=', $tanggal_awal)
                    ->whereDate('created_at','<=', $tanggal_akhir)->get();

        return view('pemasukan.laporan', compact('pemasukan'));

    }

   
    public function tanggalPemasukan(Request $request)
    {
        $pemasukan = Pemasukan::query();

        if($request->has(['start_date','end_date'])){
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $pemasukan = $pemasukan->whereBetween('due_date',[$start_date, $end_date]);
        }
        $pemasukan = $pemasukan->get();
        return view('pemasukan.laporan', compact('pemasukan'));
    }

    public function pemasukan()
    {
        $jumlah_pemasukan = Pemasukan::all()->count();
        return view('pemasukan.dashboard')->with('jumlah_pemasukan',$jumlah_pemasukan);
    }

    public function totalSaldoAkhir()
    {
        //hitung total saldo_akhir menggunakan agregasi sum
        $totalSaldoAkhir = Pemasukan::sum('saldo_akhir');
        return view('pemasukan.detail',compact('totalSaldoAkhir'));
    }

  
}
