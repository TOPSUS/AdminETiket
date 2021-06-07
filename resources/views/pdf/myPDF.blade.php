<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>invoice</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        .page_break {
            page-break-before: always;
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <b style="font-size: 20px;">
                                E-Ticket</b><br/>
                            Pelayaran {{$data->jadwal->relasiJadwal->kapal->tipe_kapal}}<br/>
                            <b style="font-size: 10px;">
                                Created #: {{date('D F Y H:m', strtotime($data->created_at))}}
                            </b>
                        </td>
                        <td class="title">
                            <img src="{{public_path('logo.png')}}" style="width: 100%; max-width: 45px"/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!--Informasi Pemesan-->
        <tr class="heading">
            <td>Informasi Pemesan Tiket</td>
            <td></td>
        </tr>

        <tr class="item">
            <td>Nama</td>
            <td>{{$data->user->nama}} / {{$data->user->jeniskelamin}}</td>
        </tr>

        <tr class="item">
            <td>Nomor Handphone {{$data->user->card}}</td>
            <td>{{$data->user->nohp}}</td>
        </tr>

        <!--Informasi keberangkatan-->
        <tr class="heading">
            <td>Informasi Keberangkatan</td>
            <td></td>
        </tr>

        <tr class="item">
            <td>Pelabuhan Asal</td>
            <td>{{$data->jadwal->relasiJadwal->asal->nama_pelabuhan}}</td>
        </tr>

        <tr class="item">
            <td>Pelabuhan Tujuan</td>
            <td>{{$data->jadwal->relasiJadwal->tujuan->nama_pelabuhan}}</td>
        </tr>

        <tr class="item">
            <td>Nama Kapal</td>
            <td>{{$data->jadwal->relasiJadwal->kapal->nama_kapal}}</td>
        </tr>

        <tr class="item">
            <td>Tanggal Keberangkatan</td>
            <td>{{$data->tanggal}}</td>
        </tr>

        <tr class="item ">
            <td>Jam Keberangkatan</td>
            <td>{{$data->jadwal->relasiJadwal->waktu_berangkat}}</td>
        </tr>

        <!--detail pesanan-->
        <tr class="heading">
            <td>Detail Pesanan</td>
            <td>Harga</td>
        </tr>

        <tr class="item ">
            <td>{{count($data->detailPembelian)}} Tiket Kapal</td>
            <td>Rp. @if($data->id_golongan)
                    {{number_format($data->total_harga - $data->golongans->harga)}}
                @else
                    {{number_format($data->total_harga)}}
                @endif</td>
        </tr>

        @if($data->id_golongan)
            <tr class="item last">
                <td>Gol Kendaraan : {{$data->golongans->golongan}}</td>
                <td> Rp. {{number_format($data->golongans->harga)}} </td>
            </tr>
        @endif


        <tr class="total">
            <td></td>
            <td>Total: Rp. {{number_format($data->total_harga)}}</td>
        </tr>

        <tr class="details">
            <td style="margin-left: 18px; font-size: 10px;">
                Mohon lakukan check-in minimal <b>1jam</b> sebelum Keberangkatan </br>
                Jika mengalami kendala mohon hubungi CS TOPSUS di <b>021-211-22-111</b> atau email <b>cs@topsus.com</b>
            </td>
        </tr>
    </table>
</div>

@foreach($data->detailPembelian as $detail)
    <div class="page_break"></div>

    <!--invoice detail penumpang-->
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <b style="font-size: 20px;">
                                    E-Ticket</b><br/>
                                Pelayaran {{$data->jadwal->relasiJadwal->kapal->tipe_kapal}}<br/>
                                <b style="font-size: 12px;">
                                    <!--waktu-->{{date('H:m', strtotime($data->jadwal->relasiJadwal->waktu_berangkat))}},
                                    <!--tanggal-->{{date('D F Y', strtotime($data->jadwal->relasiJadwal->tanggal))}},
                                    <!--asal-->{{$data->jadwal->relasiJadwal->asal->nama_pelabuhan}}
                                    -
                                    <!--tujuan-->{{$data->jadwal->relasiJadwal->tujuan->nama_pelabuhan}},
                                    <!--nama kapal-->{{$data->jadwal->relasiJadwal->kapal->nama_kapal}}
                                </b>
                            </td>

                            <td class="title">
                                <img src="{{public_path('logo.png')}}"
                                     style="width: 100%; max-width: 45px"/>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


            <!--detail penumpang-->
            <tr class="heading">
                <td>Informasi Detail Pemegang Tiket</td>
                <td></td>
            </tr>

            <tr class="item ">
                <td>Nama</td>
                <td>{{$detail->nama_pemegang_tiket}}</td>
            </tr>

            <tr class="item">
                <td>{{$detail->card->card}}</td>
                <td>{{$detail->no_id_card}}</td>
            </tr>

            <tr class="item last">
                <td style="margin-left: 18px; font-size: 10px;"> </br></br>
                <!--Kode tiket anda : <b>{{$detail->kode_tiket}}</b>-->
                    </br>
                    Mohon lakukan check-in minimal <b>1jam</b> sebelum Keberangkatan </br>
                    Jika mengalami kendala mohon hubungi CS TOPSUS di <b>021-211-22-111</b> atau email
                    <b>cs@topsus.com</b>
                </td>

                <td>
                    <img
                        src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(160)->generate($detail->kode_tiket)) !!} ">
                </td>
            </tr>


        </table>
    </div>
@endforeach
</body>
</html>
