@extends('layout.index')
@section('content')
<html>
  <head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <body>
      <main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="bi bi-clipboard"></i> Daftar Transaksi</h1>
            <p>Transaksi Kas Manajemen</p>
          </div>
          <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="bi bi-clipboard fs-6"></i></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item active"><a href="{{ url('/mesjid_detail') }}">Data Transaksi</a></li>
          </ul>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="col-md-12">
                <div class="row d-print-none mt-2">
                  <div class="col-12 text-end">
                    <a class="btn btn-primary" href="javascript:window.print();">
                      <i class="bi bi-printer me-2"></i> Cetak </a>
                    </div>
                </div>
                <br>
              <div class="tile-body">
                @if (session('success'))
                <script>
                    // SweetAlert untuk notifikasi sukses
                    Swal.fire({
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>
                @endif
      
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
                        <th>Aksi</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($mesjid as $mesjid )
                        
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mesjid->tanggal }}</td>
                        <td>{{ $mesjid->jenis }}</td>
                        <td>{{ $mesjid->kategori }}</td>
                        <td>{{ formatRupiah($mesjid->jumlah)}}</td>
                        <td>{{ $mesjid->deskripsi }}</td>
                        <td>
                          @if ($mesjid->foto)
                            <img style="max-width:50px;max-height:50px" src="{{ url('foto').'/'.$mesjid->foto }}">
                          @endif
                        </td>
                        <td>{{formatRupiah($mesjid->saldo_akhir)}} </td>
                       <td>
                        <a href="{{ url('/mesjid_delete/'.$mesjid->id) }}" class="btn btn-danger" type="submit"> <i class="bi bi-trash-fill me-2"></i>Hapus</a>

                        <!--<form id="delete-form" action="" method="POST" style="display: none;">
                          @csrf
                          @method('DELETE')
                      </form>-->
                      
                      </td>
                       
                       
                      </tr>
      
                      @endforeach
      
                    </tbody>
                  </table>
                  <!--<script>
                    function deleteConfirmation(id) {
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data akan dihapus secara permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let form = document.getElementById('delete-form');
                                form.action = '/mesjid_detail/' + id;
                                form.submit();
                            }
                        })
                    }
                    </script>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </body>
  </head>
</html>

 <!-- Essential javascripts for application to work-->
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
 
@include('sweetalert::alert')

</body>
</html>
  @endsection