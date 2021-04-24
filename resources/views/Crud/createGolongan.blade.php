<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | Create Golongan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset ('Lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset ('Lte/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
   <!-- Navbar -->
    @include('adminDashboard/header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   @include('adminDashboard/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Data Golongan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('create-golongan') }}"><i class="fas fa-plus"></i> Tambah Data
                </a>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
 <!-- Begin Page Content -->
 <div class="card shadow mb-4">
    <div class="card shadow">
        <form method="POST" enctype="multipart/form-data" action="{{route('add-golongan')}}">
        @csrf 
            <div class="row card-header">
                <div class="col">
                    <label for="id_pelabuhan" class="font-weight-bold text-dark"> Pelabuhan</label>
                    <select name="id_pelabuhan" class="custom-select" required>
                    @foreach($pelabuhan as $pl)
                      <option value="{{$pl->id}}">{{$pl->nama_pelabuhan}}</option>
                    @endforeach
                </select>
                </div>
                </div>

                <div class="row card-header">
                <div class="col">
                    <label for="golongan" class="font-weight-bold text-dark">Golongan</label>
                    <input type="text" class="form-control" id="golongan" placeholder="Masukan Golongan" name="golongan">
                </div>
                <div class="col">   
                </div>
            </div>
                <div class="form-group card-header ">
                  <label for="keterangan" class="font-weight-bold text-dark">Keterangan</label>
                  <textarea class="form-control" name="keterangan" id="keterangan" rows="10" placeholder="Keterangan"></textarea>
                </div>

                <div class="row card-header">
                <div class="col">
                    <label for="harga" class="font-weight-bold text-dark">Harga</label>
                    <input type="text" class="form-control" id="harga" placeholder="Masukan Harga" name="harga">
                </div>
                <div class="col">   
                </div>
            </div>
            
            <div class="form-group card-header">
                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Add Data</button>
            </div>
        </form>
    </div>
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('adminDashboard/footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script> $('input[name="daterange"]').daterangepicker(); </script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="{{ asset ('Lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('Lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('Lte//dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>
</body>
</html>
