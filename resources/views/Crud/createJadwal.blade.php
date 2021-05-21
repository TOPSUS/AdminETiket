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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
                        <h1>Add Data Jadwal</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('create-jadwal') }}"><i
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
            <!-- Begin Page Content -->
            <div class="card shadow mb-4">
                <div class="card shadow">
                    <form method="POST" enctype="multipart/form-data" action="{{route('add-jadwal')}}">
                        @csrf
                        <div class="row card-header">
                            <div class="col">
                                <label for="id_asal_pelabuhan" class="font-weight-bold text-dark">Asal Pelabuhan</label>
                                <select name="id_asal_pelabuhan" class="custom-select @error('id_asal_pelabuhan') is-invalid @enderror" required>
                                    <option value="">-- Asal Pelabuhan --</option>
                                    @foreach($pelabuhan as $asal)
                                        <option value="{{$asal->id}}">{{$asal->nama_pelabuhan}}</option>
                                    @endforeach
                                </select>
                                @error('id_asal_pelabuhan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="id_tujuan_pelabuhan" class="font-weight-bold text-dark">Tujuan
                                    Pelabuhan</label>
                                <select name="id_tujuan_pelabuhan" class="custom-select @error('id_tujuan_pelabuhan') is-invalid @enderror" required>
                                    <option value="">-- Tujuan Pelabuhan --</option>
                                    @foreach($pelabuhan as $tujuan)
                                        <option value="{{$tujuan->id}}">{{$tujuan->nama_pelabuhan}}</option>
                                    @endforeach
                                </select>
                                @error('id_tujuan_pelabuhan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row card-header">
                            <div class="col-xl-6 col-sm-6 col-md-6">
                                <label for="daterange" class="font-weight-bold text-dark">Tanggal</label>
                                <input type="text" name="daterange" class="form-control @error('daterange') is-invalid @enderror" id="daterange">
                                @error('daterange')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-2 col-sm-2 col-md-2">
                                <label for="estimasi_waktu" class="font-weight-bold text-dark">Estimasi Waktu (Menit)</label>
                                <input type="number" min="0" class="form-control @error('estimasi_waktu') is-invalid @enderror" id="estimasi_waktu"
                                       placeholder="Masukan Estimasi Waktu" name="estimasi_waktu">
                                @error('estimasi_waktu')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xl-4 col-sm-4 col-md-4">
                                <label for="waktu_berangkat" class="font-weight-bold text-dark">Waktu Berangkat</label>
                                <input type="time" step="1" class="form-control @error('waktu_berangkat') is-invalid @enderror" id="waktu_berangkat"
                                       placeholder="Masukan Asal Kapal" name="waktu_berangkat">
                                @error('waktu_berangkat')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group card-header ">
                            <label for="id_kapal" class="font-weight-bold text-dark">Kapal Pilihan</label>
                            <select name="id_kapal" class="custom-select @error('id_kapal') is-invalid @enderror" required>
                                @foreach($kapal as $sb)
                                    <option value="{{$sb->id}}">{{$sb->nama_kapal}}</option>
                                @endforeach
                            </select>
                            @error('id_kapal')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row card-header">
                            <div class="col">
                                <label for="harga" class="font-weight-bold text-dark">Harga Tiket</label>
                                <input type="text" step="1" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                       placeholder="Masukan Harga Tiket" name="harga">
                            </div>
                            @error('harga')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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

@include('adminDashboard.footer')
<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script> $('input[name="daterange"]').daterangepicker(); </script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<script src="{{ asset ('Lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('Lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('Lte//dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>
</body>
</html>
