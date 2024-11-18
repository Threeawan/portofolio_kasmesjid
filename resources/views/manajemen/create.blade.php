@extends('layout.index')
@section('content')


<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-people"></i> User </h1>
      <p>Tambah User Baru</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-people fs-6"></i></li>
      <li class="breadcrumb-item">User</li>
      <li class="breadcrumb-item"><a href="#">Tambah User</a></li>
    </ul>
  </div>
  <div class="row">
   
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Register</h3>
        <div class="tile-body">
          @if ($errors->any())
          <div class="alert alert-success">
            <ul>
              @foreach ($errors->all() as $error)
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
                    <button class="btn btn-danger" type="reset"><i class="bi bi-x-circle-fill me-2"></i>Reset</a>
                </div>
              </div>
            </div>
          </form>
        </div>
        
      </div>
    </div>
    <div class="clearix"></div>
    
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

<script src="js/jquery-3.7.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
  
</body>
</html>
  @endsection