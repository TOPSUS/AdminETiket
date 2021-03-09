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
              <li class="breadcrumb-item active"><a href="{{ route('create-speedboat') }}"><i class="fas fa-plus"></i> Tambah Data
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
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">Caspla Bali Seaview</h3>
              <div class="col-12">
                <img src="{{ asset('Lte/dist/img/Caspla1.jpg') }}" class="product-image" alt="Product Image">
              </div>
              
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">Caspla Bali Seaview</h3>
              <p>Caspla Bali Sea View Tours and Travel welcomes you to explore the Island of Nusa Penida which is known as a hidden paradise island in Bali.</p>
              <h4 class="mt-3"><small>Max Capacity</small> 100 </h4>
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  Rp.100.000
                </h2>
                <h4 class="mt-0">
                  <small>Harga /tiket </small>
                </h4>
              </div>
              <br>
             <div class="">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-danger">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
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
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> Lorem Caspla Bali Sea View Tours and Travel welcomes you to explore the Island of Nusa Penida which is known as a hidden paradise island in Bali. To get to Nusa Penida Island we need 30 minutes only for crossing the sea from Sanur harbor using our Luxury speed boat with 200 HP X 3 engine with capacity 40 persons for each boat. Caspla Bali also provides services to cross to the island of Nusa Lembongan and Gili. Caspla Bali Boat Reguler Trip "Sanur to Nusa Penida". Motorized with 200x3 horse power rated under international maritime. Code of Safety, 13.00-meter length, 3.00-meter width. Boat Capacity for 45 persons completed with a life jacket, compass and radio calling GPRS Caspla Bali Boat is the best speed boat go to Nusa Penida used Caspla Bali 4 and have 6-year experience sea public transport to go Nusa Penida. </div>
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">Caspla Bali Seaview</h3>
              <div class="col-12">
                <img src="{{ asset('Lte/dist/img/Caspla1.jpg') }}" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="{{ asset('Lte/dist/img/Caspla1.jpg') }}" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="{{ asset('Lte/dist/img/Caspla2.jpg') }}" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="{{ asset('Lte/dist/img/Caspla3.jpg') }}" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="{{ asset('Lte/dist/img/Caspla5.jpg') }}" alt="Product Image"></div>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">Caspla Bali Seaview</h3>
              <p>Caspla Bali Sea View Tours and Travel welcomes you to explore the Island of Nusa Penida which is known as a hidden paradise island in Bali.</p>
              <h4 class="mt-3"><small>Max Capacity</small> 100 </h4>
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  Rp.100.000
                </h2>
                <h4 class="mt-0">
                  <small>Harga /tiket </small>
                </h4>
              </div>
              
              <div class="mt-4">
                 <div class="btn btn-default btn-lg btn-flat">
                  <i class="fas fa-id-badge fa-lg mr-2"></i> 
                  Contact Info
                </div>
              </div>

              <div class="mt-4 product-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
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
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> Lorem Caspla Bali Sea View Tours and Travel welcomes you to explore the Island of Nusa Penida which is known as a hidden paradise island in Bali. To get to Nusa Penida Island we need 30 minutes only for crossing the sea from Sanur harbor using our Luxury speed boat with 200 HP X 3 engine with capacity 40 persons for each boat. Caspla Bali also provides services to cross to the island of Nusa Lembongan and Gili. Caspla Bali Boat Reguler Trip "Sanur to Nusa Penida". Motorized with 200x3 horse power rated under international maritime. Code of Safety, 13.00-meter length, 3.00-meter width. Boat Capacity for 45 persons completed with a life jacket, compass and radio calling GPRS Caspla Bali Boat is the best speed boat go to Nusa Penida used Caspla Bali 4 and have 6-year experience sea public transport to go Nusa Penida. </div>
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
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
