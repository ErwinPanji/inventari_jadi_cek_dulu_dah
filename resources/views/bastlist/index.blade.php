@extends('layouts.master')

@section('title')
    Daftar Barang Disetujui
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        
            <div class="card">
                <div class="card-header with-border">
                        <table>
                            <tr>
                                <td>NIP</td>
                                <td>: {{ $pemohon->nip_niiki }}</td>
                            </tr>
                            <tr>
                                <td>Nama Pemohon</td>
                                <td>: {{ $pemohon->nama_pemohon }}</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>: {{ $pemohon->jabatan }}</td>
                            </tr>   
                        </table>
                        
                    
                </div>
                <div class="card-body">
                    <form action="{{ route('sppb.store') }}" class="form-listsppb" method="post" id="form-hide">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="hidden" name="kode_sppb" value="{{ $kode_sppb }}">
                                <div class="form-group">
                                    <label for="nomof_spb">Nomor SPB <small>*)</small> :</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" name = "nomor_spb" id="nomor_spb" data-inputmask='"mask": "999/SPB/9999"' data-mask required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Tanggal SPB<small> *)</small></label>
                                <div class="input-group input-group-sm date" id="tanggalspb" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#tanggalspb" name="tanggal_spb" id="tanggal_spb" required/>
                                    <div class="input-group-append" data-target="#tanggalspb" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-6">
                            <form class="form-barang">
                                @csrf
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <div class="input-group input-group-sm">
                                        <input type="hidden" name="kode_sppb" value="{{ $kode_sppb }}">
                                        <input type="text" class="form-control" name="kode_barang" id="kode_barang" readonly>
                                        <span class="input-group-append">
                                            <button  onclick="tampilBarang()" type="button" class="btn btn-info btn-flat"><i class="fa fa-arrow-right"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-stiped table-list-barang">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th width="15%">Jumlah</th>
                            <th>Sutuan</th>
                            <th>Keterangan</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                    </table>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm btn-flat float-right btn-simpan"><i class="fa fa-floppy-o"></i> Simpan</button>
                </div>
            </div>
    </div>
</div>

@includeIf('sppblist.barang')
@endsection

@push('scripts')
<script>
    let table, table2;
    $(function (){
        table = $('.table-list-barang').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('sppblist.data', $kode_sppb) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_barang'},
                {data: 'nama_barang'},
                {data: 'jumlah_permintaan'},
                {data: 'satuan'},
                {data: 'keterangan'},
                {data: 'aksi', searchable: false, sortable: false},
            ],
            // dom: 'Brt',
            bSort: false,
            paginate: false
        })
        .on('draw.dt', function () {
            // loadForm();
        });

        //Date picker
        $('#tanggalspb').datetimepicker({
            format: 'yy-MM-DD'
        });

        $('[data-mask]').inputmask()

        table2 = $('.table-barang').DataTable();  
        
        $(document).on('input', '.quantity', function () {
            let id = $(this).data('id');
            let jumlah = parseInt($(this).val());
            let keterangan = '';

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

            $.post(`{{ url('/sppblist') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'jumlah': jumlah,
                    'keterangan' : keterangan
                })
                .done(response => {
                    $(this).on('mouseout', function () {
                        table.ajax.reload();                        
                        // table.ajax.reload(() => loadForm($('#diskon').val()));
                    });
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        });

        $(document).on('input', '.keterangan', function () {
            let id = $(this).data('id');
            let keterangan = $(this).val();
            let jumlah = '';

            if (keterangan == '') {
                $(this).val();
                alert('Mohon isi keterangan');
                return;
            }

            $.post(`{{ url('/sppblist') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'jumlah': jumlah,
                    'keterangan' : keterangan
                })
                .done(response => {
                    $(this).on('mouseout', function () {
                        table.ajax.reload();                        
                        // table.ajax.reload(() => loadForm($('#diskon').val()));
                    });
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        });

        $('.btn-simpan').on('click', function () {
            $('.form-listsppb').submit();
        });

        $('.form-listsppb').validate({
            rules: {
                nomor_spb: {
                required: true,
                },
            },
            messages: {
                nomor_spb: {
                required: "Mohon Isi Nama Sumber Dana !",
                },
            },
            errorElement: 'td',
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
    })

    function deleteData(url) {
        // alert(url);
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response) => {
                table.ajax.reload();
            })
            .fail((errors) => {
                alert('Tidak dapat menghapus data');
                return;
            });
        }
    }

    function tampilBarang() {
        $('#modal-barang').modal('show');
    }

    function hideBarang() {
        $('#modal-barang').modal('hide');
    }

    function pilihBarang(kode) {
        // $('#id_produk').val(id);
        $('#kode_barang').val(kode);
        hideBarang();
        tambahBarang();
    }

    function tambahBarang() {
        $.post('{{ route('sppblist.store') }}', $('.form-barang').serialize())
            .done(response => {
                $('#kode_barang').focus();
                // table.ajax.reload();
                table.ajax.reload();                        
            })
            .fail(errors => {
                alert('Tidak dapat menyimpan data');
                return;
            });
    }
</script>    
@endpush