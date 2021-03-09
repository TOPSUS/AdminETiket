<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | Create Jadwal</title>
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
            <h1>Add Data Jadwal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('viewjadwal') }}">Data Jadwal</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('create-jadwal') }}"><i class="fas fa-plus"></i> Tambah Data
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
        <form method="POST" enctype="multipart/form-data" action="#">
          
            <div class="row card-header">
                <div class="col">
                    <label for="asal" class="font-weight-bold text-dark">Asal Pelabuhan</label>
                    <select name="id_asal_pelabuhan" class="custom-select" required>
                   
                </select>
                </div>
                <div class="col">
                    <label for="tujuan" class="font-weight-bold text-dark">Tujuan Pelabuhan</label>
                    <select name="id_tujuan_pelabuhan" class="custom-select" required>
                   
                </select>
                </div>
            </div>
            <div class="row card-header">
                <div class="col">
                    <label for="asal" class="font-weight-bold text-dark">Waktu Berangkat</label>
                    <input type="time" step="1" class="form-control" id="asal" placeholder="Masukan Asal Speedboat" name="waktu_berangkat">
                </div>
                <div class="col">
                    <label for="tujuan" class="font-weight-bold text-dark">Waktu Sampai</label>
                    <input type="time" step="1" class="form-control" id="tujuan" placeholder="Masukan Tujuan Speedboat" name="waktu_sampai">
                </div>
            </div>

            <div class="form-group card-header ">
                <label for="alamat" class="font-weight-bold text-dark">Speed Boat</label>
                <select name="id_speedboat" class="custom-select" required>
                   
                </select>
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
<script src="{{ asset ('Lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('Lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('Lte//dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>
</body>
</html>
