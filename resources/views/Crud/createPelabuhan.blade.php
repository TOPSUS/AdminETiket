<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | Create Pelabuhan</title>
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
                        <h1>Data Pelabuhan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('create-pelabuhan') }}"><i
                                        class="fas fa-plus"></i> Tambah Data
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="card shadow mb-4">
            <div class="card shadow">
                <form method="POST" enctype="multipart/form-data" action="{{route('add-pelabuhan')}}">
                    @csrf
                    <div class="row card-header">
                        <div class="col">
                            <label for="nama_pelabuhan" class="font-weight-bold text-dark">Nama Pelabuhan</label>
                            <input type="text" class="form-control" id="nama_pelabuhan"
                                   placeholder="Masukan Nama Pelabuhan" name="nama_pelabuhan">
                        </div>
                        <div class="col">
                            <label for="lama_beroperasi" class="font-weight-bold text-dark">Beroperasi Sejak</label>
                            <input type="date" step="1" class="form-control" id="lama_beroperasi"
                                   placeholder="" name="lama_beroperasi">
                        </div>
                    </div>
                    <div class="row card-header">
                        <div class="col">
                            <label for="">Foto Pelabuhan</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row card-header">
                        <div class="col">
                            <label for="lokasi_pelabuhan" class="font-weight-bold text-dark">Alamat Pelabuhan</label>
                            <input type="text" class="form-control" id="lokasi_pelabuhan"
                                   placeholder="Masukan Alamat Pelabuhan" name="lokasi_pelabuhan">
                        </div>
                        <div class="col">
                            <label for="alamat_kantor" class="font-weight-bold text-dark">Alamat Kantor</label>
                            <input type="text" class="form-control" id="alamat_kantor"
                                   placeholder="Masukan Alamat Kantor" name="alamat_kantor">
                        </div>
                    </div>
                    <div class="form-group card-header">
                        <label for="status" class="font-weight-bold text-dark">Status</label>
                        <br><input type="radio" name="status" value="Beroperasi"> Beroperasi &nbsp &nbsp
                        <input type="radio" name="status" value="Tidak Beroperasi"> Tidak Beroperasi &nbsp &nbsp
                    </div>

                    <div class="form-group card-header">
                        <label for="tipe_pelabuhan" class="font-weight-bold text-dark">Tipe Pelabuhan</label>
                        <br><input type="radio" name="tipe_pelabuhan" value="feri"> Ferry &nbsp &nbsp
                        <input type="radio" name="tipe_pelabuhan" value="speedboat"> Speedboat &nbsp &nbsp
                        <input type="radio" name="tipe_pelabuhan" value="speedboat & feri"> Speedboat dan Ferry &nbsp
                        &nbsp
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

<!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset ('Lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset ('Lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ('Lte//dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset ('Lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset ('dist/js/demo.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
</body>
</html>
