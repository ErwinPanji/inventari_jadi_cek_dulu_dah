<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Perintah Penyaluran Barang</title>

    <link rel="stylesheet" href="{{ asset('/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
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
            Daftar barang persediaan yang didistribusikan/dikeluarkan adalah sebagai berikut :
        </p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
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

        <div class="float-right" style="margin-top : 1cm;">
            <p>Kepala {{$nama_skpd}}</p>
            <p style="margin-top: 2cm">{{$nama_kepala}}<br>NIP {{$nip_kepala}}</p>
        </div>
    </div>
        
</body>
</html>