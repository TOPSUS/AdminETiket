<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard | Golongan</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset ('Lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset ('Lte/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset ('Lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('Lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
                        <h1>Data Golongan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('golongan-create-pa')}}"><i
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
            <hr style="margin-top: 20px" class="sidebar-divider my-0">
            <!-- DataTales Example -->
            <!-- Copy drisini -->
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No. </th>
                            <th>Pelabuhan</th>
                            <th>Golongan</th>
                            <th>Keterangan</th>
                            <th>Maksimum Penumpang</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($dataGolongan as $index => $golongan)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$golongan->pelabuhan->nama_pelabuhan}}</td>
                                <td>{{$golongan->golongan}}</td>
                                <td>{{$golongan->keterangan}}</td>
                                <td>{{$golongan->max_penumpang}}</td>
                                <td>{{$golongan->harga}}</td>
                                <td>
                                    <a class="btn btn-sm bg-danger"
                                       href="/AdminPelabuhan/Golongan/Delete/{{$golongan->id}}"> <i
                                            class="fas fa-trash-alt"></i></a>
                                    <a data-toggle="modal" data-target="#update{{$golongan->id}}"
                                       class="btn btn-sm btn-primary" href="#"><i class="fas fa-edit"></i> Edit Golongan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

    </div>
    <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('adminPelabuhan.footer')

<!-- Modal Update -->
@foreach($dataGolongan as $oldGolongan)
    <div class="modal fade" id="update{{$oldGolongan->id}}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Gologan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('golongan-update-pa') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_golongan" value="{{$oldGolongan->id}}">
                        <div class="form-group">
                            <label for="id_pelabuhan" class="font-weight-bold text-dark">Pelabuhan</label>
                            <select name="id_pelabuhan" class="custom-select" required disabled>
                                <option
                                    value="{{$oldGolongan->id_pelabuhan}}">{{$oldGolongan->pelabuhan->nama_pelabuhan}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="golongan" class="font-weight-bold text-dark">Golongan</label>
                            <input type="text" step="1" class="form-control" id="golongan"
                                   placeholder="Masukan Golongan" name="golongan" value="{{$oldGolongan->golongan}}"
                                   require>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="font-weight-bold text-dark">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="10"
                                      placeholder="Deskripsi" require> {{$oldGolongan->keterangan}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="harga" class="font-weight-bold text-dark">Harga</label>
                            <input type="text" step="1" class="form-control" id="harga" placeholder="Masukan Harga"
                                   name="harga" value="{{$oldGolongan->harga}}" require>
                        </div>
                        <div class="form-group">
                            <label for="max_penumpang" class="font-weight-bold text-dark">Maksimum Penumpang</label>
                            <input type="text" step="1" min="0" max="10" class="form-control" id="max_penumpang" placeholder="Masukan Maksimum Penumpang"
                                   name="max_penumpang" value="{{$oldGolongan->max_penumpang}}" require>
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
<!-- DataTables -->
<script src="{{ asset ('Lte//plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('Lte//plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset ('Lte//plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset ('Lte//plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>
</html>
