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
            margin-top: 2cm;
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
            table-layout: fixed;
            width: 1px;
            /* white-space: nowrap; */
            /* border-collapse: collapse; */
        }
    </style>

</head>
<body>
    <div class="ratakanankiri">
        <p style="text-align : center; font-size: 25px">REKAPITULASI BARANG DISTRIBUSI</p>
        <table class="table-border" width="100%" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nomor SPPB</th>
                    <th>Tanggal SPPB</th>
                    <th>Nama Pemohon</th>
                    <th>Jabatan</th>
                    <th>NIP/NIKKI</th>
                    <th>Nama Barang</th>
                    <th>Sisa Persediaan</th>
                    <th>Satuan</th>
                    <th>Jumlah Permintaan</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->nomor_sppb}}</td>
                        <td>{{indo_date($item->tanggal_sppb,false)}}</td>
                        <td>{{$item->nama_pemohon}}</td>
                        <td>{{$item->jabatan}}</td>
                        <td>{{$item->nip_niiki}}</td>
                        <td>{{$item->nama_barang}}</td>
                        <td>{{$item->instock}}</td>
                        <td>{{$item->satuan}}</td>
                        <td>{{$item->jumlah_permintaan}}</td>
                        <td>{{$item->satuan}}</td>
                        <td>{{$item->keterangan}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <div style="margin-top : 1cm; float: right;">
            <p>Kepala {{$nama_skpd}}</p>
            <p style="margin-top: 2cm">{{$nama_kepala}}<br>NIP {{$nip_kepala}}</p>
        </div> --}}
    </div>
        
</body>
</html>