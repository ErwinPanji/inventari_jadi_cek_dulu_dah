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
        <p style="text-align : center">SURAT PERINTAH PENYALURAN BARANG (SPPB)<br>NOMOR: ............ /SPPB/........</p>
        <p style="margin-top : 1cm;">
            Pada hari ...................... Tanggal ....... Bulan ......................... Tahun ..........., yang bertanda tangan di bawah ini:
        </p> 
        <table>
            <tr>
                <td>Nama</td>
                <td> : {{$nama_kepala}}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td> : Kepala {{$nama_skpd}}</td>
            </tr>
        </table>
        <br>
        <p>
            Berdasarkan Surat Permintaan Barang (SPB) dari {{$jabatan_pemohon}} Nomor {{$nomor_spb}} Tanggal {{$tanggal_spb}}, 
            dengan ini diperintahkan Kepada Pengurus Barang untuk mendistribusikan/mengeluarkan persediaan, 
            sebagaimana tersebut di bawah ini.<br>
        </p>
        <p>
            Daftar barang persediaan yang didistribusikan/dikeluarkan adalah sebagai berikut :
        </p>
        <table class="table-border" width="100%" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Uraian Nama Barang</th>
                    <th width = "10%">Jumlah</th>
                    <th width = "10%">Satuan</th>
                    <th width = "20%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sppblist as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td text="center">{{ $item->jumlah_permintaan }}</td>
                        <td>{{ $item->satuan}}</td>
                        <td>{{ $item->keterangan}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top : 1cm; float: left;">
            <p>Kepala {{$nama_skpd}}</p>
            <p style="margin-top: 2cm">{{$nama_kepala}}<br>NIP {{$nip_kepala}}</p>
        </div>
    </div>
        
</body>
</html>