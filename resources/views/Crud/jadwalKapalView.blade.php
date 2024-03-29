<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard | Jadwal Kapal</title>
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
@include('adminDashboard.header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('adminDashboard.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Jadwal</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('create-jadwalkapal') }}"><i
                                        class="fas fa-plus"></i> Tambah Data
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
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
                                <th>Asal</th>
                                <th>Waktu Berangkat</th>
                                <th>Tujuan</th>
                                <th>Waktu Sampai</th>
                                <th>Kapal</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($dataJadwalKapal as $jadwal)
                                <tr>
                                    <td>{{$jadwal->asal->nama_pelabuhan}}</td>
                                    <td>{{$jadwal->waktu_berangkat}}</td>
                                    <td>{{$jadwal->tujuan->nama_pelabuhan}}</td>
                                    <td>{{$jadwal->waktu_sampai}}</td>
                                    <td>{{$jadwal->kapal->nama_kapal}}</td>

                                    <td>
                                        <a class="btn btn-sm bg-danger"
                                           href="/Dashboard/CRUD/DeleteJadwal/{{$jadwal->id}}"> <i
                                                class="fas fa-trash-alt"></i></a>
                                        <a data-toggle="modal" data-target="#update{{$jadwal->id}}"
                                           class="btn btn-sm btn-primary" href="#"><i class="fas fa-edit"></i> Edit
                                            Jadwal
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- smpe sini -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@include('adminDashboard.footer')


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
