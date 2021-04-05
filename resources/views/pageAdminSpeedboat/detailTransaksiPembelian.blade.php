<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | User Speedboat</title>
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
    @include('adminSpeedboat/header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   @include('adminSpeedboat/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contact E-Tiket Speedboat </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('adminSpeedboatHome') }}">Dashboard</a></li>
                </a>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> E-Tiket Speedboat
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          
          <address>
            <strong>{{$dataPembelian->user->nama}}</strong><br>
            Address :{{$dataPembelian->user->alamat}}<br>
            Phone :{{$dataPembelian->user->nohp}}<br>
            Email: {{$dataPembelian->user->email}}
            <br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Speedboat</b>
          <address>
            {{$dataPembelian->jadwal->kapal->nama_kapal}}<br>
            From : {{$dataPembelian->jadwal->waktu_berangkat}} - {{$dataPembelian->jadwal->asal->nama_pelabuhan}}<br>
            To :{{$dataPembelian->jadwal->waktu_sampai}} - {{$dataPembelian->jadwal->tujuan->nama_pelabuhan}}<br>

          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Status</b><br>
          <b>Date :</b> {{$dataPembelian->tanggal}}<br>
          <b>Status :</b> {{$dataPembelian->status}}<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Kode Tiket</th>
              <th>Id Card(Tipe)</th>
              <th>Status Tiket</th>
              <th>Sub Total</th>
            </tr>
            </thead>
            <tbody>
          @foreach($dataPembelian->detailPembelian as $pembelian)
            <tr>
              <td>{{$pembelian->nama_pemegang_tiket}}</td>
              <td>{{$pembelian->kode_tiket}}</td>
              <td>{{$pembelian->no_id_card}}</td>
              <td>{{$pembelian->status}}</td>
              <td>{{$pembelian->harga}}</td>
            </tr>
          @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">


          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Price:</th>
                <td>{{$jumlah}}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>{{$jumlah}}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-sm-12"> &nbsp
          <a href="#" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print </a>
          &nbsp
          <a class="btn btn-danger pull-right" style="margin-right: 5px;" href="Reject/{{$dataPembelian->id}}">
            <i class="fa fa-times"></i> Reject
          </a>
          <a class="btn btn-success pull-right" href="Approve/{{$dataPembelian->id}}"><i class="fa fa-check"></i> Approve
          </a> 

        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->
        </div>
       
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('adminSpeedboat/footer')
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
