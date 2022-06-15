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

        .row {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-gap: 20px;
            margin-top : 1cm;
        }

       .table-border table,.table-border th,.table-border tr,.table-border td{
            border: 1px solid black;
            /* border-collapse: collapse; */
        }

        .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

    </style>

</head>
<body>
    <div class="ratakanankiri">
        <p style="text-align : center">BERITA ACARA SERAH TERIMA BARANG<br>DISTRIBUSI/ PENGELUARAN<br>NOMOR: ............ /BAST-DIST/........</p>
        <p style="margin-top : 1cm;">
            Pada hari ...................... Tanggal ....... Bulan ......................... Tahun ..........., yang bertanda tangan di bawah ini:
        </p> 
        <table>
            <tr>
                <td>1.</td>
                <td>Nama</td>
                <td> : {{$nama_petugas}}</td>
            </tr>
            <tr>
                <td></td>
                <td>Jabatan</td>
                <td> : Pengurus Barang</td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>2.</td>
                <td>Nama</td>
                <td> : ........................................</td>
            </tr>
            <tr>
                <td></td>
                <td>Jabatan</td>
                <td> : ........................................</td>
            </tr>
        </table>
        <br>
        <p>
            Berdasarkan Surat Perintah Penyaluran Barang (SPPB) dari Kepala SMK Negeri 4 Jakarta Nomor : {{$nomor_sppb}} Tanggal {{$tanggal_sppb}}.,
            telah diserahkan oleh Pengurus Barang kepada Pemakai Barang Persediaan sebagaimana daftar terlampir.<br>
        </p>
        <p>
            Daftar barang yang diserahkan sebagai berikut:
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
                @foreach ($bastlist as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td text-align ="center">{{ $item->jumlah_permintaan }}</td>
                        <td >{{ $item->satuan}}</td>
                        <td>{{ $item->keterangan}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6" style="float:left">
                <p>Yang Menyerahkan : <br>Pengurus Barang</p>
                <p style="margin-top: 2cm">{{$nama_kepala}}<br>NIP {{$nip_kepala}}</p>
            </div>
            <div class="col-md-6" style="float:right">
                <p>Yang Menerima :</p>
                <p style="margin-top: 2.5cm">{{$nama_pemohon}}<br>NIP/NIIKI {{$nip_pemohon}}</p>
            </div>
        </div>
        <div class="center" style="margin-top : 5cm;">
            <p>Kepala {{$nama_skpd}}</p>
            <p style="margin-top: 2cm">{{$nama_kepala}}<br>NIP {{$nip_kepala}}</p>
        </div>
    </div>
        
</body>
</html>