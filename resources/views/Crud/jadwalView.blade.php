<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard | Jadwal</title>
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
                            <li class="breadcrumb-item active"><a href="{{ route('create-detailjadwal-sa') }}"><i
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
                            <th>Hari</th>
                            <th>Asal</th>
                            <th>Waktu Berangkat</th>
                            <th>Tujuan</th>
                            <th>Estimasi Waktu</th>
                            <th>Kapal</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($detailJadwal as $j => $jadwal)
                            <tr>
                                <td>{{$j+1}}</td>
                                <td>{{$jadwal->hari}}</td>
                                <td>{{$jadwal->relasiJadwal->asal->nama_pelabuhan}}</td>
                                <td>{{$jadwal->relasiJadwal->waktu_berangkat}}</td>
                                <td>{{$jadwal->relasiJadwal->tujuan->nama_pelabuhan}}</td>
                                <td>{{$jadwal->relasiJadwal->estimasi_waktu}}</td>
                                <td>{{$jadwal->relasiJadwal->kapal->nama_kapal}}</td>
                                <td><!-- Default switch -->
                                    @if($jadwal->status=="aktif")
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                   onclick="statusJadwal({{$jadwal->id}})"
                                                   id="customSwitch_{{$jadwal->id}}" checked>
                                            <label class="custom-control-label" id="label_{{$jadwal->id}}"
                                                   for="customSwitch_{{$jadwal->id}}">Aktif</label>

                                        </div>
                                    @else
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                   onclick="statusJadwal({{$jadwal->id}})"
                                                   id="customSwitch_{{$jadwal->id}}">
                                            <label class="custom-control-label" id="label_{{$jadwal->id}}"
                                                   for="customSwitch_{{$jadwal->id}}">Tidak Aktif</label>

                                        </div>
                                    @endif
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
                    document.getElementById("label_" + id).innerHTML = 'Aktif';
                },
                error: function (result) {
                    document.getElementById("customSwitch_" + id).checked = false;
                    document.getElementById("label_" + id).innerHTML = 'Tidak Aktif';
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
                    document.getElementById("label_" + id).innerHTML = 'Tidak Aktif';
                },
                error: function (result) {
                    document.getElementById("customSwitch_" + id).checked = true;
                    document.getElementById("label_" + id).innerHTML = 'Aktif';
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
