@extends('layouts.master')

@section('title')
    Stok Opname
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <button onclick="updatePeriode()" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Ubah Filter</button>
              <a href="{{ route('kartupersediaan.export_pdf', [$tanggalAwal, $tanggalAkhir, $kode_barang]) }}" target="_blank" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-print"></i> Export PDF</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-reponsive">
                <h4 style="text-align: center;">KARTU BARANG PERSEDIAAN</h4>
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
                        <td> : {{indo_date($tanggalAwal,false)}} - {{indo_date($tanggalAkhir,false)}}</td>
                    </tr>
                </table>
                <table class="table table-bordered">
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
                    </tbody>
                </table>
            </div>
            <!-- ./card-body -->
            {{-- <div class="card-footer">
              
            </div> --}}
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
@includeIf('kartupersediaan.form')

@endsection

@push('scripts')
    <script>
        let table;

        $(function () {
            table = $('.table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                searching: false,
                lengthChange: false,
                ajax: {
                    url: '{{ route('kartupersediaan.data', [$tanggalAwal, $tanggalAkhir, $kode_barang]) }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'tanggal'},
                    {data: 'jumlah_barang_masuk'},
                    {data: 'harga_satuan_masuk'},
                    {data: 'total_harga_masuk'},
                    {data: 'keluar'},
                    {data: 'sisa'},
                    {data: 'keterangan'}
                ],
                dom: 'rt',
                bSort: false,
                bPaginate: false,
            }).on('draw.dt', function () {
                // loadForm();
            });

            $('input[name="range_tanggal"]').daterangepicker({

            }, function(start, end, label) {
                $('#tanggal_awal').val(start.format('YYYY-MM-DD'));
                $('#tanggal_akhir').val(end.format('YYYY-MM-DD'));

                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });

        function updatePeriode() {
            $('#modal-form').modal('show');
        }
    </script>
@endpush