<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Dashboard | Pelabuhan Page</title>
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
            <h1>Data Pelabuhan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('create-pelabuhan') }}"><i class="fas fa-plus"></i> Tambah Data
                </a>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    @foreach($dataPelabuhan as $pelabuhan)
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">Caspla Bali Seaview</h3>
              <div class="col-12">
                <img src="/pelabuhan/{{$pelabuhan->foto}}" class="product-image" alt="Product Image">
              </div>
              
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">Pelabuhan {{$pelabuhan->nama_pelabuhan}}</h3>
              <p>{{$pelabuhan->deskripsi}}</p>
              <br>
             <div class="">
                  <div class="text-right">
                    <a href="/Dashboard/CRUD/DeletePelabuhan/{{$pelabuhan->id}}" class="btn btn-sm bg-danger">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                    <a data-toggle="modal" data-target="#update{{$pelabuhan->id}}" href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-edit"></i> Edit Pelabuhan
                    </a>
                  </div>
                </div>

            </div>
          </div>
          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    @endforeach
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('adminDashboard/footer')

<!-- Modal Update -->
@foreach($dataPelabuhan as $oldPelabuhan)
  <div class="modal fade" id="update{{$oldPelabuhan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-pelabuhan') }}" method="POST">
                @csrf
                    <input type="hidden" name="id_pelabuhan" value="{{$oldPelabuhan->id}}">
                    <div class="form-group">
                      <label for="nama_pelabuhan" class="font-weight-bold text-dark">Nama Pelabuhan</label>
                      <input type="text" class="form-control" id="nama_pelabuhan" placeholder="Masukan Nama Pelabuhan" name="nama_pelabuhan" value="{{$oldPelabuhan->nama_pelabuhan}}" require>
                    </div>
                    <div class="form-group">
                      <label for="lama_beroperasi" class="font-weight-bold text-dark">Beroperasi Sejak</label>
                      <input type="date" step="1" class="form-control" id="lama_beroperasi" placeholder="Masukan Asal Speedboat" name="lama_beroperasi" value="{{$oldPelabuhan->lama_beroperasi}}" require>
                    </div>
                    <div class="form-group">
                      <label for="lokasi_pelabuhan" class="font-weight-bold text-dark">Alamat Pelabuhan</label>
                      <input type="text" class="form-control" id="lokasi_pelabuhan" placeholder="Masukan Alamat Pelabuhan" name="lokasi_pelabuhan" value="{{$oldPelabuhan->lokasi_pelabuhan}}" require>
                    </div>
                    <div class="form-group">
                      <label for="alamat_kantor" class="font-weight-bold text-dark">Alamat Kantor</label>
                      <input type="text" class="form-control" id="alamat_kantor" placeholder="Masukan Alamat Kantor" name="alamat_kantor" value="{{$oldPelabuhan->alamat_kantor}}" require>
                    </div>
                    <div class="form-group">
                      <label for="deskripsi" class="font-weight-bold text-dark">Deskripsi</label>
                      <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10" placeholder="Deskripsi">
                      {{$oldPelabuhan->deskripsi}}
                      </textarea>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputFile">Foto Pelabuhan</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" name="foto">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                    <label for="InputName" class="font-weight-bold text-dark">Status</label>
                      <br>@if($oldPelabuhan->status == "Beroperasi")
                        <input type="radio" name="role" value="Beroperasi" checked> Beroperasi &nbsp &nbsp
                        <input type="radio" name="role" value="Tidak Beroperasi"> Tidak Beroperasi &nbsp &nbsp
                        @else
                        <input type="radio" name="role" value="Beroperasi" > Beroperasi &nbsp &nbsp
                        <input type="radio" name="role" value="Tidak Beroperasi" checked> Tidak Beroperasi &nbsp &nbsp
                        @endif
                    </div>
                    <label for="InputName" class="font-weight-bold text-dark">Tipe Pelabuhan</label>
                      <br>
                      @if($oldPelabuhan->tipe_pelabuhan == "feri")
                        <input type="radio" name="tipe_pelabuhan" value="feri" checked> Ferry &nbsp &nbsp
                        <input type="radio" name="tipe_pelabuhan" value="speedboat"> Speedboat &nbsp &nbsp
                        <input type="radio" name="tipe_pelabuhan" value="speedboat & feri"> Speedboat dan Ferry &nbsp &nbsp
                        @elseif($oldPelabuhan->tipe_pelabuhan == "speedboat")
                        <input type="radio" name="tipe_pelabuhan" value="feri"> Ferry &nbsp &nbsp
                        <input type="radio" name="tipe_pelabuhan" value="speedboat" checked> Speedboat &nbsp &nbsp
                        <input type="radio" name="tipe_pelabuhan" value="speedboat & feri"> Speedboat dan Ferry &nbsp &nbsp
                        @else
                        <input type="radio" name="tipe_pelabuhan" value="feri"> Ferry &nbsp &nbsp
                        <input type="radio" name="tipe_pelabuhan" value="speedboat"> Speedboat &nbsp &nbsp
                        <input type="radio" name="tipe_pelabuhan" value="speedboat & feri" checked> Speedboat dan Ferry &nbsp &nbsp
                        @endif
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
