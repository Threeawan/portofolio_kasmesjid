@extends('layout.index')
@section('content')


<main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="bi bi-book"></i> Laporan Kas Mesjid </h1>
        <p>Laporan Kas Mesjid</p>

      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-book fs-6"></i></li>
        <li class="breadcrumb-item">Kas Mesjid</li>
        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
      </ul>
    </div>


    <div class="row">

      <div class="clearix"></div>
      <div class="col-md-12">
        @include('mesjid.filter')



        <div class="row">
          
          <div class="col-md-12">

            <div class="tile">
              <div class="col-md-12">
                <div class="row d-print-none mt-2">
                  <div class="col-12 text-end">
                    <a class="btn btn-danger" href="javascript:window.print();">
                      <i class="bi bi-printer me-2"></i> Cetak </a>
                    </div>
                </div>
              <h6 align="center">Laporan Transaksi Mesjid</h6>
              <div class="tile-body">

                <div class="table-responsive">
                 

                  <table class="table table-hover table-bordered" id="sampleTable">

                    <thead>

                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                        <th>Bukti Transaksi</th>
                        <th>Saldo Akhir</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($laporan as $transaksi )
                        
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->tanggal }}</td>
                        <td>{{ $transaksi->jenis }}</td>
                        <td>{{ $transaksi->kategori }}</td>
                        <td>{{ formatRupiah($transaksi->jumlah)}}</td>
                        <td>{{ $transaksi->deskripsi }}</td>
                        <td>
                          @if ($transaksi->foto)
                            <img style="max-width:50px;max-height:50px" src="{{ url('foto').'/'.$transaksi->foto }}">
                          @endif
                        </td>
                        <td>{{formatRupiah($transaksi->saldo_akhir)}} </td>
                       
                       
                       
                      </tr>
    
                      @endforeach
    
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="js/jquery-3.7.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- Page specific javascripts-->
  <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
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

  @endsection