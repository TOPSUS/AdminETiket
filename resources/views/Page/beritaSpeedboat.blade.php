<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | Berita Speedboat</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset ('Lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset ('Lte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
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
                        <h1>Berita Speedboat</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('create-beritaSpeedboat') }}"><i
                                        class="fas fa-plus"></i> Tambah Data
                                </a>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="card">


                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        @endif
                        <!-- Speeboat-->
                            <div class="tab-pane" id="speedboat">
                                <!-- Post -->
                                @foreach($dataBeritaSpeedboat as $berita)


                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                 src="{{ asset ('Lte/dist/img/avatar3.png') }}" alt="User Image">
                                            <span class="username"><a href="#">{{$berita->relasiUser->nama}}</a>

                          <a class="float-right btn-tool" data-toggle="modal" data-target="#delete{{$berita->id}}"><i
                                  class="fas fa-times"></i></a>
                          <a href="BeritaSpeedboat/{{$berita->id}}/update" class="float-right btn-tool"><i
                                  class="fas fa-pen"></i></a>
                        </span>
                                            <span
                                                class="description">{{date('d F Y', strtotime($berita->created_at)) }}</span>
                                            <span
                                                class="description">{{$berita->relasiSpeedboat->nama_kapal}}</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <h3 style="text-align:center;"><strong>{{$berita->judul}}</strong></h3>
                                        <br>

                                    {!! $berita->berita !!}

                                    <!-- /.row -->
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete{{$berita->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i
                                                                class="fa fa-edit"></i> Delete</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/Dashboard/BeritaSpeedboat/{{$berita->id}}/delete"
                                                          method="POST">
                                                        <div class="modal-body">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            Apakah anda yakin menghapus berita?</b>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal"><i class="fa fa-times"></i>
                                                                Tidak
                                                            </button>
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fa fa-trash"></i> Ya
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Delete -->
                                    </div>
                            @endforeach
                            <!-- /.post -->

                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
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
<script src="{{ asset ('Lte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>
</body>
</html>
