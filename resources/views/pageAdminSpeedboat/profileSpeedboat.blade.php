<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard | Speedboat Page</title>
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
@include('adminSpeedboat/header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('adminSpeedboat/sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kapal</h1>
                    </div>
                    <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
              <li class="breadcrumb-item">Profile Kapal</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('createSpeedboats') }}"><i class="fas fa-plus"></i >Tambah Speedboat</a></li>
            </ol> -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            @foreach ($profiles as $i => $profile)
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h3 class="d-inline-block d-sm-none">{{$profile->nama_kapal}}</h3>
                                <div class="col-12">
                                    <img src="{{asset('/storage/kapal_image/'.$profile->foto)}}" class="product-image"
                                         alt="Product Image">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3">{{$profile->nama_kapal}}</h3>
                                <p>{{$profile->deskripsi}}</p>
                                <h4 class="mt-3"><small>Max Capacity</small> {{$profile->kapasitas}} </h4>

                                <div class="bg-gray py-2 px-3 mt-4">
                                    <h2 class="mb-0">
                                        {{$profile->contact_service}}
                                    </h2>
                                    <h4 class="mt-0">
                                        <small>Contact Service </small>
                                    </h4>
                                </div>
                                <br>

                                <div class="">
                                    <div class="text-right">
                                        <a data-toggle="modal" data-target="#update{{$profile->id}}" href="#"
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Edit Kapal
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
                                    <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab"
                                       href="#product-rating" role="tab" aria-controls="product-rating"
                                       aria-selected="false">Rating</a>
                                </div>
                            </nav>
                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                                     aria-labelledby="product-desc-tab"> {{$profile->deskripsi}} </div>
                                <div class="tab-pane fade" id="product-rating" role="tabpanel"
                                     aria-labelledby="product-rating-tab"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
        @endforeach
        <!-- /.card -->
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@include('adminSpeedboat/footer')

@foreach($profiles as $pp)
    <!-- Modal Update -->
        <div class="modal fade" id="update{{$pp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kapal {{$pp->nama_kapal}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateKapalAdmin') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_kapal" value="{{$pp->id}}">
                            <div class="form-group">
                                <label for="nama_kapal" class="font-weight-bold text-dark">Nama Kapal</label>
                                <input type="text" class="form-control" id="nama_kapal" placeholder="Masukan Nama Kapal"
                                       name="nama_kapal" value="{{$pp->nama_kapal}}" require>
                            </div>
                            <div class="form-group">
                                <label for="kapasitas" class="font-weight-bold text-dark">Kapasitas</label>
                                <input type="number" class="form-control" id="kapasitas"
                                       placeholder="Masukan Jumlah Kapasitas" name="kapasitas" min="0"
                                       value="{{$pp->kapasitas}}" require>
                            </div>
                            <div class="form-group">
                                <label for="contact_service" class="font-weight-bold text-dark">Contact Service</label>
                                <input type="text" class="form-control" id="contact_service"
                                       placeholder="Masukan Kontak Service" name="contact_service"
                                       value="{{$pp->contact_service}}" require>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="font-weight-bold text-dark">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10"
                                          placeholder="Deskripsi" value="" require> {{$pp->deskripsi}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Foto Speedboat</label>
                                <div class="input-group">
                                    <input type="file" name="file">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Update -->

        <!-- Modal Delete -->
        <div class="modal fade" id="delete{{$pp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/Direktur/Kapal/{{$pp->id}}/delete" method="POST">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            Apakah anda yakin menghapus Kapal?</b>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-times"></i> Tidak
                            </button>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endforeach
    <!-- End Modal Update -->
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
