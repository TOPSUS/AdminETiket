<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard | Create Pembelian</title>
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
    <style>
        .numpick {
            width: 200px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
@include('adminPelabuhan.header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('adminPelabuhan.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Pembelian</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="{{ route('beritaPelabuhan') }}">Pembelian</a>
                            </li>
                            <li class="breadcrumb-item"> Tambah Pembelian
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Begin Page Content -->
            <div class="card shadow mb-4">
                <form method="POST" enctype="multipart/form-data" action="{{route('testBeli')}}">
                    @csrf
                    <div class="form-group card-header">
                        <div class="row col-12">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="jadwal" class="font-weight-bold text-dark">Jadwal</label>
                                    <select name="jadwal" id="jadwal" class="custom-select" required>
                                        <option>- Jadwal -</option>
                                        @foreach($jadwal as $jadwal)
                                            <option value="{{$jadwal->id}}">[Hari {{$jadwal->hari}}] - [ KAPAL {{$jadwal->relasiJadwal->kapal->nama_kapal}} ]
                                                - [ Asal {{$jadwal->relasiJadwal->asal->nama_pelabuhan}} ] -  [ Tujuan {{$jadwal->relasiJadwal->tujuan->nama_pelabuhan}} ]
                                                - [ Jam {{$jadwal->relasiJadwal->waktu_berangkat}} ] - [ Estimasi {{$jadwal->relasiJadwal->estimasi_waktu}} menit ] -
                                                Rp {{$jadwal->relasiJadwal->harga}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <div class="form-group cols-xl-6">
                                    <label for="golongan" class="font-weight-bold text-dark">Golongan</label>
                                    <select name="golongan" id="golongan" class="custom-select cols-xl-6" required>
                                        <option value="0"> Penumpang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_polisi" class="font-weight-bold text-dark">Nomor Polisi</label>
                                    <input type="nomor_polisi" name="nomor_polisi" id="nomor_polisi" class="form-control cols-xl-6" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quant" class="font-weight-bold text-dark">Jumlah Penumpang</label>
                            <div class="numpick">
                                <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-number mr-2"
                                                    data-type="minus"
                                                    data-field="quant">
                                                    <span class="fas fa-minus"></span>
                                            </button>
                                        </span>
                                    <input type="text" name="quant" class="form-control input-number" value="0"
                                           min="0" max="100">
                                    <span class="input-group-btn">
                                            <button type="button" class="btn btn-success btn-number ml-2"
                                                    data-type="plus" data-field="quant">
                                                <span class="fas fa-plus"></span>
                                            </button>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <table class="table" id="dynamic_field" rules="none" style="border:none;">
                            <tr>
                            </tr>
                        </table>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Lanjut</button>
                        </div>


                </form>
            </div>
    </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('adminPelabuhan.footer')
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
    $(document).ready(function (e) {

        $('select[name="jadwal"]').on('change', function () {
            let jadwalid = $(this).val();
            console.log(jadwalid);
            $('select[name="golongan"]').empty();
            $('select[name="golongan"]').append('<option value="0"> Penumpang </option>');
            if (jadwalid) {
                jQuery.ajax({
                    url: "/getGolongans/" + jadwalid,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('select[name="golongan"]').empty();
                        $('select[name="golongan"]').append('<option value="0"> Penumpang </option>');
                        $.each(data, function (key, value) {
                            $('select[name="golongan"]').append('<option value="' + value.id + '">' + value.golongan + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="golongan"]').empty();
                $('select[name="golongan"]').append('<option value="0"> Penumpang </option>');
            }
        });

        $('select[name="golongan"]').on('change', function () {
            let golonganid = $(this).val();
            if(golonganid==0){
                document.getElementById("nomor_polisi").readOnly = true;
            } else {
                document.getElementById("nomor_polisi").readOnly = false;
            }
        });

        //plugin bootstrap minus and plus
        //http://jsfiddle.net/laelitenetwork/puJ6G/
        $('.btn-number').click(function (e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {
                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                        $('#namerow' + currentVal).remove();
                        $('#cardrow' + currentVal).remove();
                        $('#numbercardrow' + currentVal).remove();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {
                    if (currentVal < input.attr('max')) {
                        var i = currentVal + 1;
                        input.val(currentVal + 1).change();
                        $('#dynamic_field').append('<tr id="namerow' + i + '" class="dynamic-added"><td style="width:10%;">Tiket ' + i + '</td><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control"/></td>' +
                            '</tr>');
                        $('#dynamic_field').append('<tr id="cardrow' + i + '" class="dynamic-added"><td style="width:10%;"></td><td><select name="card_id[]" id="card_id' + i + '"class="custom-select" required></select></td>' +
                            '</tr>');
                        $('#dynamic_field').append('<tr id="numbercardrow' + i + '" class="dynamic-added"><td style="width:10%;"></td><td><input type="text" name="card[]" placeholder="Enter your Card ID" class="form-control"/></td>' +
                            '</tr>');
                        $.ajax({
                            url: '/id-card/get',
                            method: "GET",
                            success: function (data) {
                                jQuery.each(data, function (index, values) {
                                    var val = values;
                                    option_card_id = '<option value=' + values + '>' + val.split('+').join(' ') + '</option>';
                                    $('#card_id' + i).append(option_card_id);
                                });
                            }
                        });
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function () {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        var i = 1;
        var datas;
        var option_card_id;


        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="namerow' + i + '" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control"/></td>' +
                '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            $('#dynamic_field').append('<tr id="cardrow' + i + '" class="dynamic-added"><td><select name="card_id[]" id="card_id' + i + '"class="custom-select" required></select></td>' +
                '</tr>');
            $('#dynamic_field').append('<tr id="numbercardrow' + i + '" class="dynamic-added"><td><input type="text" name="card[]" placeholder="Enter your Card ID" class="form-control"/></td>' +
                '</tr>');
            $.ajax({
                url: '/id-card/get',
                method: "GET",
                success: function (data) {
                    jQuery.each(data, function (index, values) {
                        option_card_id = '<option value=' + values + '>' + values + '</option>';
                        $('#card_id' + i).append(option_card_id);
                    });
                }
            });
        });


        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#namerow' + button_id).remove();
            $('#cardrow' + button_id).remove();
            $('#numbercardrow' + button_id).remove();
        });
    });
</script>

</body>
</html>
