<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | Review Speedboat</title>
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
            <h1>Data Review</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('adminSpeedboatHome') }}">Dashboard</a></li>
            <!--  <li class="breadcrumb-item active"><a href="{{ route('createRewardSpeedboat') }}"><i class="fas fa-plus"></i> Tambah Data
                </a>
              </li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    
      <!-- Default box -->
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Daftar Review</h6>
      </div>
      <!-- Card Body -->
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
                    @foreach($review as $reviewlist)  
                    @php 
                    $title=DB::table('tb_speedboat')->select('title')->where('id',$reviewlist->id_speedboat)->get();
                    @endphp
                        <tr>
                            <td>{{$reviewlist->id}}</td>
                            <td>{{$reviewlist->user['nama']}}</td>
                            <td>@foreach($title as $data){{ $data->title}} @endforeach</td>
                            <td>{{$reviewlist->review}}</td>
                            <td>
                            <ul style="list-style:none">
                                @for($i=1; $i<=5;$i++)
                                @if($reviewlist->score >=$i)
                                    <li style="float:left;color:#F7941D;"><i class="fa fa-star"></i></li>
                                @else 
                                    <li style="float:left;color:#F7941D;"><i class="far fa-star"></i></li>
                                @endif
                                @endfor
                            </ul>
                            </td>
                            <td>{{$reviewlist->created_at->format('M d D, Y g: i a')}}</td>
                        </tr>  
                    @endforeach
                </tbody>
            </table>
            <span style="float:right">{{$review->links()}}</span>
            @else
            <h5 class="text-center">Tidak terdapat data review ! </h6>
            @endif
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('adminSpeedboat/footer')

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
