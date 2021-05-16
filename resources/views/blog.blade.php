<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>E-Ticket Berita</title>
    <link rel="icon" type="image/x-icon" href="{{asset('clean-assets/favicon.ico')}}"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
          type="text/css"/>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('clean-css/styles.css')}}" rel="stylesheet"/>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#">E-Ticket Pelabuhan</a>
    </div>
</nav>
<!-- Page Header-->
@if($type == 'pelabuhan')
    <header class="masthead" style="background-image: url('{{'/storage/image_berita_pelabuhan/'.$blog->foto}}')">
        @elseif($type=='kapal')
            <header class="masthead" style="background-image: url('{{'/storage/image_berita_espeed/'.$blog->foto}}')">
                @endif
                <div class="overlay"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 col-md-10 mx-auto">
                            <div class="site-heading">
                                <h1>{{$blog->judul}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main Content-->
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="card content container">
                            {!! $blog->berita !!}
                            <p class="post-meta">
                                Posted by
                                <a href="#!">{{$blog->relasiUser->nama}}</a>
                                on {{date('F d, Y', strtotime($blog->tanggal))}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <hr/>
            <!-- Footer-->
            <!-- Bootstrap core JS-->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
            <script src="{{asset('clean-js/scripts.js')}}"></script>
</body>
</html>
