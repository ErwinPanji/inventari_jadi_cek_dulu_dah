@extends('layouts.master')

@section('title')
    Penerimaan Barang
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
              <button onclick="addForm('{{route('penerimaanbarang.store')}}')" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-reponsive">
                <table class="table table-striped">
                    <thead>
                        <th width="5%">No. </th>
                        <th>Tanggal Penerimaan</th>
                        <th>Nama Penyedia</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
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

      <div class="row">
        <div class="col-md-12">
            @includeIf('penerimaanbarang.form')
        </div>
      </div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
@endsection

@push('scripts')
    <script>
        let table;
         
        $(function (){            
            $("#card-form").css({display: "none"});
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                // dropdownParent: $("#modal-form")
            });

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'yy-MM-DD'
            });

            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                "order": [], //Initial no order.
                "aaSorting": [],
                ajax: {
                    url : '{{ route ('penerimaanbarang.data') }}',
                },
                columns:[
                    {data: 'DT_RowIndex',searchable : false, sortable:false},
                    // {data: 'kode_satuan',sortable:false},
                    {data: 'tanggal_penerimaan'},
                    {data: 'nama_penyedia'},
                    {data: 'nama_barang'},
                    {data: 'jumlah_barang'},
                    {data: 'satuan_barang'},
                    {data: 'aksi',searchable : false, sortable:false}
                ]               
            });

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

            $('#penerimaan-barang-form').validate({
                rules: {
                    tanggal_penerimaan: {
                        required: true,
                    },
                    kode_penyedia:{
                        required: true,
                    },
                    nomor_bukti:{
                        required: true,
                    },
                    kode_sumber_dana:{
                        required: true,
                    },
                    kode_jenis_barang:{
                        required: true,
                    },
                    kode_barang:{
                        required: true,
                    },
                    jumlah_barang:{
                        required: true,
                    },
                    satuan:{
                        required: true,
                    },
                    harga_satuan:{
                        required: true,
                    },
                },
                messages: {
                    tanggal_penerimaan: {
                        required: "Mohon Isi Tanggal Penerimaan !",
                    },
                    kode_penyedia:{
                        required: "Mohon Pilih Penyedia !",
                    },
                    nomor_bukti:{
                        required: "Mohon Isi Nomor Bukti Pengiriman !",
                    },
                    kode_sumber_dana:{
                        required: "Mohon Pilih Sumber Dana !",
                    },
                    kode_jenis_barang:{
                        required: "Mohon Pilih Jenis Barang !",
                    },
                    kode_barang:{
                        required: "Mohon Pilih Nama Barang !",
                    },
                    jumlah_barang:{
                        required: "Mohon Pilih Jumlah Barang !",
                    },
                    satuan:{
                        required: "Mohon Pilih Satuan Barang !",
                    },
                    harga_satuan:{
                        required: "Mohon Pilih Harga Satuan !",
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
            $("#card-table").css({display: "none"});
            $("#card-form").css({display: ""});

            $('#card-form .card-title').text('Tambah Penerimaan Barang');

            $('#card-form form')[0].reset();
            $('#card-form form').attr('action',url);
            $('#card-form [name=_method]').val('post');
            $('#card-form [name=jenis_barang]').focus();
            $('#card-form [name=kode_penyedia] option[value =""]').attr("selected","selected").select2().trigger('change');
            $('#card-form [name=kode_sumber_dana] option[value =""]').attr("selected","selected").select2().trigger('change');
            $('#card-form [name=kode_jenis_barang] option[value =""]').attr("selected","selected").select2().trigger('change');
            $('#card-form [name=kode_barang] option[value =""]').attr("selected","selected").select2().trigger('change');
            $('#card-form [name=satuan] option[value =""]').attr("selected","selected").select2().trigger('change');
        }
        
        function editForm(url){
            $("#card-table").css({display: "none"});
            $("#card-form").css({display: ""});

            $('#card-form .card-title').text('Edit Penerimaan Barang');

            $('#card-form form')[0].reset();
            $('#card-form form').attr('action',url);
            $('#card-form [name=_method]').val('put');
            


            $.get(url)
                .done((response) => {
                    $('#card-form [name=tanggal_penerimaan]').val(response.tanggal_penerimaan);
                    $('#card-form [name=kode_penyedia] option[value ="'+response.kode_penyedia+'"]').attr("selected","selected").select2().trigger('change');
                    $('#card-form [name=nomor_bukti]').val(response.nomor_tanda_bukti);
                    $('#card-form [name=kode_sumber_dana] option[value ="'+response.kode_sumber_dana+'"]').attr("selected","selected").select2().trigger('change');
                    $('#card-form [name=tahun_anggaran]').val(response.tahun_anggaran);
                    $('#card-form [name=bulan]').val(response.bulan);
                    $('#card-form [name=kode_jenis_barang] option[value ="'+response.kode_jenis_barang+'"]').attr("selected","selected").select2().trigger('change');
                    $('#card-form [name=kode_barang] option[value ="'+response.kode_barang+'-'+response.nama_barang+'"]').attr("selected","selected").select2().trigger('change');
                    $('#card-form [name=spesifikasi]').text(response.spesifikasi_barang);
                    $('#card-form [name=jumlah_barang]').val(response.jumlah_barang);
                    $('#card-form [name=satuan] option[value ="'+response.satuan_barang+'"]').attr("selected","selected").select2().trigger('change');
                    $('#card-form [name=harga_satuan]').val(response.harga_satuan);
                    $('#card-form [name=subtotal]').val(response.subtotal);
                    $('#card-form [name=ppn]').val(response.ppn);
                    $('#card-form [name=total]').val(response.total);
                    $('#card-form [name=keterangan]').text(response.keterangan);                 
                    
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

        function cancelButton(){
            $("#card-table").css({display: ""});
            $("#card-form").css({display: "none"});
        }

        function calculate() {
            var jumlah_barang = document.getElementById('jumlah_barang').value;
            var harga_satuan = document.getElementById('harga_satuan').value;
            var subtotal = parseInt(jumlah_barang) * parseInt(harga_satuan);
            var ppn = parseFloat(subtotal) * ({{$ppn}}/100);
            var total = parseFloat(subtotal) + parseFloat(ppn);

            if (!isNaN(subtotal) || !isNaN(ppn) || !isNaN(total)) {
                document.getElementById('subtotal').value = subtotal;
                document.getElementById('ppn').value = ppn;
                document.getElementById('total').value = total;
            }
        }
    </script>
@endpush