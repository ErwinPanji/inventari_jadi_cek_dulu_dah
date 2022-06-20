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
            size: 35.56cm 21.59cm;
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
        <p style="text-align : center">PEMERIKSAAN FISIK (STOCK OPNAME) BARANG PERSEDIAAN<br>PER TANGGAL {{indo_date($awal,false)}} - {{indo_date($akhir,false)}}</p>
        <table>
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
            <tr>
                <td>Jenis Barang</td>
                <td> : {{$jenis_barang}}</td>
            </tr>
        </table>
        <br>
        <table class="table-border" width="100%" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th width="5%">No. </th>
                    <th>Nama Barang</th>
                    <th>Spesifikasi</th>
                    <th>Sisa Stok Persediaan</th>
                    <th>Satuan</th>
                    <th>Harga Satuan (Rp)</th>
                    <th>Jumlah (Rp) sudah termasuk pajak</th>
                    <th>Keterangan</th>
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
                <p>Kepala {{$nama_skpd}}</p>
                <p style="margin-top: 2cm">{{$nama_kepala}}<br>NIP {{$nip_kepala}}</p>
            </div>
            <div class="col-md-6" style="float:right">
                <p>Pengurus Barang</p>
                <p style="margin-top: 2cm">{{$nama_petugas}}<br>NIP {{$nip_petugas}}</p>
            </div>
        </div>

        
    </div>
        
</body>
</html>