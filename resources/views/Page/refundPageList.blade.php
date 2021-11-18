<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Dashboard | Data Pembelian</title>
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
                        <h1>Data Pembelian</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
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
                <div class="col-sm-12 col-md-12 col-xl-12">
                    <div class="row card-header">
                        <div class="col-sm-12 col-md-8 col-xl-8">
                            <div class="form-group row">
                                <label for="persentase">Persentase Refund</label>
                                <div class="col-sm-4 col-md-4 col-xl-4">
                                    <input class="form-control" id="persentase" max="100" min="0" type="number"
                                           value="{{optional($persenan)->persenan_refund}}">
                                </div>
                                <div class="col-sm-1 col-md-1 col-xl-1">
                                    <button onclick="ajaxPersentase()" class="btn btn-success">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <th>Nama Pemohon</th>
                            <th>Super Admin</th>
                            <th>Tanggal</th>
                            <th>Alasan</th>
                            <th>Status</th>
                            <th>Refund</th>
                            <th>Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dataRefund as $index => $rf)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$rf->pembelian->user->nama}}</td>
                                <td>{{optional($rf->user)->nama}}</td>
                                <td>{{date('d F Y', strtotime($rf->tanggal))}}</td>
                                <td>{{$rf->alasan}}</td>
                                <td>{{$rf->status}}</td>
                                <td>{{$rf->refund}}</td>
                                <td><a class="btn btn-sm btn-primary"
                                       href="/Dashboard/CRUD/DetailPembelian/{{$rf->pembelian->id}}"><i
                                            class="fas fa-credit-card"></i></a>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal"
                                            data-target="#lihat{{$rf->id}}"><i
                                            class="fas fa-eye"></i></button>
                                    @if($rf->status=='pending')
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                                data-target="#terima{{$rf->id}}"><i
                                                class="fas fa-check-square"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#tolak{{$rf->id}}"><i
                                                class="fas fa-times"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    @include('adminDashboard/footer')

    @foreach($dataRefund as $refund)
        <div class="modal fade bd-example-modal-lg" id="lihat{{$refund->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Refund&nbsp; - &nbsp;</h5>
                        <h5>
                            <div class="text-success modal-title">{{ucfirst($refund->status)}}</div>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6">
                                <address>
                                    <strong>Atas nama : {{$refund->pembelian->user->nama}}</strong><br>
                                    Nomor Rekening : <strong>{{$refund->no_rekening}}</strong><br>
                                    Phone : {{$refund->pembelian->user->nohp}}<br>
                                    Email: {{$refund->pembelian->user->email}}
                                    <br>
                                </address>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-6">
                                <address>
                                    <b>Jadwal</b><br>
                                    Kapal
                                    : {{$refund->pembelian->jadwal->relasiJadwal->kapal->nama_kapal}} {{ucfirst($refund->pembelian->jadwal->relasiJadwal->kapal->tipe_kapal)}}
                                    <br>
                                    Dari : {{$refund->pembelian->jadwal->relasiJadwal->asal->nama_pelabuhan}}<br>
                                    Menuju : {{$refund->pembelian->jadwal->relasiJadwal->tujuan->nama_pelabuhan}}<br>
                                    Tanggal : {{date('d F Y', strtotime($refund->pembelian->created_at))}}
                                </address>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Alasan</th>
                                        <th>Nomor Rekening</th>
                                        <th>Refund</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$refund->pembelian->user->nama}}</td>
                                        <td>{{date('d F Y', strtotime($refund->tanggal))}}</td>
                                        <td>{{$refund->alasan}}</td>
                                        <td>{{$refund->no_rekening}}</td>
                                        <td>IDR {{number_format($refund->refund)}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if($refund->status == 'pending')
                            <a href="/Dashboard/Refund/Terima/{{$refund->id}}" class="btn btn-primary">Terima</a>
                            <a href="/Dashboard/Refund/Tolak/{{$refund->id}}" class="btn btn-primary">Tolak</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="terima{{$refund->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Refund Terima</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Apakah anda akan melanjutkan? </h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if($refund->status == 'pending')
                            <a href="/Dashboard/Refund/Terima/{{$refund->id}}" class="btn btn-primary">Terima</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="tolak{{$refund->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Refund Tolak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Apakah anda akan melanjutkan? </h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if($refund->status == 'pending')
                            <a href="/Dashboard/Refund/Tolak/{{$refund->id}}" class="btn btn-danger">Tolak</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endforeach


<!-- jQuery -->
    <script src="{{ asset ('Lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset ('Lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ('Lte/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset ('Lte//plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset ('Lte//plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset ('Lte//plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset ('Lte//plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- page script -->
    <script>
        var valuePersentase = 0;
        $(document).ready(function () {
            valuePersentase = $('#persentase').val();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        function ajaxPersentase() {
            var value = $('#persentase').val();

            $.ajax({
                url: "/ajax/persentase-refund",
                type: "POST",
                data: {
                    persentase: value,
                },
                success: function (result) {
                    $('#persentase').val(result.persenan_refund);
                    alert('Update refund berhasil');
                },
                error: function (result) {
                    $('#persentase').val(valuePersentase);
                    alert(result.message);
                }
            });

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
