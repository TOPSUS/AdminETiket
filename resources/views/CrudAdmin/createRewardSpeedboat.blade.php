<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | Create Reward</title>
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
            <h1>Data Reward Speedboat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('adminSpeedboatHome') }}">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('createRewardSpeedboat') }}"><i class="fas fa-plus"></i> Tambah Data
                </a>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   <div class="card shadow mb-4">
    <div class="card shadow">
        <form method="POST" enctype="multipart/form-data" action="{{route('addRewardSpeedboat')}}">
          @csrf
            <div class="row card-header">
                <div class="col">
                    <label for="id_speedboat" class="font-weight-bold text-dark">Nama Speedboat</label>
                    <input type="hidden" name="id_speedboat" value="{{$dataRewardSpeedboat->id_speedboat}}">{{$dataRewardSpeedboat->speedboat->nama_speedboat}}
                  <!--
                   @foreach($dataRewardSpeedboat as $rewardSpeedboat)
                     <option value="{{$sb->id}}">{{$sb->nama_speedboat}}</option>
                    @endforeach
                  -->
                </div>
                <div class="col">
                   
                </div>
            </div>

            <div class="row card-header">
                <div class="col">
                <label for="exampleInputFile">Nama Reward</label>
                <input type="text" class="form-control" id="reward" placeholder="Masukan Nama Reward" name="reward">
                </div>

                <div class="col">
                <label for="exampleInputFile">Foto Reward</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="foto">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>

            </div>

            <div class="row card-header">
                <div class="col">
                    <label for="berlaku" class="font-weight-bold text-dark">Berlaku Sampai</label>
                    <input type="date" step="1" class="form-control" id="berlaku" placeholder="Masukan Asal Speedboat" name="berlaku">
                </div>
                <div class="col">
                    <label for="minimal_point" class="font-weight-bold text-dark"> Point</label>
                    <input type="number" class="form-control" id="minimal_point" placeholder="Masukan Point" name="minimal_point" min="0">
                </div>
            </div>

            <div class="form-group card-header">
                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Add Data</button>
            </div>
        </form>
    </div>
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('adminSpeedboat/footer')
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
<script src="{{ asset ('Lte//dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset ('Lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset ('dist/js/demo.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
