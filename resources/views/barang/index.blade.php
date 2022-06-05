@extends('layouts.master')

@section('title')
    Master Barang
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
              <button onclick="addForm('{{route('barang.store')}}')" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"> Tambah</i></button>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-reponsive">
                <table class="table table-striped">
                    <thead>
                        <th width="5%">No. </th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kode Jenis Barang</th>
                        <th>Jumlah Instock</th>
                        <th>Satuan</th>
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
      <!-- /.row -->
    </div><!--/. container-fluid -->
@includeIf('barang.form')

@endsection

@push('scripts')
    <script>
        let table;
         
        $(function (){
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })

            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                "order": [], //Initial no order.
                "aaSorting": [],
                ajax: {
                    url : '{{ route ('barang.data') }}',
                },
                columns:[
                    {data: 'DT_RowIndex',searchable : false, sortable:false},
                    // {data: 'kode_satuan',sortable:false},
                    {data: 'kode_barang'},
                    {data: 'nama_barang'},
                    {data: 'jenis_barang'},
                    {data: 'jumlah_instock'},
                    {data: 'satuan'},
                    {data: 'aksi',searchable : false, sortable:false}
                ]               
            });

            $.validator.setDefaults({
                submitHandler: function () {
                    $.ajax({
                        url: $('#modal-form form').attr('action'),
                        type: 'post',
                        data:$('#modal-form form').serialize()
                    })
                    .done((response) => {
                        alert('Data berhasil disimpan !');
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    }).fail((error) =>{
                        alert('Tidak dapat menyimpan data !');
                        return;
                    })
                }
            });

            $('#barang-form').validate({
                rules: {
                    nama_barang: {
                        required: true,
                    },
                    jenis_barang:{
                        required: true,
                    }
                },
                messages: {
                    nama_barang: {
                        required: "Mohon Isi Nama Barang !",
                    },
                    jenis_barang: {
                        required: "Mohon Pilih Jenis Barang !",
                    },
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

        });

        function addForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Barang');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=jenis_barang]').focus();
        }
        
        function editForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Barang');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('put');

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=jenis_barang]').val(response.kode_jenis_barang);
                    // $('#inputID').select2('data', {id: response.kode_jenis_barang, a_key: response.kode_jenis_barang});
                    $('#modal-form [name=nama_barang]').val(response.nama_barang);
                    $('#modal-form [name=satuan]').val(response.satuan);

                })
                .fail((error)=> {
                    alert('Tidak dapat menampilkan data !');
                })
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

        
    </script>
@endpush