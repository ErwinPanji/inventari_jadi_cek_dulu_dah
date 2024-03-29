@extends('layouts.master')

@section('title')
    Berita Acara Serah Terima Barang Distribusi
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card" id="card-table">
            <div class="card-header">
                <button onclick="addForm()" class="btn btn-success btn-sm btn-flat"><i class="fas fa-plus-circle"></i> Tambah BAST</button>
                <button onclick="showFilter()" class="btn btn-warning btn-sm btn-flat"><i class="fas fa-print"></i> Cetak Data</button>

                @empty(! session('kode_bast_dist'))
                    <a href="{{ route('bastlist.index') }}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-book-open"></i> Transaksi Aktif</a>
                @endempty
            </div>
            <!-- /.card-header -->
            <div class="card-body table-reponsive">
                <table class="table table-striped" id="table-main">
                    <thead>
                        <th width="5%">No. </th>
                        <th>Nomor SPPB</th>
                        <th>Tanggal SPPB</th>
                        <th>Nama Pemohon</th>
                        <th width="15%">Action</th>
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

      <div class="row">
        <div class="col-md-12">
            {{-- @includeIf('bast.form') --}}
        </div>
      </div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
@includeIf('bast.pemohon')
@includeIf('bast.show')
@includeIf('bast.filter')

@endsection

@push('scripts')
    <script>
        let table, tablePemohon;
         
        $(function (){            
            table = $('#table-main').DataTable({
                processing: true,
                autoWidth: false,
                "order": [], //Initial no order.
                "aaSorting": [],
                ajax: {
                    url : '{{ route ('bast.data') }}',
                },
                columns:[
                    {data: 'DT_RowIndex',searchable : false, sortable:false},
                    {data: 'nomor_sppb'},
                    {data: 'tanggal_sppb'},
                    {data: 'nama_pemohon'},
                    {data: 'aksi',searchable : false, sortable:false}
                ]               
            });

            $('.table-pemohon').DataTable();

            table1 = $('.table-show').DataTable({
                processing: true,
                bSort: false,
                // dom: 'Brt',
                columns: [
                    {data: 'DT_RowIndex', searchable: false, sortable: false},
                    // {data: 'kode_barang'},
                    {data: 'nama_barang'},
                    {data: 'jumlah'},
                    {data: 'satuan'},
                    {data: 'keterangan'},
                    // {data: 'aksi', searchable: false, sortable: false}
                ]
            })
            
            $.validator.setDefaults({
                submitHandler: function () {
                    $.ajax({
                        url: $('#card-form form').attr('action'),
                        type: 'post',
                        data:$('#card-form form').serialize()
                    })
                    .done((response) => {
                        alert('Data berhasil disimpan !');
                        cancelButton();
                        table.ajax.reload();
                    }).fail((error) =>{
                        alert('Tidak dapat menyimpan data !');
                        return;
                    })
                }
            });

            $('#bast-form').validate({
                rules: {
                    nomor_spb: {
                        required: true,
                    },
                    tanggal_spb:{
                        required: true,
                    },
                    nama_pemohon:{
                        required: true,
                    }
                },
                messages: {
                    tanggal_penerimaan: {
                        required: "Mohon Isi Nomor SPPB !",
                    },
                    tanggal_spb:{
                        required: "Mohon Pilih Tanggal SPPB!",
                    },
                    nama_pemohon:{
                        required: "Mohon Isi Nama Pemohon !",
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });    
            
            $(document).on('input', '.quantity', function () {
                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());

                if (jumlah < 1) {
                    $(this).val(1);
                    alert('Jumlah tidak boleh kurang dari 1');
                    return;
                }
                if (jumlah > 10000) {
                    $(this).val(10000);
                    alert('Jumlah tidak boleh lebih dari 10000');
                    return;
                }

                $.post(`{{ url('/bast') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'put',
                        'jumlah': jumlah,
                    })
                    .done(response => {
                        $(this).on('mouseout', function () {
                            table1.ajax.reload();                        
                            // table.ajax.reload(() => loadForm($('#diskon').val()));
                        });
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            });

            $('input[name="range_tanggal"]').daterangepicker({

            }, function(start, end, label) {
                $('#tanggal_awal').val(start.format('YYYY-MM-DD'));
                $('#tanggal_akhir').val(end.format('YYYY-MM-DD'));

                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });

        });

        function showFilter() {
            $('#filter-form').modal('show');
        }

        $("#filter-form" ).submit(function( event ) {
            $('#filter-form').modal('hide');

        });


        function showDetail(url) {
            $('#modal-show').modal('show');

            table1.ajax.url(url);
            table1.ajax.reload();
        }

        function addForm() {
            $('#modal-pemohon').modal('show');
        }

        function deleteData(url){
            if(confirm('Yakin ingin menghapus data ?')){
                $.post(url, {
                    '_token' : $('[name=csrf-token]').attr('content'),
                    '_method' : 'delete'
                })
                .done((response) => {
                    alert('Data berhasil dihapus !');
                    table.ajax.reload();
                })
                .fail((error) => {
                    alert('Tidak dapat menghapus data !');
                    return
                })
            }            
        }

        function deleteDetail(url){
            if(confirm('Yakin ingin menghapus data ?')){
                $.post(url, {
                    '_token' : $('[name=csrf-token]').attr('content'),
                    '_method' : 'delete'
                })
                .done((response) => {
                    alert('Data berhasil dihapus !');
                    table1.ajax.reload();
                })
                .fail((error) => {
                    alert('Tidak dapat menghapus data !');
                    return
                })
            }            
        }

        function cetakData(url){
            // alert(url);
            $.post(url, {
                '_token' : $('[name=csrf-token]').attr('content'),
                '_method' : 'get'
            })   
        }

    </script>
@endpush