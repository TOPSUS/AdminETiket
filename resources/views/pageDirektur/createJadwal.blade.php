<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | Create Jadwal</title>
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
    @include('direkturKapal/header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   @include('direkturKapal/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Jadwal</h1>
          </div>
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('jadwalSpeedboat') }}">Jadwal</a></li>
              <li class="breadcrumb-item"> Tambah Jadwal
                </a>
              </li>
            </ol> -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
 <!-- Begin Page Content -->
 <div class="card shadow mb-4">
    <div class="card shadow">
        <form method="POST" enctype="multipart/form-data" action="{{route('addJadwalDirektur')}}">
        @csrf 
            <div class="form-group card-header">
            <div class="form-group">
                <label for="kapal" class="font-weight-bold text-dark">Kapal</label>
                  <select name="id_kapal" id="id_kapal" class="custom-select" required>
                    <option>- Pilih Kapal -</option>
                    @foreach($dataKapal as $kp)
                    <option value="{{$kp->id}}">{{$kp->nama_kapal}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="asal" class="font-weight-bold text-dark">Asal</label>
                  <select name="id_asal_pelabuhan" id="id_asal_pelabuhan" class="custom-select" required>
                    <option>- Pilih Asal -</option>
                    @foreach($pelabuhanasal as $pa)
                    <option value="{{$pa->id}}">{{$pa->nama_pelabuhan}}</option>
                    @endforeach
                  </select>
              </div>
              
              <div class="form-group">
                <label for="tujuan" class="font-weight-bold text-dark">Tujuan</label>
                  <select name="id_tujuan_pelabuhan" id="id_tujuan_pelabuhan" class="custom-select" required>
                    <option>- Pilih Tujuan -</option>
                    @foreach($pelabuhantujuan as $pt)
                    <option value="{{$pt->id}}">{{$pt->nama_pelabuhan}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label for="waktu_berangkat" class="font-weight-bold text-dark">Waktu Berangkat</label>
                  <input type="time" step="1" class="form-control" id="waktu_berangkat" name="waktu_berangkat">
              </div>
              <div class="form-group">
                  <label for="tanggal" class="font-weight-bold text-dark">Tanggal</label>
                  <input type="date" step="1" class="form-control" id="tanggal" name="tanggal">
              </div>
              <div class="form-group">
                  <label for="estimasi_waktu" class="font-weight-bold text-dark">Estimasi Waktu</label>
                  <input type="number" step="1" class="form-control" id="estimasi_waktu" placeholder="Masukan Estimasi Waktu" name=estimasi_waktu">
              </div>
              <div class="form-group">
                  <label for="harga" class="font-weight-bold text-dark">Harga</label>
                  <input type="text" step="1" class="form-control" id="harga" placeholder="Masukan Harga" name="harga">
              </div>
            </div>
            <div class="form-group card-header">
                <a href="/Jadwal"><button type="button" class="btn btn-secondary">Batal</button></a>
                <button type="submit" class="btn btn-success">Tambah Jadwal</button>
            </div>
        </form>
    </div>
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  @include('direkturKapal/footer')
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


<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function(e){
        var status;
        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });

        $(function(){
            $(".tanggal").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });

        $('#blog_category-name').selectpicker();

        jQuery('#submitBlogCategory').click(function(e){
            jQuery.ajax({
                url: "{{url('admin/kategori')}}",
                type: "POST",
                data: {
                    _token: $('#signup-token').val(),
                    name: jQuery('#blogCategoryName').val(),
                },
                success: function(result){
                    $('.ganti').html(result.view);
                    $('#blog_category_name').selectpicker('refresh');
                    $('#addBlogCategory').modal('hide');
                    console.log(result.view);
                }
            });
        });
    });
</script>
</body>
</html>
