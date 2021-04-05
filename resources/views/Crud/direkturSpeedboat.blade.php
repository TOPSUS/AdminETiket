<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Dashboard | Speedboat Page</title>
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
            <h1>Data Speedboat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-home') }}">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="/Dashboard/CRUD/DirekturData/Speedboat/Create/{{$dataHakAkses[0]->id_user}}"><i class="fas fa-plus"></i> Tambah Data
                </a>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    @foreach($dataHakAkses as $hak)
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
        
            <div class="col-12 col-sm-6">
              <div class="col-12">
                <img src="/speedboat/{{$hak->speedboat->foto}}" class="product-image" alt="Product Image">
              </div>
              
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{$hak->speedboat->nama_speedboat}}</h3>
              <p>{{$hak->speedboat->deskripsi}}</p>
              <h4 class="mt-3"><small>Max Capacity</small> {{$hak->speedboat->kapasitas}} </h4>
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  {{$hak->speedboat->contact_service}}
                </h2>
                <h4 class="mt-0">
                  <small>Contact Service </small>
                </h4>
              </div>
              <br>
             <div class="">
                  <div class="text-right">
                    <a href="/Dashboard/CRUD/DeleteSpeedboat/{{$hak->speedboat->id}}" class="btn btn-sm bg-danger">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                    <a data-toggle="modal" data-target="#update{{$hak->speedboat->id}}" href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-edit"></i> Edit Speedboat
                    </a>
                  </div>
                </div>

            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> {{$hak->speedboat->deskripsi}}</div>
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> </div>
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
