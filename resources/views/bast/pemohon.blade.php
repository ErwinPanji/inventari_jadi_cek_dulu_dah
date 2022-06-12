<div class="modal fade" id="modal-pemohon" role="dialog" aria-labelledby="modal-barang">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-form">Daftar Pemohon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-pemohon">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th width="15%">NIP/NIKKI</th>
                            <th width="50%">Nama Pemohon</th>
                            <th>Jabatan</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                        @foreach ($pemohon as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->nip_niiki }}</td>
                                <td>{{ $item->nama_pemohon }}</td>
                                <td>{{ $item->jabatan}}</td>
                                <td><a href="{{ route('sppb.create', $item->kode_pemohon) }}" class="btn btn-primary btn-sm btn-flat">
                                    <i class="fa fa-check-circle"></i> Pilih</a></td>
                            </tr>
                        @endforeach
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>      
    </div>
</div>
