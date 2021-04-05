<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | Reward Speedboat</title>
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
            <h1>Data Reward</h1>
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

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">

          @foreach($dataRewardSpeedboat as $rewardSpeedboat)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
              <div class="text-center d-flex">
                      <img src="/reward/{{$rewardSpeedboat->foto}}" alt="" class="img-square" style="width:300px;height:200px;">
                    </div>
                <div class="card-header text-muted border-bottom-0">
                  Reward - {{$rewardSpeedboat->speedboat->nama_speedboat}}
                </div>
                
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <i class="fas fa-lg fa-donate"></i><b>POIN : {{$rewardSpeedboat->minimal_point}}</b>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                      <br>
                        <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-gift"></i></span> Reward: {{$rewardSpeedboat->reward}}</li><br>
                        <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-stopwatch"></i></span> Masa Berlaku : <br>{{$rewardSpeedboat->berlaku}}</li>
                      </ul>
                    </div>
                   
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="/Reward/DeleteRewardSpeedboat/{{$rewardSpeedboat->id}}" class="btn btn-sm bg-danger">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                    <a data-toggle="modal" data-target="#update{{$rewardSpeedboat->id}}" href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-edit"></i> Edit Reward
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item"><a class="page-link" href="#">6</a></li>
              <li class="page-item"><a class="page-link" href="#">7</a></li>
              <li class="page-item"><a class="page-link" href="#">8</a></li>
            </ul>
          </nav>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('adminSpeedboat/footer')

<!-- Modal Update -->
@foreach($dataRewardSpeedboat as $oldRewardSpeedboat)
  <div class="modal fade" id="update{{$oldRewardSpeedboat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateRewardSpeedboat') }}" method="POST">
                @csrf
                    <input type="hidden" name="id_reward_speedboat" value="{{$oldRewardSpeedboat->id}}">
                    <div class="form-group">
                      <label for="id_speedboat" class="font-weight-bold text-dark">Nama Speedboat</label>
                      <input type="hidden" name="id_speedboat" value="{{$oldRewardSpeedboat->id_speedboat}}">{{$oldRewardSpeedboat->speedboat->nama_speedboat}}

                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Nama Reward</label>
                      <input type="text" class="form-control" id="reward" placeholder="Masukan Nama Reward" name="reward" value="{{$oldRewardSpeedboat->reward}}" require>
                    </div>
                    <div class="form-group">
                      <label for="berlaku" class="font-weight-bold text-dark">Berlaku Sampai</label>
                      <input type="date" step="1" class="form-control" id="berlaku" placeholder="Masukan Asal Speedboat" name="berlaku" value="{{$oldRewardSpeedboat->berlaku}}" require>
                    </div>
                    <div class="form-group">
                      <label for="minimal_point" class="font-weight-bold text-dark"> Point</label>
                      <input type="number" class="form-control" id="minimal_point" placeholder="Masukan Point" name="minimal_point" min="0" value="{{$oldRewardSpeedboat->minimal_point}}" require>
                    </div>
                    <div class="form-group">
                      <label for="InputName" class="font-weight-bold text-dark">Foto</label>
                      <input type="file" id="exampleInputFile" name="foto">
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
</body>
</html>
