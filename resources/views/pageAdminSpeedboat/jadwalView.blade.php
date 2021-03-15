<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Dashboard | Jadwal</title>
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
            <h1>Jadwal Keberangkatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('create-jadwal') }}"><i class="fas fa-plus"></i> Tambah Data
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
        <div class="card shadow mb-4">
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Asal</th>
                    <th>Waktu Berangkat</th>
                    <th>Tujuan</th>
                    <th>Waktu Sampai</th>
                    <th>Speed Boat</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                @foreach($jadwal as $dataJadwal)
                    <tr>
                    <td>{{$dataJadwal->asal->nama_pelabuhan}}</td>
                    <td>{{$dataJadwal->waktu_berangkat}}</td>
                    <td>{{$dataJadwal->tujuan->nama_pelabuhan}}</td>
                    <td>{{$dataJadwal->waktu_sampai}}</td>
                    <td>{{$dataJadwal->harga}}</td>
                    <td>
                    <a class="btn btn-sm bg-danger" href="/Dashboard/CRUD/DeleteJadwal/{{$dataJadwal->id}}"> <i class="fas fa-trash-alt"></i></a>
                    <a data-toggle="modal" data-target="#update{{$dataJadwal->id}}" class="btn btn-sm btn-primary" href="#" ><i class="fas fa-edit"></i> Edit Jadwal
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
    @include('adminSpeedboat/footer')

<!-- Modal Update -->
@foreach($jadwal as $oldJadwal)
  <div class="modal fade" id="update{{$oldJadwal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-jadwal') }}" method="POST">
                @csrf
                    <input type="hidden" name="id_jadwal" value="">
                    <div class="form-group">
                    <label for="id_asal_pelabuhan" class="font-weight-bold text-dark">Asal Pelabuhan</label>
                      <select name="id_asal_pelabuhan" class="custom-select" required>
                        <option value="{{$oldJadwal->id_asal_pelabuhan}}">{{$oldJadwal->asal->nama_pelabuhan}}</option>
                        @foreach($pelabuhan as $pb)
                        <option value="{{$pb->id}}">{{$pb->nama_pelabuhan}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="id_tujuan_pelabuhan" class="font-weight-bold text-dark">Tujuan Pelabuhan</label>
                        <select name="id_tujuan_pelabuhan" class="custom-select" required>
                          <option value="{{$oldJadwal->id_tujuan_pelabuhan}}">{{$oldJadwal->tujuan->nama_pelabuhan}}</option>
                            @foreach($pelabuhan as $pb)
                            <option value="{{$pb->id}}">{{$pb->nama_pelabuhan}}</option>
                            @endforeach
                        </select>
                    </div>                
                    <div class="form-group">
                      <label for="waktu_berangkat" class="font-weight-bold text-dark">Waktu Berangkat</label>
                      <input type="time" step="1" class="form-control" id="waktu_berangkat" placeholder="Masukan Asal Speedboat" name="waktu_berangkat" value="{{$oldJadwal->waktu_berangkat}}" require>
                    </div>
                    <div class="form-group">
                      <label for="waktu_sampai" class="font-weight-bold text-dark">Waktu Sampai</label>
                      <input type="time" step="1" class="form-control" id="waktu_sampai" placeholder="Masukan Tujuan Speedboat" name="waktu_sampai" value="{{$oldJadwal->waktu_sampai}}" require>
                    </div>
                    <div class="form-group">
                      <label for="harga" class="font-weight-bold text-dark">Harga Tiket</label>
                      <input type="text" step="1" class="form-control" id="harga" placeholder="Masukan Harga Tiket" name="harga" value="{{$oldJadwal->harga}}" require>
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
<script src="{{ asset ('Lte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('Lte/dist/js/demo.js') }}"></script>

</body>
</html>
