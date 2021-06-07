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
                        <h1>Data Speedboat</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="/Dashboard/CRUD/DirekturData/Speedboat/Create/{{$user_id}}"><i
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
        @foreach($dataKapal as $hak)
            @if($hak->tipe_kapal=='speedboat')
                <!-- Default box -->
                    <div class="card card-solid">
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                <ul style="list-style-type:none">
                                    <li><strong>{!! \Session::get('error') !!}</strong></li>
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="col-12">
                                        <img src="{{asset('/storage/kapal_image/'.$hak->foto)}}" class="product-image"
                                             alt="Product Image">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h3 class="my-3">{{$hak->nama_kapal}}</h3>
                                    <p>{{$hak->deskripsi}}</p>
                                    <h4 class="mt-3"><small>Max Capacity</small> {{$hak->kapasitas}} </h4>
                                    <div class="bg-gray py-2 px-3 mt-4">
                                        <h2 class="mb-0">
                                            {{$hak->contact_service}}
                                        </h2>
                                        <h4 class="mt-0">
                                            <small>Contact Service </small>
                                        </h4>
                                    </div>
                                    <br>
                                    <div class="">
                                        <div class="text-right">
                                            <a href="/Dashboard/CRUD/DeleteSpeedboat/{{$hak->id}}"
                                               class="btn btn-sm bg-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <a data-toggle="modal" data-target="#update{{$hak->id}}" href="#"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit Speedboat
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
                                         aria-labelledby="product-desc-tab"> {{$hak->deskripsi}}</div>
                                    <div class="tab-pane fade" id="product-rating" role="tabpanel"
                                         aria-labelledby="product-rating-tab"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                @endif
            @endforeach
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@include('adminDashboard.footer')
<!-- Modal Update -->
@foreach($dataKapal as $oldSpeedboat)
        <div class="modal fade" id="update{{$oldSpeedboat->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-speedboat') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="id_kapal" value="{{$oldSpeedboat->id}}">
                            <div class="form-group">
                                <label for="nama_speedboat" class="font-weight-bold text-dark">Nama SpeedBoat</label>
                                <input type="text" class="form-control" id="nama_speedboat"
                                       placeholder="Masukan Nama Speed Boat" name="nama_speedboat"
                                       value="{{$oldSpeedboat->nama_kapal}}" require>
                            </div>
                            <div class="form-group">
                                <label for="kapasitas" class="font-weight-bold text-dark">Kapasitas</label>
                                <input type="number" class="form-control" id="kapasitas"
                                       placeholder="Masukan Jumlah Kapasitas" name="kapasitas" min="0"
                                       value="{{$oldSpeedboat->kapasitas}}" require>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_beroperasi" class="font-weight-bold text-dark">Tanggal Beroperasi</label>
                                <input type="date" class="form-control" id="tanggal_beroperasi"
                                       placeholder="Masukan Kontak Service" name="tanggal_beroperasi"
                                       value="{{date('Y-m-d', strtotime($oldSpeedboat->tanggal_beroperasi))}}" require>
                            </div>
                            <div class="form-group">
                                <label for="contact_service" class="font-weight-bold text-dark">Kontak Service</label>
                                <input type="text" class="form-control" id="contact_service"
                                       placeholder="Masukan Kontak Service" name="contact_service"
                                       value="{{$oldSpeedboat->contact_service}}" require>
                            </div>
                            <div class="form-group">
                                <label for="contact_service" class="font-weight-bold text-dark">Kontak Service</label>
                                <br>@if($oldSpeedboat->tipe_kapal=='feri')
                                    <input type="radio" name="tipe_kapal" value="feri" checked> Ferry &nbsp &nbsp
                                    <input type="radio" name="tipe_kapal" value="speedboat"> Speedboat &nbsp &nbsp
                                @elseif($oldSpeedboat->tipe_kapal=='speedboat')
                                    <input type="radio" name="tipe_kapal" value="feri"> Ferry &nbsp &nbsp
                                    <input type="radio" name="tipe_kapal" value="speedboat" checked> Speedboat &nbsp
                                    &nbsp
                                @else
                                    <input type="radio" name="tipe_kapal" value="feri"> Ferry &nbsp &nbsp
                                    <input type="radio" name="tipe_kapal" value="speedboat"> Speedboat &nbsp &nbsp
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="font-weight-bold text-dark">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10"
                                          placeholder="Deskripsi" value=""
                                          require> {{$oldSpeedboat->deskripsi}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Foto Speedboat</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="file">
                                    </div>
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
@endforeach
<!-- End Modal Update -->




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
