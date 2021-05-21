<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<style type="text/css">
    table tr td,
    table tr th {
        font-size: 9pt;
    }
</style>
<center>
    <h5>Laporan Transaksi</h4>
</center>

<table class='table table-bordered'>
    <thead>
    <tr>
        <th>No.</th>
        <th>Nama Pembeli</th>
        <th>Keberangkatan</th>
        <th>Pelabuhan Asal</th>
        <th>Pelabuhan Tujuan</th>
        <th>Kapal</th>
        <th>Tanggal Pembelian</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dataPembelian as $p)
        <tr>
            <td>{{$loop->iteration }}</td>
            <td>{{$p->user->nama}}</td>
            <td>{{date('H : m', strtotime($p->jadwal->waktu_berangkat))}}</td>
            <td>{{$p->jadwal->asal->nama_pelabuhan}}</td>
            <td>{{$p->jadwal->tujuan->nama_pelabuhan}}</td>
            <td>{{$p->jadwal->kapal->nama_kapal}}</td>
            <td>{{date('d F Y', strtotime($p->tanggal))}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
