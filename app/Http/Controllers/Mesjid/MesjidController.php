<?php

namespace App\Http\Controllers\Mesjid;

use Illuminate\Http\Request;
use App\Models\Mesjid\Mesjid;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class MesjidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data dari tabel mesjids
        $mesjid = Mesjid::all();

        // Menghitung saldo akhir dari transaksi terakhir
        $saldo_akhir = Mesjid::orderBy('tanggal', 'desc')->first()->saldo_akhir ?? 0;

        // Menampilkan data ke view
        return view('mesjid.create', compact('mesjid', 'saldo_akhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
   

    public function create()
    {
        // 
    }

    // Fungsi untuk menghitung saldo akhir
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'kategori' => 'required|in:Infaq,Sedekah,Zakat,Pembayaran Air,Pembayaran Listrik,Pembelian Barang,Lainnya',
            'jumlah' => 'required',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // validasi file gambar
        ],[
            'tanggal.required'=>'Tanggal Wajib Diisi',
            'jenis.required'=>'Jenis Wajib Diisi',
            'kategori.required'=>'Kategori Wajib Diisi',
            'jumlah.required'=>'Jumlah Wajib Diisi',
            'deskripsi.required'=>'Deskripsi Wajib Diisi',
            'foto.required'=>'Foto Wajib Diisi',
            'foto.mimes'=>'Jenis ekstensi yang diperbolehkan JPG,JPEG,PNG dan GIF',
        ]);

        $validatedData['jumlah'] = str_replace('.','',$validatedData['jumlah']);
        // Ambil saldo akhir terbaru dari transaksi sebelumnya
        $saldoTerakhir = Mesjid::orderBy('tanggal', 'desc')->orderBy('id', 'desc')->value('saldo_akhir') ?? 0;

        // Hitung saldo akhir berdasarkan jenis transaksi
        if ($request->jenis == 'Pemasukan') {
            $saldoAkhirBaru = $saldoTerakhir + $request->jumlah;
        } elseif ($request->jenis == 'Pengeluaran') {
            $saldoAkhirBaru = $saldoTerakhir - $request->jumlah;
        }
        
        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis').".".$foto_ekstensi;
        $foto_file->move(public_path('foto'),$foto_nama);

        // Simpan data ke database
        Mesjid::create([
            'tanggal' => $validatedData['tanggal'],
            'jenis' => $validatedData['jenis'],
            'kategori' => $validatedData['kategori'],
            'jumlah' => $validatedData['jumlah'],
            'deskripsi' => $validatedData['deskripsi'],
            'foto' => $foto_nama,
            'saldo_akhir' => $saldoAkhirBaru // Simpan saldo akhir yang telah dihitung
        ]);

        return redirect()->route('mesjid.detail')->with('success','Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('mesjid.detail')->with('mesjid',Mesjid::all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('mesjid.edit')->with('mesjid',Mesjid::find($id));
    }


    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $mesjid = [
            'tanggal'=>$request->input('tanggal'),
            'jenis'=>$request->input('jenis'),
            'kategori'=>$request->input('kategori'),
            'jumlah'=>$request->input('jumlah'),
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
        
        $mesjid_foto = Mesjid::where('id',$id)->first();
        File::delete(public_path('foto').'/'.$mesjid_foto->foto);

        $mesjid['foto'] = $foto_nama;
        }  

        Mesjid::where('id',$id)->update($mesjid);
            // Hitung ulang saldo akhir setelah update
            $this->updateSaldoAkhir();
        return redirect()->route('mesjid.detail')->with('success','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      
        $mesjid = Mesjid::where('id',$id)->first();
        File::delete(public_path('foto').'/'.$mesjid->foto);

                  // Cari transaksi berdasarkan id
                  $transaksi = Mesjid::findOrFail($id);

                  // Ambil data transaksi yang akan dihapus
                  $jenis = $transaksi->jenis;
                  $jumlah = $transaksi->jumlah;
      
                  // Hapus data transaksi
                  $transaksi->delete();
      
                  // Update saldo akhir setelah penghapusan
                  if ($jenis == 'Pemasukan') {
                      // Jika transaksi adalah pemasukan, kurangi saldo akhir dengan jumlah yang dihapus
                      Mesjid::orderBy('tanggal', 'desc')->first()->decrement('saldo_akhir', $jumlah);
                  } elseif ($jenis == 'Pengeluaran') {
                      // Jika transaksi adalah pengeluaran, tambahkan saldo akhir dengan jumlah yang dihapus
                      Mesjid::orderBy('tanggal', 'desc')->first()->increment('saldo_akhir', $jumlah);
                  }
      

        Mesjid::where('id',$id)->delete();
        return redirect()->route('mesjid.detail')->with('success','Data Berhasil Dihapus');
    }

    public function dashboard()
    {
         // Hitung total pemasukan (dari jenis 'Pemasukan')
            $totalPemasukan = Mesjid::where('jenis', 'Pemasukan')->sum('jumlah');

            // Hitung total pengeluaran (dari jenis 'Pengeluaran')
            $totalPengeluaran = Mesjid::where('jenis', 'Pengeluaran')->sum('jumlah');

            // Hitung total saldo (pemasukan - pengeluaran)
            $totalSaldo = $totalPemasukan - $totalPengeluaran;

            // Mengembalikan ke view dashboard dengan saldo_akhir
            return view('mesjid.dashboard', compact('totalPemasukan','totalPengeluaran','totalSaldo'));
        
    }

    public function cetakLaporan(Request $request)
    {
        // Mengambil input dari form (tanggal awal, tanggal akhir, dan kategori)
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $kategori = $request->input('kategori');

        // Query untuk mengambil data berdasarkan tanggal
        $query = Mesjid::whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);

        // Jika kategori dipilih, filter berdasarkan kategori
        if ($kategori && $kategori != 'Semua') {
            $query->where('kategori', $kategori);
        }

        // Ambil data dari query
        $laporan = $query->get();

        // Mengembalikan data laporan ke view
        return view('mesjid.laporan', compact('laporan', 'tanggal_awal', 'tanggal_akhir', 'kategori'));
    }

    public function filter()
    {
        return view('mesjid.filter');
    }

    
}
