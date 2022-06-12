@extends('layouts.master')

@section('title')
    Setting Profil SKPD/UKPD
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="card-form">
                <div class="card-header">
                    <h5>Informasi SKPD/UKPD/UPB Sekolah</h5>
                </div>
                <form action="{{ route('profilskpd.update') }}" method="post" class="form-profilskpd" data-toggle="validator" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_skpd_ukpd" class="col-lg-2 control-label">Nama SKPD/UKPD</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_skpd_ukpd" class="form-control" id="nama_skpd_ukpd" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-lg-2 control-label">Alamat</label>
                            <div class="col-lg-6">
                                <textarea type="text" name="alamat" class="form-control" id="alamat" rows="3" style="resize: none;" required autofocus></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-lg-2 control-label">Telepon</label>
                            <div class="col-lg-6">
                                <input type="text" name="telepon" class="form-control" id="telepon" required autofocus>
                            </div>
                        </div>
                        <hr>
                        <h5>Informasi Kepala SKPD/UKPD/UPB Sekolah</h5><br>
                        <div class="form-group">
                            <label for="nama_kepala" class="col-lg-2 control-label">Nama</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_kepala" class="form-control" id="nama_skpd_ukpd" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nip_kepala" class="col-lg-2 control-label">NIP</label>
                            <div class="col-lg-6">
                                <input type="text" name="nip_kepala" class="form-control" id="nip_kepala" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telp_kepala" class="col-lg-2 control-label">Hp./Telp.</label>
                            <div class="col-lg-6">
                                <input type="text" name="telp_kepala" class="form-control" id="telp_kepala" required autofocus>
                            </div>
                        </div>
                        <hr>
                        <h5>Informasi Pengurus Barang</h5><br>
                        <div class="form-group">
                            <label for="nama_pengurus" class="col-lg-2 control-label">Nama</label>
                            <div class="col-lg-6">
                                <input type="text" name="nama_pengurus" class="form-control" id="nama_pengurus" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nip_pengurus" class="col-lg-2 control-label">NIP</label>
                            <div class="col-lg-6">
                                <input type="text" name="nip_pengurus" class="form-control" id="nip_pengurus" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_skpd_ukpd" class="col-lg-2 control-label">Hp./Telp.</label>
                            <div class="col-lg-6">
                                <input type="text" name="telp_pengurus" class="form-control" id="telp_pengurus" required autofocus>
                            </div>
                        </div>
                        <hr>
                        <h5>Setting PPN</h5><br>
                        <div class="form-group">
                            <label for="ppn" class="col-lg-2 control-label">PPN</label>
                            <div class="col-lg-6">
                                <input type="text" name="ppn" class="form-control" id="ppn" required autofocus>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(function () {
        showData();

            $.validator.setDefaults({
                submitHandler: function () {
                    $.ajax({
                        url: $('#card-form form').attr('action'),
                        type: 'post',
                        data:$('#card-form form').serialize()
                    })
                    .done((response) => {
                        showData();

                        toastr.success('Data Berhasil Disimpan ', 'Info', {timeOut: 1000});
                    }).fail((error) =>{
                        alert('Tidak dapat menyimpan data !');
                        return;
                    })
                }
            });

            $('.form-profilskpd').validate({
                rules: {
                    nama_skpd_ukpd: {
                        required: true,
                    },
                    alamat: {
                        required: true,
                    },
                    telepon: {
                        required: true,
                    },
                    nama_kepala: {
                        required: true,
                    },
                    nama_kepala: {
                        required: true,
                    },
                    telp_kepala: {
                        required: true,
                    },
                    nama_pengurus: {
                        required: true,
                    },
                    nip_pengurus: {
                        required: true,
                    },
                    telp_pengurus: {
                        required: true,
                    },
                    ppn: {
                        required: true,
                    },
                },
                messages: {
                    nama_skpd_ukpd: {
                        required: 'Mohon Isi Nama SKPD/UKPD',
                    },
                    alamat: {
                        required: 'Mohon Isi Alamat SKPD/UKPD',
                    },
                    telepon: {
                        required: 'Mohon Isi Nomor Telepon SKPD/UKPD',
                    },
                    nama_kepala: {
                        required: 'Mohon Isi Nama Kepala SKPD/UKPD',
                    },
                    nip_kepala: {
                        required: 'Mohon Isi NIP Kepala SKPD/UKPD',
                    },
                    telp_kepala: {
                        required: 'Mohon Isi Telepon Kepala SKPD/UKPD',
                    },
                    nama_pengurus: {
                        required: 'Mohon Isi Nama Pengurus SKPD/UKPD',
                    },
                    nip_pengurus: {
                        required: 'Mohon Isi NIP Pengurus SKPD/UKPD',
                    },
                    telp_pengurus: {
                        required: 'Mohon Isi Telepon Pengurus SKPD/UKPD',
                    },
                    ppn: {
                        required: 'Mohon Isi nilai PPN',
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

    function showData() {
        $.get('{{ route('profilskpd.show') }}')
            .done(response => {
                $('[name=nama_skpd_ukpd]').val(response.nama_skpd_ukpd);
                $('[name=telepon]').val(response.telepon);
                $('[name=alamat]').val(response.alamat);

                $('[name=nama_kepala]').val(response.nama_kepala);
                $('[name=telp_kepala]').val(response.no_telp_kepala);
                $('[name=nip_kepala]').val(response.nip_kepala);
                
                $('[name=nama_pengurus]').val(response.nama_pengurus);
                $('[name=telp_pengurus]').val(response.no_telp_pengurus);
                $('[name=nip_pengurus]').val(response.nip_pengurus);

                $('[name=ppn]').val(response.ppn);
                
                $('title').text(response.nama_skpd_ukpd + ' | Pengaturan');
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }
</script>
@endpush