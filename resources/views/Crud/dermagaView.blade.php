<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard | Dermaga</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

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
                        <h1>Data Jadwal</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('create-dermaga') }}"><i
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
                            <th>No.</th>
                            <th>Nama Pelabuhan</th>
                            <th>Dermaga</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($dataDermaga as $j => $dermaga)
                            <tr>
                                <td>{{$j+1}}</td>
                                <td>{{$dermaga->relasiPelabuhan->nama_pelabuhan}}</td>
                                <td>{{$dermaga->nama_dermaga}}</td>
                               
                                <td>
                                    <a class="btn btn-sm bg-danger"
                                       href="/Dashboard/CRUD/DeleteDermaga/{{$dermaga->id}}"> <i
                                            class="fas fa-trash-alt"></i></a>
                                    <a data-toggle="modal" data-target="#update{{$dermaga->id}}"
                                       class="btn btn-sm btn-primary" href="#"><i class="fas fa-edit"></i> Edit Dermaga
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
@include('adminDashboard.footer')
<!-- Modal Update -->
@foreach($dataDermaga as $dermaga)
    <div class="modal fade" id="update{{$dermaga->id}}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Dermaga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update-dermaga') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_dermaga" value="{{$dermaga->id}}">
                        <div class="form-group">
                            <label for="id_pelabuhan" class="font-weight-bold text-dark">Pelabuhan</label>
                            <select name="id_pelabuhan" class="custom-select" required>
                                <option
                                    value="{{$dermaga->id_pelabuhan}}">{{$dermaga->relasiPelabuhan->nama_pelabuhan}}</option>
                                @foreach($pelabuhan as $pb)
                                    <option value="{{$pb->id}}">{{$pb->nama_pelabuhan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_dermaga" class="font-weight-bold text-dark">Nama Dermaga</label>
                            <input type="text" step="1" class="form-control" id="nama_dermaga"
                                   placeholder="Masukan Nama Dermaga" name="nama_dermaga" value="{{$dermaga->nama_dermaga}}"
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

    function statusJadwal(id) {
        var checkBox = document.getElementById("customSwitch_" + id);
        if (checkBox.checked == true) {
            $.ajax({
                url: "/ajax/jadwal/turnOn",
                type: "POST",
                data: {
                    id: id,
                },
                success: function (result) {
                    document.getElementById("customSwitch_" + id).checked = true;
                    document.getElementById("label_"+id).innerHTML = 'Aktif';
                },
                error: function (result) {
                    document.getElementById("customSwitch_" + id).checked = false;
                    document.getElementById("label_"+id).innerHTML = 'Tidak Aktif';
                }
            });
        } else {
            $.ajax({
                url: "/ajax/jadwal/turnOff",
                type: "POST",
                data: {
                    id: id,
                },
                success: function (result) {
                    document.getElementById("customSwitch_" + id).checked = false;
                    document.getElementById("label_"+id).innerHTML = 'Tidak Aktif';
                },
                error: function (result) {
                    document.getElementById("customSwitch_" + id).checked = true;
                    document.getElementById("label_"+id).innerHTML = 'Aktif';
                }
            });
        }
    }

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
