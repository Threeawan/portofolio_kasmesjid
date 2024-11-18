@extends('layout.index')
@section('content')
<html>
  <head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <body>
      <main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="bi bi-folder"></i> Data User</h1>
            <p>Daftar Data User</p>
          </div>
          <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="bi bi-folder fs-6"></i></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active"><a href="#">Data User</a></li>
          </ul>
        </div>
          
       @include('manajemen.dashboard')
    
         
          <div class="col-md-12">
            <div class="tile">
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
                    
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUser">
                            <i class="bi bi-laptop me-2"></i>Tambah User 
                        </button>
                    </div>
    
                    
                    <br>
    
    
                    <!-- Modal Tambah User-->
                        <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-check-circle-fill me-2"></i>Tambah User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if ($errors->any())
                                    <div class="alert alert-success">
                                        <ul>
                                            @foreach ($errors->all() as $error )
                                            <li>{{ $error }}</li>
                                            @endforeach
    
                                        </ul>
                                    </div>
    
                                    @endif
                                    <form action="{{ route('manajemen.post') }}" method="POST" class="form-horizontal">
                                        @csrf
                                        <div class="mb-3 row">
                                          <label class="form-label col-md-3">Nama User</label>
                                          <div class="col-md-8">
                                            <input class="form-control" type="text" placeholder="" name="nama_user">
                                          </div>
                                        </div>
                                        <div class="mb-3 row">
                                          <label class="form-label col-md-3">Username</label>
                                          <div class="col-md-8">
                                            <input class="form-control col-md-8" type="text" placeholder="" name="username">
                                          </div>
                                        </div>
                                        <div class="mb-3 row">
                                          <label class="form-label col-md-3">Email</label>
                                          <div class="col-md-8">
                                            <input class="form-control col-md-8" type="email" placeholder="" name="email">
                                          </div>
                                        </div>
                                        <div class="mb-3 row">
                                          <label class="form-label col-md-3">Password</label>
                                          <div class="col-md-8">
                                            <input class="form-control col-md-8" type="password" placeholder="" name="password">
                                          </div>
                                        </div>
                                        <div class="mb-3 row">
                                          <label class="form-label col-md-3">Role</label>
                                          <div class="col-md-8">
                                           <select name="role" id="role" class="form-control">
                                            <option value="-Pilih-">-Pilih-</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                           </select>
                                          </div>
                                        </div>
                                     
                                        <div class="tile-footer">
                                          <div class="row">
                                            <div class="col-md-8 col-md-offset-3">
                                              <button class="btn btn-primary" type="submit">
                                                <i class="bi bi-check-circle-fill me-2"></i>Simpan</button>&nbsp;&nbsp;&nbsp;
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill me-2"></i></i>Keluar</button>
                                            </div>
                                          </div>
                                        </div>
                                      </form>
                                </div>
                                
                            </div>
                            </div>
                        </div>
    
    
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($manajemen as $manajemen )
                            
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $manajemen->nama_user }}</td>
                        <td>{{ $manajemen->username }}</td>
                        <td>{{ $manajemen->email }}</td>
                        <td>********</td>
                        <td>{{ $manajemen->role }}</td>
                        <td>
                        
                          
                          <a href="{{ url('/manajemen_edit/'.$manajemen->id) }}" class="btn btn-warning" type="submit"> <i class="bi bi-pen-fill me-2"></i>Edit</a>
                          <a href="{{ url('/manajemen_delete/'.$manajemen->id) }}" class="btn btn-danger" type="submit"> <i class="bi bi-pen-fill me-2"></i>Hapus</a>
                          

                        </td>
                      </tr>
                      @endforeach

                      @include('sweetalert::alert')
    
                    </tbody>
                  </table>
                 
                </div>
                 
                
              </div>
            </div>
          </div>
        </div>
      </main>
    </body>
  </head>
</html>

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
  
  @endsection