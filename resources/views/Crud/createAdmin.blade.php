<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | Create User</title>
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
    <!-- SweetAlert2 -->
    <script src="{{ asset ('Lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
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
                        <h1>Data Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('create-admin') }}"><i
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
                    <form method="POST" enctype="multipart/form-data" action="{{route('add-admin')}}">
                        @csrf
                        <div class="row card-header">
                            <div class="col">
                                <label for="nama" class="font-weight-bold text-dark">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                       placeholder="Masukan Nama" name="nama"
                                       require>
                                @error('nama')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="email" class="font-weight-bold text-dark">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                       placeholder="Masukan E-mail"
                                       name="email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row card-header">
                            <div class="col">
                                <label for="nohp" class="font-weight-bold text-dark">No Hp</label>
                                <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp"
                                       placeholder="Masukan No Telp"
                                       name="nohp">
                                @error('nohp')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col @error('jeniskelamin') is-invalid @enderror">
                                <label for="jeniskelamin" class="font-weight-bold text-dark">Jenis Kelamin</label><br>
                                <input class="custom-radio" type="radio" name="jeniskelamin" value="Laki-laki">
                                Laki-laki
                                <span class="fas fa-mars"></span>&nbsp &nbsp
                                <input class="custom-radio" type="radio" name="jeniskelamin" value="Perempuan">
                                Perempuan
                                <span class="fas fa-venus"></span>
                                @error('jeniskelamin')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group card-header ">
                            <label for="alamat" class="font-weight-bold text-dark">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                   placeholder="Masukan Alamat"
                                   name="alamat">
                            @error('alamat')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group card-header ">
                            <label for="password" class="font-weight-bold text-dark">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" placeholder="Masukan Password"
                                   name="password">
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group card-header">
                            <label for="speedboat" class="font-weight-bold text-dark">Kapal</label>
                            <select name="id_speedboat" id="id_speedboat"
                                    class="custom-select @error('id_speedboat') is-invalid @enderror" required>
                                <option value="">- Pilih Kapal -</option>
                                @foreach($dataSpeedboat as $speedboat)
                                    <option value="{{$speedboat->id}}">{{$speedboat->nama_kapal}}</option>
                                @endforeach
                            </select>
                            @error('id_speedboat')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group card-header">
                            <button type="submit" class="btn btn-success toastrDefaultSuccess"><i
                                    class="fas fa-plus"></i> Add Data
                            </button>
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

<!-- Alert -->
<script type="text/javascript">
    $(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    .
        $('.toastrDefaultSuccess').click(function () {
            toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
        $('.toastrDefaultInfo').click(function () {
            toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
        $('.toastrDefaultError').click(function () {
            toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
        $('.toastrDefaultWarning').click(function () {
            toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
    });
    <
    /body>
    < /html>
