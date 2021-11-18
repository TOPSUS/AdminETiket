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
                        <h1>Add Data Jadwal</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('adminPelabuhanHome') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('create-detailjadwal') }}"><i
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
                    <form method="POST" enctype="multipart/form-data" action="{{route('add-jadwal-detail')}}">
                        @csrf
                        <div class="row card-header">
                            <div class="col-sm-12 col-md-12 col-xl-12">
                                <label for="id_jadwal" class="font-weight-bold text-dark">Jadwal</label>
                                <select name="id_jadwal" id="id_jadwal" class="custom-select @error('id_jadwal') is-invalid @enderror"
                                        required>
                                    <option value="">-- Jadwal --</option>
                                    @foreach($dataJadwal as $jadwal)
                                        <option value="{{$jadwal->id}}">
                                            [Waktu : {{$jadwal->waktu_berangkat}}] [KAPAL {{$jadwal->kapal->nama_kapal}}
                                            ]
                                            {{$jadwal->asal->nama_pelabuhan}} ->
                                            Tujuan {{$jadwal->tujuan->nama_pelabuhan}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_jadwal')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row card-header">
                            <div class="col-sm-12 col-md-4 col-xl-4">
                                <label for="dermaga_asal" class="font-weight-bold text-dark">Dermaga Asal</label>
                                <select name="dermaga_asal" id="dermaga_asal" class="custom-select @error('dermaga_asal') is-invalid @enderror"
                                        required>
                                    <option value="">-- Dermaga Asal --</option>
                                </select>
                                @error('dermaga_asal')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4">
                                <label for="dermaga_tujuan" class="font-weight-bold text-dark">Dermaga Tujuan</label>
                                <select name="dermaga_tujuan" id="dermaga_tujuan" class="custom-select @error('dermaga_tujuan') is-invalid @enderror"
                                        required>
                                    <option value="">-- Dermaga Tujuan --</option>
                                </select>
                                @error('dermaga_tujuan')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4">
                                <label for="hari" class="font-weight-bold text-dark">Hari</label>
                                <select name="hari" class="custom-select @error('hari') is-invalid @enderror" required>
                                    <option value="">-- Hari --</option>
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kamis">Kamis</option>
                                    <option value="jumat">Jumat</option>
                                    <option value="sabtu">Sabtu</option>
                                    <option value="minggu">Minggu</option>
                                </select>
                                @error('hari')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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

@include('adminPelabuhan.footer')
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
<script>
    $('#id_jadwal').on('change', function () {
        if ($('#id_jadwal').val() != '') {
            $.ajax({
                url: '/ajax/dermaga/list/asal/' + $('#id_jadwal').val(),
                method: "GET",
                success: function (data) {
                    $('#dermaga_asal').empty();
                    $('#dermaga_asal').append('<option value="">-- Dermaga Asal --</option>');
                    jQuery.each(data, function (index, values) {
                        dermaga_asal = '<option value=' + values.id + '>' + values.nama_dermaga + '</option>';
                        $('#dermaga_asal').append(dermaga_asal);
                    });
                },
                error: function () {
                    $('#dermaga_asal').empty();
                    $('#dermaga_asal').append('<option value="">-- Dermaga Asal --</option>');
                }
            });

            $.ajax({
                url: '/ajax/dermaga/list/tujuan/' + $('#id_jadwal').val(),
                method: "GET",
                success: function (data) {
                    $('#dermaga_tujuan').empty();
                    $('#dermaga_tujuan').append('<option value="">-- Dermaga Tujuan --</option>');
                    jQuery.each(data, function (index, values) {
                        dermaga_asal = '<option value=' + values.id + '>' + values.nama_dermaga + '</option>';
                        $('#dermaga_tujuan').append(dermaga_asal);
                    });
                },
                error: function () {
                    $('#dermaga_tujuan').empty();
                    $('#dermaga_tujuan').append('<option value="">-- Dermaga Tujuan --</option>');
                }
            });
        } else {
            $('#dermaga_tujuan').empty();
            $('#dermaga_tujuan').append('<option value="">-- Dermaga Tujuan --</option>');
        }
    });
</script>
</body>
</html>
