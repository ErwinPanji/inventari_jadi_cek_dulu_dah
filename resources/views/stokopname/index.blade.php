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
              <a href="{{ route('stokopname.export_pdf', [$tanggalAwal, $tanggalAkhir, $jenis_barang]) }}" target="_blank" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-print"></i> Export PDF</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-reponsive">
                <h4 style="text-align: center;">PEMERIKSAAN FISIK (STOCK OPNAME) BARANG PERSEDIAAN<br>
                    PER TANGGAL {{indo_date($tanggalAwal,false)}} - {{indo_date($tanggalAkhir,false)}}
                </h4>
                <table class="table table-striped">
                    <thead>
                        <th width="5%">No. </th>
                        <th>Nama Barang</th>
                        <th>Spesifikasi</th>
                        <th>Sisa Stok Persediaan</th>
                        <th>Satuan</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Jumlah (Rp) sudah termasuk pajak</th>
                        <th>Keterangan</th>
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
@includeIf('stokopname.form')

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
                    url: '{{ route('stokopname.data', [$tanggalAwal, $tanggalAkhir, $jenis_barang]) }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    {data: 'nama_barang'},
                    {data: 'spesifikasi_barang'},
                    {data: 'jumlah_instock'},
                    {data: 'satuan'},
                    {data: 'harga_satuan'},
                    {data: 'jumlah_termasuk_ppn'},
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