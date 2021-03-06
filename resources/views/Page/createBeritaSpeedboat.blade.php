<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | Create Berita</title>
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
                        <h1>Tambah Berita Speedboat</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="{{ route('berita-speedboat') }}">Berita</a></li>
                            <li class="breadcrumb-item"> Tambah Berita
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
                    <form method="POST" enctype="multipart/form-data" action="{{route('add-beritaSpeedboat')}}">
                        @csrf
                        <div class="form-group card-header">
                            <div class="form-group">
                                <label for="judul" class="font-weight-bold text-dark">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" placeholder="Masukan Judul Berita"
                                       name="judul">
                                @error('judul')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="speedboat" class="font-weight-bold text-dark">Speedboat</label>
                                <select name="id_kapal" id="id_kapal" class="custom-select @error('id_kapal') is-invalid @enderror" required>
                                    <option value="">- Pilih Speedboat -</option>
                                    @foreach($dataSpeedboat as $speedboat)
                                        <option value="{{$speedboat->id}}">{{$speedboat->nama_kapal}}</option>
                                    @endforeach
                                </select>
                                @error('id_kapal')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file" class="font-weight-bold text-dark">Foto</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" placeholder="Masukan Judul Berita"
                                       name="file">
                                @error('file')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="berita" class="font-weight-bold text-dark">Berita</label>
                                <textarea id="berita" class="summernote@error('berita') is-invalid @enderror" name="berita" required></textarea>
                                @error('berita')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group card-header">
                            <a href="/Berita">
                                <button type="button" class="btn btn-secondary">Batal</button>
                            </a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Berita
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

<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function (e) {
        var status;
        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });

        $(function () {
            $(".tanggal").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });

        $('#blog_category-name').selectpicker();
    });
</script>

</body>
</html>
