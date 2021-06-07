<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | Review Kapal</title>
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
                        <h1>Data Review</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">


            <!-- Card Body -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($review)>0)
                            <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Speedboat</th>
                                    <th>Review</th>
                                    <th>Rate</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($review as $reviewlist=> $rl)
                                    <tr>
                                        <td>{{$reviewlist+1}}</td>
                                        <td>{{$rl->user->nama}}</td>
                                        <td>{{$rl->pembelian->jadwal->relasiJadwal->kapal->nama_kapal}}</td>
                                        <td>{{$rl->review}}</td>
                                        <td>
                                            <ul style="list-style:none">
                                                @for($i=1; $i<=5;$i++)
                                                    @if($rl->score >=$i)
                                                        <li style="float:left;color:#F7941D;"><i class="fa fa-star"></i>
                                                        </li>
                                                    @else
                                                        <li style="float:left;color:#F7941D;"><i
                                                                class="far fa-star"></i></li>
                                                    @endif
                                                @endfor
                                            </ul>
                                        </td>
                                        <td>{{$rl->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h5 class="text-center">Tidak terdapat data review ! </h6>
                        @endif
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->

@include('direkturKapal.footer')

<!-- Datatable Script -->

<!-- End Datatable -->

<!-- jQuery -->
<script src="{{ asset ('Lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('Lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('Lte//dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>
</body>
</html>
