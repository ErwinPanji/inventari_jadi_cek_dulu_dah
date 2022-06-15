<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Perintah Penyaluran Barang</title>

    {{-- <link rel="stylesheet" href="{{ asset('/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}"> --}}
    <style>
        @page {
            size: 21.59cm 35.56cm;
            margin-top: 5cm;
            /* margin-bottom: 100px; */
            margin-right: 1.65cm;
            margin-left: 2.25cm;
            text-align: justify;
            /* text-justify: inter-word; */
        }

        .row {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-gap: 20px;
            margin-top : 1cm;
        }

        div.ratakanankiri {
            text-align: justify;
        }
        
        .table-border table,.table-border th,.table-border tr,.table-border td{
            border: 1px solid black;
            /* border-collapse: collapse; */
        }
    </style>

</head>
<body>
    <div class="ratakanankiri">
        <p style="text-align : center">KARTU BARANG PERSEDIAAN</p>
        <table style="margin-top: 1cm">
            <tr>
                <td>SKPD</td>
                <td> : {{$nama_skpd}}</td>
            </tr>
            <tr>
                <td>KAB/Kota</td>
                <td> : Kota Administrasi Jakarta Utara</td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td> : DKI Jakarta</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table style="margin-top: 2px;">
            <tr>
                <td>Nama Barang</td>
                <td> : {{$nama_barang}}</td>
            </tr>
            <tr>
                <td>Satuan</td>
                <td> : {{$satuan}}</td>
            </tr>
            <tr>
                <td>Periode</td>
                <td> : {{indo_date($awal,false)}} - {{indo_date($akhir,false)}}</td>
            </tr>
        </table>
        <br>
        <table class="table-border" width="100%" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th width="5%" rowspan="2" style = "vertical-align: center;">No. </th>
                    <th rowspan="2" style = "text-align:center;vertical-align: center;">Tanggal</th>
                    <th colspan = "3" style = "text-align:center;">Masuk</th>
                    <th rowspan= "2" style = "text-align:center;vertical-align: center;">Keluar</th>
                    <th rowspan= "2" style = "text-align:center;vertical-align: center;">Sisa</th>
                    <th rowspan= "2" style = "text-align:center;vertical-align: center;">Ket</th>
                </tr>
                <tr>
                    <th>Jumlah Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah (Rp.)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                <tr>
                    @foreach ($row as $col)
                        <td>{{ $col }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6" style="float:left">
                <p><br>Kepala {{$nama_skpd}}</p>
                <p style="margin-top: 2cm">{{$nama_kepala}}<br>NIP {{$nip_kepala}}</p>
            </div>
            <div class="col-md-6" style="float:right">
                <p>Jakarta,..............................<br>Pengurus Barang</p>
                <p style="margin-top: 2cm">{{$nama_kepala}}<br>NIP {{$nip_kepala}}</p>
            </div>
        </div>

        
    </div>
        
</body>
</html>