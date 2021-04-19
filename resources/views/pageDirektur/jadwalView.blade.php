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
    @include('direkturkapal/header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   @include('direkturkapal/sidebar')

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
              <li><a href="{{ route('createJadwalDirektur') }}" class= "btn btn-success text-white"><i class="fas fa-plus"></i> Tambah Jadwal</a></li>
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
                    <th>Nama Kapal</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Waktu Berangkat</th>
                    <th>Estimasi Waktu</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                @foreach($jadwal as $dataJadwal)
                    <tr>
                    <td>{{$dataJadwal->kapal->nama_kapal}}</td>
                    <td>{{$dataJadwal->asal->nama_pelabuhan}}</td>
                    <td>{{$dataJadwal->tujuan->nama_pelabuhan}}</td>
                    <td>{{$dataJadwal->waktu_berangkat}} - {{date('d F Y', strtotime($dataJadwal->tanggal))}}</td>
                    <td>{{$dataJadwal->estimasi_waktu}} menit</td>
                    <td>IDR {{number_format($dataJadwal->harga)}}</td>
                    <td>
                    <a data-toggle="modal" class="btn btn-sm bg-danger" data-target="#delete{{$dataJadwal->id}}"> <i class="fas fa-trash-alt"></i></a>
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
    @include('direkturkapal/footer')

<!-- Modal Update -->
@foreach($jadwal as $oldJadwal)
  <div class="modal fade" id="update{{$oldJadwal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Jadwal <strong>{{$oldJadwal->kapal->nama_kapal}}</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editJadwal') }}" method="POST">
                @csrf
                    <input type="hidden" name="id_jadwal" value="{{$oldJadwal->id}}">
                    <div class="form-group">
                    <label for="id_asal_pelabuhan" class="font-weight-bold text-dark">Asal Pelabuhan</label>
                      <select name="id_asal_pelabuhan" class="custom-select" required>
                        <option value="{{$oldJadwal->id_asal_pelabuhan}}">{{$oldJadwal->asal->nama_pelabuhan}}</option>
                        @foreach($pelabuhanasal as $pa)
                        <option value="{{$pa->id}}">{{$pa->nama_pelabuhan}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="id_tujuan_pelabuhan" class="font-weight-bold text-dark">Tujuan Pelabuhan</label>
                        <select name="id_tujuan_pelabuhan" class="custom-select" required>
                          <option value="{{$oldJadwal->id_tujuan_pelabuhan}}">{{$oldJadwal->tujuan->nama_pelabuhan}}</option>
                            @foreach($pelabuhantujuan as $pt)
                            <option value="{{$pt->id}}">{{$pt->nama_pelabuhan}}</option>
                            @endforeach
                        </select>
                    </div>                
                    <div class="form-group">
                      <label for="waktu_berangkat" class="font-weight-bold text-dark">Waktu Berangkat</label>
                      <input type="time" step="1" class="form-control" id="waktu_berangkat" placeholder="Masukan Asal Speedboat" name="waktu_berangkat" value="{{$oldJadwal->waktu_berangkat}}" require>
                    </div>
                    <div class="form-group">
                      <label for="tanggal" class="font-weight-bold text-dark">Tanggal</label>
                      <input type="date" step="1" class="form-control" id="tanggal" name="tanggal" value="{{$oldJadwal->tanggal}}">
                    </div>
                    <div class="form-group">
                      <label for="estimasi_waktu" class="font-weight-bold text-dark">Estimasi Waktu</label>
                      <input type="number" step="1" class="form-control" id="estimasi_waktu" placeholder="Masukan Estimasi Waktu" name="estimasi_waktu" value="{{$oldJadwal->estimasi_waktu}}" require>
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
<!-- Modal Delete -->
<div class="modal fade" id="delete{{$oldJadwal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="/Jadwal/delete/{{$oldJadwal->id}}" method="POST">
        <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        Apakah anda yakin menghapus jadwal?</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Delete -->

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
