<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | Tambah Kapal</title>
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
                        <h1>Data Kapal</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="card shadow mb-4">
            <div class="card shadow">
                <form method="POST" enctype="multipart/form-data" action="{{route('createKapal')}}">
                    @csrf
                    <div class="row card-header">
                        <div class="col">
                            <label for="nama_kapal" class="font-weight-bold text-dark">Nama Kapal</label>
                            <input type="text" class="form-control" id="nama_kapal @error('nama_kapal') is-invalid @enderror" placeholder="Masukan Nama Kapal"
                                   name="nama_kapal">
                            @error('nama_kapal')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row card-header">
                        <div class="col">
                            <label for="tipe_kapal" class="font-weight-bold text-dark">Tipe Kapal</label>
                            <select name="tipe_kapal" id="tipe_kapal" class="custom-select @error('tipe_kapal') is-invalid @enderror" required>
                                <option value=''>Pilih Tipe Kapal</option>
                                <option value='feri'>Feri</option>
                                <option value='speedboat'>Speedboat</option>
                            </select>
                            @error('tipe_kapal')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="kapasitas" class="font-weight-bold text-dark">Kapasitas</label>
                            <input type="number" class="form-control @error('kapasitas') is-invalid @enderror" id="kapasitas"
                                   placeholder="Masukan Jumlah Kapasitas" name="kapasitas" min="0">
                            @error('kapasitas')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="reward_point" class="font-weight-bold text-dark">Reward Point</label>
                            <input type="number" class="form-control @error('reward_point') is-invalid @enderror" id="reward_point"
                                   placeholder="Jumlah reward point per transaksi" name="reward_point" min="0">
                            @error('reward_point')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row card-header">
                        <div class="col">
                            <label for="exampleInputFile">Foto Speedboat</label>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="form-control @error('file') is-invalid @enderror" name="file">
                                    @error('file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <label>Tanggal Beroperasi</label>
                            <div class="form-group" >
                                <input type="date" step="1" class="form-control @error('tanggal_beroperasi') is-invalid @enderror" id="tanggal_beroperasi"
                                       placeholder="Masukan Asal Speedboat" name="tanggal_beroperasi">
                                @error('tanggal_beroperasi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group card-header ">
                        <label for="contact_service" class="font-weight-bold text-dark">Kontak Service</label>
                        <input type="text" class="form-control @error('contact_service') is-invalid @enderror" id="contact_service"
                               placeholder="Masukan Kontak Service" name="contact_service">
                        @error('contact_service')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group card-header ">
                        <label for="deskripsi" class="font-weight-bold text-dark">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" rows="10"
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

@include('direkturKapal.footer')
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
