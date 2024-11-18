@extends('layout.index')
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-pencil"></i> Ubah</h1>
      <p>Ubah Data Kas</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-pencil fs-6"></i></li>
      <li class="breadcrumb-item">Pemasukan</li>
      <li class="breadcrumb-item"><a href="#">Tambah</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Ubah Data Kas</h3>
        <div class="tile-body">
          
          <form action="{{ route('mesjid.update',$mesjid->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label">Tanggal Transaksi</label>
              <input class="form-control" type="date" name="tanggal" value="{{ old('tanggal', $mesjid->tanggal) }}">
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis</label>
              <select id="jenis" name="jenis" class="form-control">
                <option value="Pemasukan" {{ $mesjid->jenis == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                <option value="Pengeluaran" {{ $mesjid->jenis == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
              </select>
              </div>
              <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" class="form-control">
                  <option value="Infaq" {{ $mesjid->kategori == 'Infaq' ? 'selected' : '' }}>Infaq</option>
                  <option value="Sedekah" {{ $mesjid->kategori == 'Sedekah' ? 'selected' : '' }}>Sedekah</option>
                  <option value="Zakat" {{ $mesjid->kategori == 'Zakat' ? 'selected' : '' }}>Zakat</option>
                  <option value="Pembayaran Air" {{ $mesjid->kategori == 'Pembayaran Air' ? 'selected' : '' }}>Pembayaran Air</option>
                  <option value="Pembayaran Listrik" {{ $mesjid->kategori == 'Pembayaran Listrik' ? 'selected' : '' }}>Pembayaran Listrik</option>
                  <option value="Pembelian Barang" {{ $mesjid->kategori == 'Pembelian Barang' ? 'selected' : '' }}>Pembelian Barang</option>
                  <option value="Lainnya" {{ $mesjid->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Jumlah</label>
                  <input class="form-control" type="number" name="jumlah" value="{{ old('jumlah', $mesjid->jumlah) }}" readonly>
                </div>
                <div class="mb-3">
                  <label class="form-label">Deskripsi</label>
                  <input class="form-control" type="text" name="deskripsi" value="{{ old('deskripsi', $mesjid->deskripsi) }}">
                </div>

            @if ($mesjid->foto)

            <div class="mb-3">
              <img style="max-width:50px;max-height:50px" src="{{ url('foto').'/'.$mesjid->foto }}" alt="">
          </div>
          @endif

          <div class="mb-3">
            <label class="form-label">Bukti Transaksi</label>
            <input class="form-control" type="file" name="foto" id="foto">
          </div>
            
            
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-circle-fill me-2"></i>Ubah</button>&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('/mesjid_detail') }}" class="btn btn-danger"><i class="bi bi-x-circle-fill me-2"></i>Kembali</a>
                </div>
              </div>
            </div>

          </form>
        </div>
        
      </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script>
      $(document).ready(function () { 
        $('.rupiah').mask("#.##0", {reverse: true});

       })
    </script>
  </div>
</main>
@endsection