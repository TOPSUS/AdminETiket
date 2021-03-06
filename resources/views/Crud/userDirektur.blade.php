<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | User Speedboat</title>
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
                        <h1>Data Head Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('create-direktur') }}"><i
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

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row d-flex align-items-stretch">
                        @foreach($dataDirektur as $direktur)
                            <div class="col-4 col-sm-4 col-md-4 align-items-stretch">
                                <div class="card bg-light">
                                    <div class="card-header text-muted border-bottom-0">
                                        Head Admin
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{$direktur->nama}}</b></h2>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-building"></i></span>
                                                        Address: {{$direktur->alamat}}</li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span> Phone
                                                        : {{$direktur->nohp}}</li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-envelope"></i></span> Email
                                                        : {{$direktur->email}}</li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-venus-mars"></i></span> Gender
                                                        : {{$direktur->jeniskelamin}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{asset('/storage/image_users/'.$direktur->foto)}}" alt=""
                                                     class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="/Dashboard/CRUD/DeleteUser/{{$direktur->id}}"
                                               class="btn btn-sm bg-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <a data-toggle="modal" data-target="#update{{$direktur->id}}" href="#"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Edit Profile
                                            </a>
                                            <a href="/Dashboard/CRUD/DirekturData/Speedboat/View/{{$direktur->id}}"
                                               class="btn btn-sm btn-success">
                                                <i class="fas fa-eye"></i> Speedboat
                                            </a>
                                            <a href="/Dashboard/CRUD/DirekturData/Kapal/View/{{$direktur->id}}"
                                               class="btn btn-sm btn-success">
                                                <i class="fas fa-eye"></i> Kapal
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
               
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@include('adminDashboard.footer')

<!-- Modal Update -->
    @foreach($dataDirektur as $oldDirektur)
        <div class="modal fade" id="update{{$oldDirektur->id}}" tabindex="-1" role="dialog"
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
                        <form action="{{ route('update-user') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="id_user" value="{{$oldDirektur->id}}">
                            <div class="form-group">
                                <label for="nama" class="font-weight-bold text-dark">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Masukan Nama" name="nama"
                                       value="{{$oldDirektur->nama}}" require>
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bold text-dark">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukan E-mail"
                                       name="email" value="{{$oldDirektur->email}}" require>
                            </div>
                            <div class="form-group">
                                <label for="nohp" class="font-weight-bold text-dark">No Hp</label>
                                <input type="text" class="form-control" id="nohp" placeholder="Masukan No Telp"
                                       name="nohp" value="{{$oldDirektur->nohp}}" require>
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bold text-dark">Jenis Kelamin</label><br>
                                @if($oldDirektur->jeniskelamin == 'Laki-laki')
                                    <input class="custom-radio" type="radio" name="jeniskelamin" value="Laki-laki"
                                           checked> Laki-laki
                                    <span class="fas fa-mars"></span>&nbsp &nbsp
                                    <input class="custom-radio" type="radio" name="jeniskelamin" value="Perempuan">
                                    Perempuan
                                    <span class="fas fa-venus"></span>
                                @else
                                    <input class="custom-radio" type="radio" name="jeniskelamin" value="Laki-laki">
                                    Laki-laki
                                    <span class="fas fa-mars"></span>&nbsp &nbsp
                                    <input class="custom-radio" type="radio" name="jeniskelamin" value="Perempuan"
                                           checked> Perempuan
                                    <span class="fas fa-venus"></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="font-weight-bold text-dark">Alamat</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Masukan Alamat"
                                       name="alamat" value="{{$oldDirektur->alamat}}" require>
                            </div>
                            <div class="form-group">
                                <label for="InputName" class="font-weight-bold text-dark">Role/Jabatan</label>
                                <br>@if($oldDirektur->role == "Customer")
                                    <input type="radio" name="role" value="Customer" checked> Customer &nbsp &nbsp
                                    <input type="radio" name="role" value="Direktur"> Direktur &nbsp &nbsp
                                    <input type="radio" name="role" value="Admin"> Admin &nbsp &nbsp
                                    <input type="radio" name="role" value="SAdmin"> Super Admin
                                @elseif($oldDirektur->role == "Direktur")
                                    <input type="radio" name="role" value="Customer"> Customer &nbsp &nbsp
                                    <input type="radio" name="role" value="Direktur" checked> Direktur &nbsp &nbsp
                                    <input type="radio" name="role" value="Admin"> Admin &nbsp &nbsp
                                    <input type="radio" name="role" value="SAdmin"> Super Admin
                                @elseif($oldDirektur->role == "Admin")
                                    <input type="radio" name="role" value="Customer"> Customer &nbsp &nbsp
                                    <input type="radio" name="role" value="Direktur"> Direktur &nbsp &nbsp
                                    <input type="radio" name="role" value="Admin" checked> Admin &nbsp &nbsp
                                    <input type="radio" name="role" value="SAdmin"> Super Admin
                                @else
                                    <input type="radio" name="role" value="Customer"> Customer &nbsp &nbsp
                                    <input type="radio" name="role" value="Direktur"> Direktur &nbsp &nbsp
                                    <input type="radio" name="role" value="Admin"> Admin &nbsp &nbsp
                                    <input type="radio" name="role" value="SAdmin" checked> Super Admin
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
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
    <script src="{{ asset ('Lte//dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>
</html>
