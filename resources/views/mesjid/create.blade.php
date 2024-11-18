@extends('layout.index')
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-download"></i> Pemasukan</h1>
      <p>Penginputan Pemasukan Kas</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-download fs-6"></i></li>
      <li class="breadcrumb-item">Pemasukan</li>
      <li class="breadcrumb-item"><a href="#">Tambah</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Input Tambah Data</h3>
        <div class="tile-body">
          @if ($errors->any())
          <div class="alert alert-success">
            <ul>
              @foreach ($errors->all() as $error )
              <li>{{ $error }}</li>
                
              @endforeach
            </ul>
            </div>            
          @endif
          <form action="{{ route('mesjid.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label">Tanggal Transaksi</label>
              <input class="form-control" type="date" name="tanggal" value="{{ old('tanggal') }}">
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis</label>
              <select name="jenis" class="form-control" id="jenis" value="{{ old('jenis') }}">
                <option value="-Pilih-">-Pilih-</option>
                <option value="Pemasukan">Pemasukan</option>
                <option value="Pengeluaran">Pengeluaran</option>
              </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-control" id="kategori" value="{{ old('kategori') }}">
                  <option value="-Pilih-">-Pilih-</option>
                  <option value="Infaq">Infaq</option>
                  <option value="Sedekah">Sedekah</option>
                  <option value="Zakat">Zakat</option>
                  <option value="Pembayaran Air">Pembayaran Air</option>
                  <option value="Pembayaran Listrik">Pembayaran Listrik</option>
                  <option value="Pembelian Barang">Pembelian Barang</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
                </div>
            <div class="mb-3">
              <label class="form-label">Jumlah</label>
              <input class="form-control" type="text" placeholder="" name="jumlah">
              
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <input class="form-control" type="text" placeholder="Masukan Deskripsi" name="deskripsi" value="{{ old('deskripsi') }}">
              </div>
            <div class="mb-3">
              <label class="form-label">Bukti Transaksi</label>
              <input class="form-control" type="file" name="foto" id="foto">
            </div>
            
            
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="bi bi-check-circle-fill me-2"></i>Tambah</button>
              &nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-danger">
                <i class="bi bi-x-circle-fill me-2"></i>Reset</button>
            </div>

          </form>
        </div>
        
      </div>
    </div>
    
    <!-- Page specific javascripts-->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{ asset('template') }}/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('template') }}/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>

        <script src="{{ asset('template') }}/js/jquery-3.7.0.min.js"></script>
        <script src="{{ asset('template') }}/js/bootstrap.min.js"></script>
        <script src="{{ asset('template') }}/js/main.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/autoNumeric/4.6.0/autoNumeric.min.js"></script>

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