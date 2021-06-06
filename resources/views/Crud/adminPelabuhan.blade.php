<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard | Pelabuhan Page</title>
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
                        <h1>Data Pelabuhan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="/Dashboard/CRUD/AdminPelabuhanData/Pelabuhan/Create/{{$user_id}}"><i
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
        @foreach($dataPelabuhan as $pelabuhan)
                <!-- Default box -->
                    <div class="card card-solid">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                <ul style="list-style-type:none">
                                    <li><strong>{!! \Session::get('error') !!}</strong></li>
                                </ul>
                            </div>
                        @endif
                        <div class="card-solid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 col-sm-3">
                                        <div class="col-12">
                                        <img src="{{asset('/storage/kapal_image/'.$pelabuhan->foto)}}" class="product-image"
                                             alt="Product Image">
                                    </div>
                                </div>
                                <div class="col-9 col-sm-9">
                                    <h3 class="my-3">Pelabuhan {{$pelabuhan->nama_pelabuhan}} ({{$pelabuhan->status}})</h3>
                                    <p>{{$pelabuhan->deskripsi}}</p>
                                    <br>
                                    <div class="">
                                        <div class="text-right">
                                            <a href="/Dashboard/CRUD/DeletePelabuhan/{{$pelabuhan->id}}"
                                            class="btn btn-sm bg-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <a data-toggle="modal" data-target="#update{{$pelabuhan->id}}" href="#"
                                            class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit Pelabuhan
                                            </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
              
            @endforeach
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
