<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | Create Speedboat</title>
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
                        <h1>Data Speedboat Direktur</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="/Dashboard/CRUD/DirekturData/Speedboat/Create/{{$id1}}"><i
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
                    <form method="POST" enctype="multipart/form-data" action="{{route('direktur-addspeedboat')}}">
                        @csrf
                        <input type="hidden" value="{{$id1}}" name="id_direktur">
                        <div class="row card-header">
                            <div class="col">
                                <label for="nama_kapal" class="font-weight-bold text-dark">Nama SpeedBoat</label>
                                <input type="text" class="form-control @error('nama_kapal') is-invalid @enderror"
                                       id="nama_kapal"
                                       placeholder="Masukan Nama Speed Boat" name="nama_kapal">
                                @error('nama_kapal')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="kapasitas" class="font-weight-bold text-dark">Kapasitas</label>
                                <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                                       id="kapasitas"
                                       placeholder="Masukan Jumlah Kapasitas" name="kapasitas" min="0">
                                @error('kapasitas')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row card-header">
                            <div class="col">
                                <label for="exampleInputFile">Foto Speedboat</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror"
                                               id="exampleInputFile" name="file">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        @error('file')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_beroperasi">Tanggal Beroperasi</label>
                                    <input type="date" step="1"
                                           class="form-control @error('tanggal_beroperasi') is-invalid @enderror"
                                           id="tanggal_beroperasi"
                                           placeholder="Tanggal Beroperasi" name="tanggal_beroperasi">
                                    @error('tanggal_beroperasi')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group card-header ">
                            <label for="contact_service" class="font-weight-bold text-dark">Kontak Service</label>
                            <input type="text" class="form-control @error('contact_service') is-invalid @enderror"
                                   id="contact_service"
                                   placeholder="Masukan Kontak Service" name="contact_service">
                            @error('contact_service')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group card-header ">
                            <label for="alamat" class="font-weight-bold text-dark">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                      id="deskripsi" rows="10"
                                      placeholder="Deskripsi"></textarea>
                            @error('deskripsi')
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
