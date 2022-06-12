@extends('layouts.master')

@section('title')
    Master Pemohon
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
              <button onclick="addForm('{{route('pemohon.store')}}')" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-reponsive">
                <table class="table table-striped">
                    <thead>
                        <th width="5%">No. </th>
                        <th>Nama Pemohon</th>
                        <th>NIP/NIIKI</th>
                        <th>Jabatan</th>
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
@includeIf('pemohon.form')

@endsection

@push('scripts')
    <script>
        let table;
         
        $(function (){
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                "order": [], //Initial no order.
                "aaSorting": [],
                ajax: {
                    url : '{{ route ('pemohon.data') }}',
                },
                columns:[
                    {data: 'DT_RowIndex',searchable : false, sortable:false},
                    {data: 'nama_pemohon'},
                    {data: 'nip_niiki'},
                    {data: 'jabatan'},
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

            $('#pemohon-form').validate({
                rules: {
                    nama_pemohon: {
                        required: true,
                    },
                    nip_niiki: {
                        required: true,
                    },
                },
                messages: {
                    nama_pemohon: {
                        required: "Mohon Isi Nama Pemohon !",
                    },
                    nip_niiki: {
                        required: "Mohon Isi NIP/NIIKI !",
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
            $('#modal-form .modal-title').text('Tambah Pemohon');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            // $('#modal-form [name=alamat]').text('');
            $('#modal-form [name=nama_pemohon]').focus();
        }
        
        function editForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Pemohon');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama_pemohon]').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama_pemohon]').val(response.nama_pemohon);
                    $('#modal-form [name=nip_niiki]').val(response.nip_niiki);
                    $('#modal-form [name=jabatan]').val(response.jabatan);
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