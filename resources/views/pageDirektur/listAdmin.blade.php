<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard | List Admin</title>
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
                        <h1>List Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a data-toggle="modal" data-target="#create" class="btn btn-success text-white"><i
                                        class="fas fa-plus"></i> Tambah Jadwal</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <hr style="margin-top: 20px" class="sidebar-divider my-0">
            <!-- DataTales Example -->
            <!-- Copy drisini -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Handphone</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($user as $userAdmin)
                                <tr>
                                    <td>{{$userAdmin->nama}}</td>
                                    <td>{{$userAdmin->email}}</td>
                                    <td>{{$userAdmin->nohp}}</td>
                                    <td>
                                        <a data-toggle="modal" class="btn btn-sm bg-danger"
                                           data-target="#delete{{$userAdmin->id}}"> <i class="fas fa-trash-alt"></i></a>
                                        <a data-toggle="modal" data-target="#update{{$userAdmin->id}}"
                                           class="btn btn-sm btn-primary" href="#"><i class="fas fa-edit"></i> Edit
                                            Admin
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- smpe sini -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@include('direkturKapal.footer')

<!-- Modal Create -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Admin </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('createAdmin') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_kapal" value="{{$IdKapal}}">
                        <div class="form-group">
                            <label for="nama" class="font-weight-bold text-dark">Nama Admin</label>
                            <input type="text" step="1" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukan Nama"
                                   name="nama" require>
                            @error('nama')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="font-weight-bold text-dark">E-mail</label>
                            <input type="text" step="1" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                   placeholder="Masukan Email" require>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="font-weight-bold text-dark">Password</label>
                            <input type="password" step="1" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                   placeholder="Masukan Password" require>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="font-weight-bold text-dark">No. Handphone</label>
                            <input type="text" step="1" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                   placeholder="Masukan No. Handphone" name="no_hp" require>
                            @error('no_hp')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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

    <!-- Modal Update -->
    @foreach($user as $userAdmin)
        <div class="modal fade" id="update{{$userAdmin->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Admin </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateAdmin') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_kapal" value="{{$IdKapal}}">
                            <input type="hidden" name="id_user" value="{{$userAdmin->id}}">
                            <div class="form-group">
                                <label for="nama" class="font-weight-bold text-dark">Nama Admin</label>
                                <input type="text" step="1" class="form-control" id="nama" placeholder="Masukan Nama"
                                       name="nama" value="{{$userAdmin->nama}}" require>
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bold text-dark">E-mail</label>
                                <input type="text" step="1" class="form-control" id="email" name="email"
                                       placeholder="Masukan Email" value="{{$userAdmin->email}}" require>
                            </div>
                            <div class="form-group">
                                <label for="password" class="font-weight-bold text-dark">Password</label>
                                <input type="password" step="1" class="form-control" id="password" name="password"
                                       placeholder="Masukan Password" require>
                            </div>
                            <div class="form-group">
                                <label for="no_hp" class="font-weight-bold text-dark">No. Handphone</label>
                                <input type="text" step="1" class="form-control" id="no_hp"
                                       placeholder="Masukan No. Handphone" name="no_hp" value="{{$userAdmin->nohp}}"
                                       require>
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
        <div class="modal fade" id="delete{{$userAdmin->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/Direktur/Kapal/{{$userAdmin->id}}/deleteAdmin" method="POST">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            Apakah anda yakin menghapus admin?</b>
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
        <!-- End Modal Delete -->

@endforeach



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
