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
                @empty(! session('kode_sppb'))
                    <a href="{{ route('sppblist.index') }}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-book-open"></i> Transaksi Aktif</a>
                @endempty
            </div>
            <!-- /.card-header -->
            <div class="card-body table-reponsive">
                <table class="table table-striped" id="table-main">
                    <thead>
                        <th width="5%">No. </th>
                        <th>Nomor SPB</th>
                        <th>Tanggal SPB</th>
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
            {{-- @includeIf('sppb.form') --}}
        </div>
      </div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
@includeIf('sppb.pemohon')
@includeIf('sppb.show')
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
                    url : '{{ route ('sppb.data') }}',
                },
                columns:[
                    {data: 'DT_RowIndex',searchable : false, sortable:false},
                    {data: 'nomor_spb'},
                    {data: 'tanggal_spb'},
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
                    {data: 'aksi', searchable: false, sortable: false}
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

            $('#sppb-form').validate({
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
                        required: "Mohon Isi Nomor SPB !",
                    },
                    tanggal_spb:{
                        required: "Mohon Pilih Tanggal SPB!",
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

                $.post(`{{ url('/sppb') }}/${id}`, {
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