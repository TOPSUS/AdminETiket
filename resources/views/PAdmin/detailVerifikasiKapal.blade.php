<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard | Detail Verifikasi Kapal</title>
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
                        <h1>Data Kapal</h1>
                    </div>
                   
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
       
            <!-- Default box -->
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <div class="col-12">
                                    <img src="{{asset('/storage/kapal_image/'.$dataVerifikasiKapal->relasiKapal->foto)}}" class="product-image" alt="Product Image">
                                </div>

                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3">{{$dataVerifikasiKapal->relasiKapal->nama_kapal}}</h3>
                                <p>{{$dataVerifikasiKapal->relasiKapal->deskripsi}}</p>

                                <div class="bg-gray py-2 px-3 mt-4">
                                    <h2 class="mb-0">
                                        @if($dataVerifikasiKapal->relasiKapal->tanggal_beroperasi!=null)
                                            {{date('Y F d', strtotime($dataVerifikasiKapal->relasiKapal->tanggal_beroperasi))}}
                                        @endif
                                    </h2>
                                    <h4 class="mt-0">
                                        <small>Tanggal Beroperasi </small>
                                    </h4>
                                </div>
                                <div class="bg-gray py-2 px-3 mt-4">
                                    <h2 class="mb-0">
                                    {{$dataVerifikasiKapal->relasiPelabuhan->nama_pelabuhan}}
                                    </h2>
                                    <h4 class="mt-0">
                                        <small>Pelabuhan </small>
                                    </h4>
                                </div>
                                <br>
                                <div class="">
                                    <div class="text-right">
                                        <a href="Reject/{{$dataVerifikasiKapal->id}}"
                                           class="btn btn-danger pull-right">
                                           Reject
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <a href="Approve/{{$dataVerifikasiKapal->id}}"
                                           class="btn btn-success pull-right">
                                            <i class="fas fa-check"></i> Approve
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-4">
                            <nav class="w-100">
                                <div class="nav nav-tabs" id="product-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab"
                                       href="#product-desc" role="tab" aria-controls="product-desc"
                                       aria-selected="true">Description</a>
                                </div>
                            </nav>
                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                                     aria-labelledby="product-desc-tab"> {{$dataVerifikasiKapal->relasiKapal->deskripsi}}</div>
                                <div class="tab-pane fade" id="product-rating" role="tabpanel"
                                     aria-labelledby="product-rating-tab"></div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
        </section>

        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@include('adminPelabuhan.footer')

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
