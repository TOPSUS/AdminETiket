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
@include('adminPelabuhan.header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('adminPelabuhan.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Pelabuhan </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="{{route('pelabuhan-view')}}"><i
                                        class="fas fa-plus"></i> Tambah Data
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card shadow mb-4">
                <div class="card shadow">
                    <form method="POST" enctype="multipart/form-data" action="{{route('pelabuhan-add')}}">
                        @csrf
                        <div class="row card-header">
                        <div class="col">
                            <label for="kode_pelabuhan" class="font-weight-bold text-dark">Kode Pelabuhan</label>
                            <input type="text" class="form-control @error('kode_pelabuhan') is-invalid @enderror" id="kode_pelabuhan"
                                   placeholder="Masukan Kode Pelabuhan" name="kode_pelabuhan">
                            @error('kode_pelabuhan')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="nama_pelabuhan" class="font-weight-bold text-dark">Nama Pelabuhan</label>
                            <input type="text" class="form-control @error('nama_pelabuhan') is-invalid @enderror" id="nama_pelabuhan"
                                   placeholder="Masukan Nama Pelabuhan" name="nama_pelabuhan">
                            @error('nama_pelabuhan')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="lama_beroperasi" class="font-weight-bold text-dark">Beroperasi Sejak</label>
                            <input type="date" step="1" class="form-control @error('lama_beroperasi') is-invalid @enderror" id="lama_beroperasi"
                                   placeholder="" name="lama_beroperasi">
                            @error('lama_beroperasi')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row card-header">
                        <div class="col">
                            <label for="">Foto Pelabuhan</label>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="form-group @error('file') is-invalid @enderror" name="file">
                                    @error('file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row card-header">
                        <div class="col">
                            <label for="lokasi_pelabuhan" class="font-weight-bold text-dark">Alamat Pelabuhan</label>
                            <input type="text" class="form-control @error('lokasi_pelabuhan') is-invalid @enderror" id="lokasi_pelabuhan"
                                   placeholder="Masukan Alamat Pelabuhan" name="lokasi_pelabuhan">
                            @error('lokasi_pelabuhan')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="alamat_kantor" class="font-weight-bold text-dark">Alamat Kantor</label>
                            <input type="text" class="form-control @error('alamat_kantor') is-invalid @enderror" id="alamat_kantor"
                                   placeholder="Masukan Alamat Kantor" name="alamat_kantor">
                            @error('alamat_kantor')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group card-header @error('status') is-invalid @enderror">
                        <label for="status" class="font-weight-bold text-dark">Status</label>
                        <br><input type="radio" name="status" value="Beroperasi"> Beroperasi &nbsp &nbsp
                        <input type="radio" name="status" value="Tidak Beroperasi"> Tidak Beroperasi &nbsp &nbsp
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group card-header @error('tipe_pelabuhan') is-invalid @enderror">
                        <label for="tipe_pelabuhan" class="font-weight-bold text-dark">Tipe Pelabuhan</label>
                        <br><input type="radio" name="tipe_pelabuhan" value="feri"> Ferry &nbsp &nbsp
                        <input type="radio" name="tipe_pelabuhan" value="speedboat"> Speedboat &nbsp &nbsp
                        <input type="radio" name="tipe_pelabuhan" value="speedboat & feri"> Speedboat dan Ferry &nbsp
                        &nbsp
                        @error('tipe_pelabuhan')
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

@include('adminPelabuhan.footer')
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
