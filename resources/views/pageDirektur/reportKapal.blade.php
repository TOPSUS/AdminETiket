<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Dashboard | Report Kapal</title>
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
    @include('direkturKapal.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   @include('direkturKapal.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li><a href="{{ route('reportCetak') }}" class= "btn btn-success text-white"></i> Cetak</a></li>
            </ol>
          </div>


          <div class="container">
            <div class="row">
              <div class="container-fluid">
                <div class="form-group row">
                  <label for="date" class="col-form-label col-sm-2">Transaksi Dari Tanggal</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control input-sm" id="fromDate" name="fromDate" />
                    </div>
                  <label for="date" class="col-form-label col-sm-2">Sampai Tanggal</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control input-sm" id="toDate" name="toDate" />
                    </div>
                  <div class="col-sm-2">
                    <li style="list-style-type:none;">
                      <a href="#" type="button" class= "btn btn-info"></i> Search</a>
                    </li>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <hr style="margin-top: 20px" class="sidebar-divider my-0">
        <!-- DataTales Example -->
        <!-- Copy drisini -->
        <div class="card shadow mb-4">
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Nama Pembeli</th>
                    <th>Keberangkatan</th>
                    <th>Pelabuhan Asal</th>
                    <th>Pelabuhan Tujuan</th>
                    <th>Kapal</th>
                    <th>Tanggal Pembelian</th>
                    </tr>
                </thead>


                </table>
            </div>
            </div>
        </div>
        <!-- smpe sini -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @include('direkturKapal.footer')

<!-- jQuery -->
<script src="{{ asset ('Lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('Lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('Lte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>

</body>
</html>
